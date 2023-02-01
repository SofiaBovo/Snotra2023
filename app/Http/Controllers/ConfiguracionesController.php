<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Colegio;
use App\Models\User;
use App\Http\Requests;
use App\Http\Requests\ItemCreateRequest;
use App\Models\Abecedario;
use App\Models\espacioscurriculares;
use App\Models\calificacioncualitativa;


class ConfiguracionesController extends Controller
{
  
    public function index()
    {
        $idpersona= Auth::user()->id;
        $colegio= Colegio::all()->where('users_id',$idpersona);
        foreach($colegio as $col)
            {   
                $idcolegio= "$col->id";
            };
        return view('Colegio.configuracionesbasicas', compact('colegio'));
    }

    public function store(Request $request)
    {
        if($request->divisiones){
            $divi=$request->input("divisiones");
            $divi=implode(' ',$divi);
        }
        if($request->espacioscurriculares){
            $espacio=$request->input("espacioscurriculares");
            $espa=implode(' ',$espacio);
        }
        
        $cantidad=count($espacio)-1;
        for ($i=0; $i<=$cantidad;$i++) { 
            if(is_numeric($espacio[$i])){
            }
            else
            {
                $esp= new espacioscurriculares();
                $esp->nombre=$espacio[$i];
                $nuevosespacios[]=$espacio[$i];
                $esp->save();
                $espacio[$i]=$esp->id;
            }
        }
        $request->validate([
            'periodo' => ['required'],
            'turno' => ['required'],
            'grados'=> ['required'],
            'divisiones' => ['required'],
            'espacioscurriculares'=> ['required'],
            ]);
        $idpersona= Auth::user()->id;
        $colegio= Colegio::where('users_id',$idpersona)->pluck("id");
        $idcolegio = preg_replace('/[\[\]\.\;\" "]+/', '', $colegio);
        $modificar = Colegio::findOrFail($idcolegio);
        $modificar->periodo=$request->periodo;
        $modificar->turno=$request->turno;
        $modificar->grados=$request->grados;
        $modificar->divisiones=$request->divisiones;
        $modificar->espacioscurriculares=$espacio;
        if($request->calicualitativa){
        $calificacion=$request->input("calicualitativa");
        $modificar->calicualitativa=$calificacion;
        $modificar->calinumerica=null;
        }
        if($request->maximo and $request->minimo)
        {
            $valorminimo=$request->input("minimo");
            $valormaximo=$request->input("maximo");
            $datos = array($valorminimo, $valormaximo);
            $modificar->calinumerica=$datos;
            $modificar->calicualitativa=null;
        }
        $modificar->save();
        return redirect()->route('configuraciones',compact('colegio'))->with('success', 'Las configuraciones se modificaron correctamente.');
        }
    
    /**
    * Show the application dataAjax.
    *
    * @return \Illuminate\Http\Response
    */
    public function getAutocompletedivisiones(Request $request){
     $data = [];
    if($request->has('q')){
    $search = $request->q;
    $data =Abecedario::select("id","letras")
          ->where('letras','LIKE',"%$search%")
          ->get();
        }
    return response()->json($data);
   }
   
    public function getAutocompleteespacios(Request $request){
    $data = [];
    if($request->has('q')){
    $search = $request->q;
    $data =espacioscurriculares::select("id","nombre")
          ->where('nombre','LIKE',"%$search%")
          ->get();
        }
    return response()->json($data);
   }

   public function getAutocompletecalificacion(Request $request){
    $data = [];
    if($request->has('q')){
    $search = $request->q;
    $data =calificacioncualitativa::select("id_calificacion","calificacion")
          ->where('calificacion','LIKE',"%$search%")
          ->get();
        }
    return response()->json($data);
   }
}