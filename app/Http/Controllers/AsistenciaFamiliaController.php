<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Año;
use App\Models\Colegio;
use App\Models\Grado;
use App\Models\Alumno;
use App\Models\Asistencia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AsistenciaFamiliaController extends Controller
{
    public function buscador()
    {
    $idcolegio=Auth::user()->colegio_id;
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $mes=date("m");
                if($mes==1){
                $mes='Enero';
                }
                if($mes==2){
                $mes='Febrero';
                }
                if($mes==3){
                $mes='Marzo';
                }
                if($mes==4){
                $mes='Abril';
                }
                if($mes==5){
                $mes='Mayo';
                }
                if($mes==6){
                $mes='Junio';
                }
                if($mes==7){
                $mes='Julio';
                }
                if($mes==8){
                $mes='Agosto';
                }
                if($mes==9){
                $mes='Septiembre';
                }
                if($mes==10){
                $mes='Octubre';
                }
                if($mes==11){
                $mes='Noviembre';
                }
                if($mes==12){
                $mes='Diciembre';
                }
    $meses = array('Marzo', 'Abril', 'Mayo', 'Junio',
       'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $idfamilia=Auth::user()->idpersona;
    $nombrealumno=Alumno::where('familias_id',$idfamilia)->pluck('nombrecompleto');
    $contadoralumnos=count($nombrealumno)-1;
    for($i=0;$i<=$contadoralumnos;$i++){
    $infoasistencias[]=Asistencia::where('nombrealumno',$nombrealumno[$i])->where('estado','Ausente')->where('mes',$mes)->get(); 
    $nuevajustificacion[]=Asistencia::where('nombrealumno',$nombrealumno[$i])->where('estado','Ausente')->where('justificacion',0)->where('mes',$mes)->get();
    }
    $cuentainfo=count($infoasistencias)-1;
    for($i=0; $i<=$cuentainfo;$i++){
      if (sizeof($infoasistencias[$i])!=0) {
        $infoasistencia[]=$infoasistencias[$i];
      }
      } 

      if (empty($infoasistencia)) {
        return view('AsistenciaFamilia.buscador',compact('infoaño','meses'));
      }
      else{
    return view('AsistenciaFamilia.buscador',compact('infoaño','infoasistencia','meses'));
    }
    }
    public function busquedasasistencias(Request $request)
    {
    $idcolegio=Auth::user()->colegio_id;
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $mess=$request->mes;
    $meses = array('Marzo', 'Abril', 'Mayo', 'Junio',
       'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $idfamilia=Auth::user()->idpersona;
    $nombrealumno=Alumno::where('familias_id',$idfamilia)->pluck('nombrecompleto');
    $contadoralumnos=count($nombrealumno)-1;
    for($i=0;$i<=$contadoralumnos;$i++){
    $infoasistencias[]=Asistencia::where('nombrealumno',$nombrealumno[$i])->where('estado','Ausente')->where('mes',$mess)->get(); 
    $nuevajustificacion[]=Asistencia::where('nombrealumno',$nombrealumno[$i])->where('estado','Ausente')->where('justificacion',0)->where('mes',$mess)->get();
    }
    $cuentainfo=count($infoasistencias)-1;
    for($i=0; $i<=$cuentainfo;$i++){
      if (sizeof($infoasistencias[$i])!=0) {
        $infoasistencia[]=$infoasistencias[$i];
      }
      } 

      if (empty($infoasistencia)) {
        return view('AsistenciaFamilia.buscador',compact('infoaño','meses','mess'));
      }
      else{
    return view('AsistenciaFamilia.buscador',compact('infoaño','infoasistencia','meses','mess'));
    }
    }


    public function enviarjustificacion(Request $request,$id){
      $infoasistencia=Asistencia::where('id',$id)->first();
      $fechaasistencia=Asistencia::where('id',$id)->pluck('fecha');
      $fechaasistencia = preg_replace('/[\[\]\.\;\" "]+/', '', $fechaasistencia);
      $nombreasistencia=Asistencia::where('id',$id)->pluck('nombrealumno');
      $nombreasistencia = preg_replace('/[\[\]\.\;\" "]+/', '', $nombreasistencia);
      $infoasistencia->comentariojusti=$request->justificacion;
      $infoasistencia->archivojusti=$request->file;
      if($request->hasFile('file')){
      $imagen=$request->file("file");
      $nombreimagen = 'Justificacion'.'_'.$nombreasistencia.'_'.$fechaasistencia.".".$imagen->guessExtension();
      $ruta=storage_path("app/public/archivosjustificaciones");
      $imagen->move($ruta,$nombreimagen);
      $infoasistencia->archivojusti=$nombreimagen;
      }
      $infoasistencia->justificacion=1;
      $infoasistencia->fechajusti=date('Y-m-d');
      $infoasistencia->update();
      return redirect()->back()->with('success','La justificación se ha guardado correctamente.'); 
    }

    public function justificacioninasistencias()
    {
      $idcolegio=Auth::user()->colegio_id;
      $idpersona= Auth::user()->idpersona;
      $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
      foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
      }
      $infoasistencia=Asistencia::where('docente',$idpersona)->where('colegio_id',$idcolegio)->where('año_id',$idaño)->where('justificacion',1)->orderby('fecha','DESC')->paginate(5);
      return view('AsistenciaFamilia.justificacion',compact('infoaño','infoasistencia')); 
    }

    public function aceptarjustificacion(Request $request, $id){
      $infoasistencia=Asistencia::where('id',$id)->first();
      $infoasistencia->gestionjustificacion=1;
      $infoasistencia->estado='Ausente justificada';
      $infoasistencia->update();
      return redirect()->back()->with('success','La justificación se ha gestionado correctamente.'); 
    }

    public function descargararchivo($id){
        $archivoasistencia=Asistencia::where('id',$id)->pluck('archivojusti');
        $archivoasistencia = preg_replace('/[\[\]\\;\" "]+/', '', $archivoasistencia);
        $file = storage_path('app/public/archivosjustificaciones/'.$archivoasistencia);
         return response()->download($file);
    }
}