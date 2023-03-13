<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Familia;
use App\Models\User;
use App\Models\Año;
use App\Models\Grado;
use App\Models\Colegio;
use App\Models\Abecedario;
use App\Models\Asistencia;
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

class CargaAlumnoController extends Controller
{
	public function index(Request $request)
    {
        if($request){
        $idusuario= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idusuario);
        if($colegio->isEmpty())
        {
            return view('admin.alumnos.index',compact('colegio'));
        }
        else{
            foreach($colegio as $col)
            {   
                $idcolegio= "$col->id";
            }
        $apellido = trim($request->get('buscarapellido'));
        $nombre = trim($request->get('buscarnombre'));
        $dni = trim($request->get('buscardni'));
        $grado= trim($request->get('buscargrado'));
        $alumnos = Alumno::orderby('id','ASC')
           ->nombres($nombre)
           ->apellidos($apellido)
           ->dnis($dni)
           ->grados($grado)
           ->where('colegio_id',$idcolegio)
           ->paginate(5);
        return view('admin.alumnos.index', compact('apellido','nombre','dni','alumnos','colegio','grado')); 
                    }
                }
    }
    /**
    * Show the application dataAjax.
    *
    * @return \Illuminate\Http\Response
    */
    public function getAutocompletefamiliar(Request $request){
    $data = [];
    $idpersona=Auth::user()->id;
    $colegio= Colegio::all()->where('users_id',$idpersona);
    foreach ($colegio as $idcol) {
    $idcolegio="$idcol->id";
    }
    if($request->has('q')){
    $search = $request->q;
    $data =Familia::select("id","nomapefamilia")
          ->where('nomapefamilia','LIKE',"%$search%")
          ->where('colegio_id',$idcolegio)
          ->get();
        }
    return response()->json($data);
   }

    public function create(Request $request)
    {
        $idpersona=Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idpersona);
        foreach ($colegio as $idcol) {
        $idcolegio="$idcol->id";
        }
        if($request){
        $apellidofam = trim($request->get('buscarapellidofamilia'));
        $familias= Familia::where('apellidofamilia','LIKE','%'.$apellidofam.'%')->where('colegio_id', $idcolegio)->paginate(5);
        $idusuario= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idusuario);
        if($colegio->isEmpty())
        {
            return view('admin.alumnos.index',compact('colegio'));
        }
        else{
            foreach($colegio as $col)
            {   
                $idcolegio= "$col->id";
            }
        $maxgrado=Colegio::where('id',$idcolegio)->get();
        foreach ($maxgrado as $max) {
            $maximogrado="$max->grados";
        }
        $division=Colegio::where('id',$idcolegio)->get();
        foreach ($division as $div) {
            $divcol="$div->divisiones";
        }
        $res = preg_replace('/[\[\]\.\;\" "]+/', '', $divcol);
        $divcol=explode(',', $res);
        $contador=count($divcol)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombredivision[]=Abecedario::where('id',$divcol[$i])->pluck("letras");
        }
        return view('admin.alumnos.create', compact('apellidofam','familias','maximogrado','nombredivision'))->with('success', 'El alumno se cargó correctamente.');
                    }
    }
}
    public function store(Request $request)
    {
        if($request->familiar){
            $fami=$request->input("familiar");
        }
         $request->validate([
            'dnialumno' => ['required', 'int','digits_between:7,8','unique:alumnos'],
            'nombrealumno' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'apellidoalumno' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'fechanacimiento' => 'required',
            'generoalumno' => ['required'],
            'domicilio' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'localidad' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'provincia' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'grado' => 'required',
            'familiar' => 'required',
            ]);
        $alumno=new Alumno();
        $alumno->nombrealumno=$request->nombrealumno;
        $alumno->apellidoalumno=$request->apellidoalumno;
        $alumno->nombrecompleto=$request->nombrealumno.' '.$request->apellidoalumno;
        $alumno->dnialumno=$request->dnialumno;
        $alumno->generoalumno=$request->generoalumno;
        $alumno->fechanacimiento=$request->fechanacimiento;
        $alumno->domicilio=$request->domicilio;
        $alumno->localidad=$request->localidad;
        $alumno->provincia=$request->provincia;
        $alumno->grado=$request->grado;
        $idusuario= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idusuario);
        foreach($colegio as $col)
            {   
                $idcolegio= "$col->id";
            };
        $alumno->colegio_id=$idcolegio;
        $alumno->familias_id=$fami;
        $alumno->save();
        $estado= Año::where('estado','activo')->where('id_colegio',$idcolegio)->get();
        foreach ($estado as $idaño) {
        $idest="$idaño->id";
        }
        $fechacreacion=Alumno::where('dnialumno',$alumno->dnialumno)->pluck("created_at");
        $fechacreacion = preg_replace('/[\[\]\.\;\" "]+/', '', $fechacreacion);
        $añoactual = substr($fechacreacion, 0, 4);
        $añolectivo=Año::where('descripcion',$añoactual)->where('id_colegio',$idcolegio)->get();
        if(sizeof($añolectivo)!=0){
        foreach($añolectivo as $añolect){
        $estado="$añolect->estado";
        $idaño="$añolect->id";
        }
        $gradoexiste=Grado::where('descripcion',$alumno->grado)->where('id_anio',$idaño)->where('colegio_id',$idcolegio)->get();
        if($estado=='activo' and sizeof($gradoexiste)!=0){
        $idalumnos=Grado::where('descripcion',$alumno->grado)->where('id_anio',$idaño)->where('colegio_id',$idcolegio)->get();
        foreach($idalumnos as $idalu){
        $alumnos="$idalu->id_alumnos";
        }
        $alumnos = preg_replace('/[\[\]\.\;\" "]+/', '', $alumnos);
        $idalumnos='['.$alumnos . ',' .$alumno->id.']';
        $gradoamodificar=Grado::where('descripcion',$alumno->grado)->where('id_anio',$idaño)->where('colegio_id',$idcolegio)->first();
        $gradoamodificar->id_alumnos=$idalumnos;
        $gradoamodificar->save();
        return redirect()->route('alumnos.index')
                        ->with('success', 'El alumno se cargó correctamente y se agregó al grado correspondiente.');
        }
        }

         return redirect()->route('alumnos.index')
                        ->with('success', 'El alumno se cargó correctamente.');
        }
    
    public function showalumnos($id)
    {
        $alu=Alumno::findOrFail($id);
        $familiaid=$alu->familias_id;
        $familia = Familia::findOrFail($familiaid);
        return view('admin.alumnos.showalumnos',compact('alu','familia')); 
    }

    public function showfamilia($id)
    {
        $fam = Familia::findOrFail($id);
        return view('admin.alumnos.showfamilias',compact('fam')); 
    }

     public function editaralumno($id)
    {
        $alu=Alumno::findOrFail($id);
        $idpersona=Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idpersona);
        foreach ($colegio as $idcol) {
        $idcolegio="$idcol->id";
        }
        $maxgrado=Colegio::where('id',$idcolegio)->get();
        foreach ($maxgrado as $max) {
            $maximogrado="$max->grados";
        }
        $division=Colegio::where('id',$idcolegio)->get();
        foreach ($division as $div) {
            $divcol="$div->divisiones";
        }
        $res = preg_replace('/[\[\]\.\;\" "]+/', '', $divcol);
        $divcol=explode(',', $res);
        $contador=count($divcol)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombredivision[]=Abecedario::where('id',$divcol[$i])->pluck("letras");
        }
        return view('admin.alumnos.editaralumno', compact('alu','maximogrado','nombredivision'));
    }

    public function update(Request $request,$id)
    {
        if($request->has('familiar')){
      $fami=$request->input("familiar");
    }
        $alu= Alumno::findOrFail($id);
        $request->validate([
            'dnialumno' => ['required', 'int','digits_between:7,8','unique:alumnos,dnialumno,'. $id],
            'nombrealumno' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'apellidoalumno' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'fechanacimiento' => 'required',
            'generoalumno' => ['required'],
            'domicilio' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'localidad' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'provincia' => ['required','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/','max:50'],
            'grado' => 'required',
        ]);
        $alu->dnialumno=$request->dnialumno;
        $alu->nombrealumno=$request->nombrealumno;
        $alu->apellidoalumno=$request->apellidoalumno;
        $alu->fechanacimiento=$request->fechanacimiento;
        $alu->generoalumno=$request->generoalumno;
        $alu->domicilio=$request->domicilio;
        $alu->localidad=$request->localidad;
        $alu->provincia=$request->provincia;
        $alu->fechanacimiento=$request->fechanacimiento;
        $alu->grado=$request->grado;
        $alu->familias_id=$fami;
        $alu->save();
        return redirect()->route('alumnos.index')->with('success','El alumno se modificó correctamente.');
    }
     public function destroy(Alumno $id)
    {
        $id->delete();
        return back()->with('success', 'El alumno se eliminó correctamente.');
    }   
}
