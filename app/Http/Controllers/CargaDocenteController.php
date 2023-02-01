<?php

namespace App\Http\Controllers;
header('Content-type: text/html; charset=UTF-8');

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\User;
use App\Models\Colegio;
use App\Models\espacioscurriculares;
use Auth;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Input;
use Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\InvoicePaid;
use App\Notifications\notifcreacion;


class CargaDocenteController extends Controller
{
	public function index(Request $request)
    {
        if($request){
        $idusuario= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idusuario);
        if($colegio->isEmpty())
        {
            return view('admin.docentes.index',compact('colegio'));

        }
        else{
        foreach($colegio as $col)
            {   
                $idcolegio= "$col->id";
            };
        $apellido = trim($request->get('buscarapellido'));
        $nombre = trim($request->get('buscarnombre'));
        $dni = trim($request->get('buscardni'));
        $docentes = Docente::orderby('id','DESC')
           ->nombres($nombre)
           ->apellidos($apellido)
           ->dnis($dni)
           ->where('colegio_id',$idcolegio)
           ->paginate(5);
        return view('admin.docentes.index', compact('apellido','nombre','dni','docentes','colegio')); 
                    }
                }

    }
    public function create()
    {
        $docentes = Docente::all();
        $idusuario= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idusuario);
        foreach($colegio as $col)
        {   
            $idcolegio= "$col->id";
        }
        $espacios=Colegio::where('id',$idcolegio)->get();
        foreach ($espacios as $esp) {
            $espacurri="$esp->espacioscurriculares";
        }
        $res = preg_replace('/[\[\]\.\;\" "]+/', '', $espacurri);
        $espacurri=explode(',', $res);
        $contador=count($espacurri)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombreespa=espacioscurriculares::where('id',$espacurri[$i])->get();
        foreach ($nombreespa as $nomes) {
            $nombreespacio[]="$nomes->nombre";
        }
    }
        $nombreespacio[]=sort($nombreespacio,3);
        $espacurri=implode(',', $nombreespacio);
        $res = iconv("ISO-8859-1//TRANSLIT","UTF-8", $espacurri);
        $nombreespa=utf8_decode($res);
        return view('admin.docentes.create', compact('docentes','nombreespa'));
    }

    public function store(Request $request)
    {
        $check=$request->grado;
         $request->validate([
            'dnidocente' => ['required', 'int','digits_between:7,8','unique:docentes'],
            'nombredocente' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'apellidodocente' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'fechanacimientodoc' => 'required',
            'generodocente' => ['required'],
            'domiciliodocente' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'localidaddocente' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'provinciadocente' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'estadocivildoc' => ['required'],
            'telefonodocente' => ['required','int','min:1000000000','max:9999999999'],
            'emaildocente' => ['required', 'string', 'email', 'max:255', 'unique:docentes'],
            'legajo' => ['required','int'],
            //'especialidad' => ['required','regex:/^[\pL\s\-]+$/u','max:25'],
        ]);
        $docente=new Docente();
        $docente->nombredocente=$request->nombredocente;
        $docente->apellidodocente=$request->apellidodocente;
        $docente->dnidocente=$request->dnidocente;
        $docente->generodocente=$request->generodocente;
        $docente->fechanacimientodoc=$request->fechanacimientodoc;
        $docente->domiciliodocente=$request->domiciliodocente;
        $docente->localidaddocente=$request->localidaddocente;
        $docente->provinciadocente=$request->provinciadocente;
        $docente->estadocivildoc=$request->estadocivildoc;
        $docente->telefonodocente=$request->telefonodocente;
        $docente->emaildocente=$request->emaildocente;
        $docente->legajo=$request->legajo;
        if(empty($check)){
        $docente->especialidad=$request->especialidad;
        }
        else{
        $docente->especialidad='Grado';
        }
        $idusuario= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idusuario);
        foreach($colegio as $col)
            {   
                $idcolegio= "$col->id";
            };
        $docente->colegio_id=$idcolegio;
        $docente->save();        
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";
        for($i=0;$i<8;$i++) {
        $password .= substr($str,rand(0,62),1);
        }
        $user=new User();
        $user->name =$request->nombredocente . ' ' . $request->apellidodocente;
        $user->email=$request->emaildocente;
        $user->passwordenc=Crypt::encrypt($password);
        $user->password=Hash::make($password);
        $user->role='docente';
        $user->idpersona=$docente->id;
        $user->colegio_id=$idcolegio;
        $user->save();
        $password=Crypt::decrypt($user->passwordenc);
        $user->notify(new notifcreacion($request->emaildocente,$password));
        return redirect()->route('docentes.index')->with('success', 'El docente se cargó correctamente.');
    } 

   public function show($id)
    {
      $doc=Docente::findOrFail($id);
      return view('admin.docentes.show', compact('doc'));
    }

    public function editardoc(Docente $id)
    {
        $idusuario= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idusuario);
        foreach($colegio as $col)
        {   
            $idcolegio= "$col->id";
        }
        $espacios=Colegio::where('id',$idcolegio)->get();
        foreach ($espacios as $esp) {
            $espacurri="$esp->espacioscurriculares";
        }
        $res = preg_replace('/[\[\]\.\;\" "]+/', '', $espacurri);
        $espacurri=explode(',', $res);
        $contador=count($espacurri)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombreespa=espacioscurriculares::where('id',$espacurri[$i])->get();
        foreach ($nombreespa as $nomes) {
            $nombreespacio[]="$nomes->nombre";
        }
    }
        $nombreespacio[]=sort($nombreespacio,3);
        $espacurri=implode(',', $nombreespacio);
        $res = iconv("ISO-8859-1//TRANSLIT","UTF-8", $espacurri);
        $nombreespa=utf8_decode($res);
      return view('admin.docentes.editar', compact('id','nombreespa'));
    }

    public function update(Request $request,$id)
    {
        $doc = Docente::findOrFail($id);
         $request->validate([
            'dnidocente' => ['required', 'int','digits_between:7,8','unique:docentes,dnidocente,'. $id],
            'nombredocente' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'apellidodocente' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'fechanacimientodoc' => 'required',
            'generodocente' => ['required'],
            'domiciliodocente' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'localidaddocente' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'provinciadocente' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'estadocivildoc' => ['required'],
            'telefonodocente' => ['required','int','min:1000000000','max:9999999999'],
            'emaildocente' => ['required', 'string', 'email', 'max:255', 'unique:docentes,emaildocente,'. $id],
            'legajo' => ['required','int'],
        ]);
        $data= $request->only('dnidocente','nombredocente','apellidodocente','fechanacimientodoc','generodocente','domiciliodocente','localidaddocente','provinciadocente','estadocivildoc','telefonodocente','emaildocente','legajo','especialidad');
        $doc->update($data);
        return redirect()->route('docentes.index')->with('success','El docente se modificó correctamente.');
    }


    public function destroy(Docente $id)
    {
        $id->delete();
        return back()->with('success','El docente se eliminó correctamente.');
    }

}
