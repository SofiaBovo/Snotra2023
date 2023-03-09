<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familia;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Abecedario;
use DB;
use Input;
use Storage;
use Auth;
use App\Models\User;
use App\Models\Colegio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\InvoicePaid;
use App\Notifications\notifcreacion;

class CargaFamiliaController extends Controller
{
    public function index(Request $request){
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
        $dni = trim($request->get('buscardni'));
        $familias = Familia::orderby('id','DESC')
           ->apellidos($apellido)
           ->dnis($dni)
           ->where('colegio_id',$idcolegio)
           ->paginate(5);
        return view('admin.familias.index', compact('apellido','dni','familias','colegio')); 
                    }
                }
    }
    public function crearfamilia(Request $request)
    {
        $idpersona=Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idpersona);
        foreach ($colegio as $idcol) {
        $idcolegio="$idcol->id";
        }
        return view('admin.familias.create');
}
    public function storefamilia(Request $request){
        $idusuario= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idusuario);
        foreach($colegio as $col)
            {   
                $idcolegio= "$col->id";
            };
        $apellido = trim($request->get('buscarapellidofamilia'));
        $dni = trim($request->get('buscardnifamilia'));
        $familias= Familia::where('apellidofamilia','LIKE','%'.$apellido.'%')->where('dnifamilia','LIKE','%'.$dni.'%')->where('colegio_id', $idcolegio)->paginate(5);
        $request->validate([
            'dnifamilia' => ['required', 'int','digits_between:7,8','unique:familias'],
            'nombrefamilia' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'apellidofamilia' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'domiciliofamilia' => ['required','max:50'],
            'localidadfamilia' => ['required','max:50'],
            'provinciafamilia' => ['required','max:50'],
            'generofamilia' => ['required'],
            'telefonofamilia' => ['required','int','min:1000000000','max:9999999999'],
            'email' => ['required','string', 'email', 'max:255', 'unique:familias'],
            'vinculofamiliar' => ['required'],
            ]);
        $familia=new Familia();
        $familia->nombrefamilia=$request->nombrefamilia;
        $familia->apellidofamilia=$request->apellidofamilia;
        $familia->nomapefamilia=$request->nombrefamilia.' '.$request->apellidofamilia;
        $familia->dnifamilia=$request->dnifamilia;
        $familia->domiciliofamilia=$request->domiciliofamilia;
        $familia->localidadfamilia=$request->localidadfamilia;
        $familia->provinciafamilia=$request->provinciafamilia;
        $familia->generofamilia=$request->generofamilia;
        $familia->telefono=$request->telefonofamilia;
        $familia->email=$request->email;
        $familia->vinculofamiliar=$request->vinculofamiliar;
        $familia->colegio_id=$idcolegio;
        $familia->save();
        $idfamilia=$familia->id;
        $emfam=$familia->email;
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";
        for($i=0;$i<8;$i++) {
        $password .= substr($str,rand(0,62),1);
        }
        $user=new User();
        $user->name =$request->nombrefamilia . ' ' . $request->apellidofamilia;
        $user->email=$emfam;
        $user->passwordenc=Crypt::encrypt($password);
        $user->password=Hash::make($password);
        $user->role='familia';
        $user->idpersona=$idfamilia;
        $user->colegio_id=$idcolegio;
        $user->confirmed=1;
        $user->save();
        $password=Crypt::decrypt($user->passwordenc);
        $user->notify(new notifcreacion($user->email,$password));
        return redirect()->route('familias.index')->with('success', 'El familiar se cargó correctamente.');
        }

     public function destroy(Familia $id)
    {
        $id->delete();
        return back()->with('success', 'La familia se eliminó correctamente.');
    }

	public function editarfamilia(Familia $id)
    {
      return view('admin.familias.editarfam', compact('id'));
    }

    public function updatefamilia(Request $request, $id)
    {
        $idusuario= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idusuario);
        foreach($colegio as $col)
            {   
                $idcolegio= "$col->id";
            };
        $apellido = trim($request->get('buscarapellidofamilia'));
        $dni = trim($request->get('buscardnifamilia'));
        $familias= Familia::where('apellidofamilia','LIKE','%'.$apellido.'%')->where('dnifamilia','LIKE','%'.$dni.'%')->where('colegio_id', $idcolegio)->paginate(5);
        $fam = Familia::findOrFail($id);
        $request->validate([
            'dnifamilia' => ['required', 'int','digits_between:7,8','unique:familias,dnifamilia,'. $id],
            'nombrefamilia' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'apellidofamilia' => ['required','regex:/^[\pL\s\-]+$/u','max:50'],
            'domiciliofamilia' => ['required','max:50'],
            'localidadfamilia' => ['required','max:50'],
            'provinciafamilia' => ['required','max:50'],
            'generofamilia' => ['required'],
            'telefonofamilia' => ['required','int','min:1000000000','max:9999999999'],
            'email' => ['required','string', 'email', 'max:255', 'unique:familias,email,'.$id],
            'vinculofamiliar' => ['required'],
        ]);
        $data= $request->only('dnifamilia','nombrefamilia','apellidofamilia','generofamilia','telefono','email','vinculofamiliar','domiciliofamilia','localidadfamilia','provinciafamilia');
        $fam->update($data);
       return redirect()->route('familias.index')->with('success','La familia se modificó correctamente.');
    }
}
