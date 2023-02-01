<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Año;
use App\Models\Docente;
use App\Models\Colegio;
use App\Models\Grado;
use App\Models\Asistencia;
use App\Models\AsistenciaEspecial;
use App\Models\Alumno;

class AsistenciaController extends Controller
{
    public function index()
    {
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $idcolegio=Auth::user()->colegio_id;
    $infoperiodo=Colegio::where('id',$idcolegio)->get();
    foreach($infoperiodo as $infoperi){
      $informacionperiodo="$infoperi->periodo";
    }
     $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }

    $meses = array('Marzo', 'Abril', 'Mayo', 'Junio',
       'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    if($tipodoc=='Grado'){
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
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
    $infoasistencias=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('mes',$mes)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    if($infoasistencia->isEmpty()){
    $alugradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('id_alumnos');
    $alugradodocente = preg_replace('/[\[\]\.\;\" "]+/', '', $alugradodocente);
    $alugradodocente=explode(',', $alugradodocente);
    $contadoralugradodocente=count($alugradodocente)-1;
    for ($i=0; $i <=$contadoralugradodocente ; $i++) { 
        $nombrealumno=Alumno::where('id',$alugradodocente[$i])->get();
        foreach($nombrealumno as $nombrealu){
            $nombrealumno="$nombrealu->nombrealumno";
            $apellidoalumno="$nombrealu->apellidoalumno";
        }
        $nombrecompleto[]=$nombrealumno.' '.$apellidoalumno;
    }
    return view('asistencia.asistencia',compact('tipodoc','informacionperiodo','descripcionaño','infoaño','meses','infoasistencia','infoasistencias','nombrecompleto','mes')); 
    }
    else{
    return view('asistencia.asistencia',compact('tipodoc','informacionperiodo','descripcionaño','infoaño','meses','infoasistencia','infoasistencias','mes')); 
    }
    
    }
    if($tipodoc!='Grado'){
    $meses = array('Marzo', 'Abril', 'Mayo', 'Junio',
       'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
     $infogrado=Grado::where('colegio_id',$idcolegio)->orderby('num_grado','ASC')->get();
        foreach($infogrado as $informaciongrado){
        $docentesespeciales="$informaciongrado->id_docentesespe";
        $docentesespeciales = preg_replace('/[\[\]\.\;\" "]+/', '', $docentesespeciales);
        $docentesespeciales=explode(',', $docentesespeciales);
        $contador=count($docentesespeciales)-1;
        for($i=0;$i<=$contador;$i++){
            if($docentesespeciales[$i]==Auth::user()->idpersona){
            $nombresgrado[]="$informaciongrado->descripcion";
            }
        }
        }
    return view('asistencia.asistenciaespe',compact('tipodoc','informacionperiodo','descripcionaño','infoaño','meses','nombresgrado')); 
    }
    }
    public function listadoasistencias(Request $request)
    {
    $idpersona= Auth::user()->idpersona;
    $idcolegio=Auth::user()->colegio_id;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
     $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $mes=$request->mes;
    $meses = array('Marzo', 'Abril', 'Mayo', 'Junio',
       'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $infoasistencias=AsistenciaEspecial::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$grado)->where('año_id',$idaño)->where('mes',$mes)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    $infogrado=Grado::where('colegio_id',$idcolegio)->orderby('num_grado','ASC')->get();
        foreach($infogrado as $informaciongrado){
        $docentesespeciales="$informaciongrado->id_docentesespe";
        $docentesespeciales = preg_replace('/[\[\]\.\;\" "]+/', '', $docentesespeciales);
        $docentesespeciales=explode(',', $docentesespeciales);
        $contador=count($docentesespeciales)-1;
        for($i=0;$i<=$contador;$i++){
            if($docentesespeciales[$i]==Auth::user()->idpersona){
            $nombresgrado[]="$informaciongrado->descripcion";
            }
        }
        }
    if($infoasistencia->isEmpty()){
    $alugradodocente=Grado::where('colegio_id',$idcolegio)->where('id_anio',$idaño)->where('descripcion',$grado)->pluck('id_alumnos');
    $alugradodocente = preg_replace('/[\[\]\.\;\" "]+/', '', $alugradodocente);
    $alugradodocente=explode(',', $alugradodocente);
    $contadoralugradodocente=count($alugradodocente)-1;
    for ($i=0; $i <=$contadoralugradodocente ; $i++) { 
        $nombrealumno=Alumno::where('id',$alugradodocente[$i])->where('colegio_id',$idcolegio)->get();
        foreach($nombrealumno as $nombrealu){
            $nombrealumno="$nombrealu->nombrealumno";
            $apellidoalumno="$nombrealu->apellidoalumno";
        }
        $nombrecompleto[]=$nombrealumno.' '.$apellidoalumno;
    }
    return view('asistencia.listadoasistenciasespe',compact('infoasistencias','infoasistencia','meses','nombresgrado','infoaño','mes','grado','tipodoc','nombrecompleto'));
    }
    else{
    return view('asistencia.listadoasistenciasespe',compact('infoasistencias','infoasistencia','meses','nombresgrado','infoaño','mes','grado','tipodoc'));
    } 
    }
    if($tipodoc=='Grado'){
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoasistencias=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('mes',$mes)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    if($infoasistencia->isEmpty()){
    $alugradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('id_alumnos');
    $alugradodocente = preg_replace('/[\[\]\.\;\" "]+/', '', $alugradodocente);
    $alugradodocente=explode(',', $alugradodocente);
    $contadoralugradodocente=count($alugradodocente)-1;
    for ($i=0; $i <=$contadoralugradodocente ; $i++) { 
        $nombrealumno=Alumno::where('id',$alugradodocente[$i])->get();
        foreach($nombrealumno as $nombrealu){
            $nombrealumno="$nombrealu->nombrealumno";
            $apellidoalumno="$nombrealu->apellidoalumno";
        }
        $nombrecompleto[]=$nombrealumno.' '.$apellidoalumno;
    }
   return view('asistencia.listadoasistenciasespe',compact('infoasistencias','infoasistencia','meses','infoaño','mes','tipodoc','nombrecompleto'));
    }
    else{
    return view('asistencia.listadoasistenciasespe',compact('infoasistencias','infoasistencia','meses','infoaño','mes','tipodoc')); 
    } 
    
    }

    }
    public function create(Request $request)
    {
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $idcolegio=Auth::user()->colegio_id;
    $infoperiodo=Colegio::where('id',$idcolegio)->get();
    foreach($infoperiodo as $infoperi){
      $informacionperiodo="$infoperi->periodo";
    }
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $mes=$request->mes;
    if($tipodoc=='Grado'){
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoasistencia=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->get();
    $infoasistencia=$infoasistencia->unique('nombrealumno');
    return view('asistencia.create',compact('infoasistencia','tipodoc','mes')); 
    }
    if($tipodoc!='Grado'){
    $gradodocente=$request->grado;
    $infoasistencia=AsistenciaEspecial::where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->get();
    $infoasistencia=$infoasistencia->unique('nombrealumno');
    return view('asistencia.create',compact('infoasistencia','gradodocente','tipodoc','mes')); 
    }
    }
    public function store(Request $request)
    {
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $idcolegio=Auth::user()->colegio_id;
    $infoperiodo=Colegio::where('id',$idcolegio)->get();
    foreach($infoperiodo as $infoperi){
      $informacionperiodo="$infoperi->periodo";
    }
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $meses = array('Marzo', 'Abril', 'Mayo', 'Junio',
       'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $fechaseleccionada=$request->diaasistencia;
    if($tipodoc=='Grado'){
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoasistencias=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('fecha',$fechaseleccionada)->get();
    }
    if($tipodoc!='Grado'){
    $gradodocente=$request->gradodocente;
    $infoasistencias=AsistenciaEspecial::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('fecha',$fechaseleccionada)->get(); 
    }
    if($infoasistencias->isEmpty()){
    if($tipodoc=='Grado'){
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoasistencias=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->get();
    }
    if($tipodoc!='Grado'){
    $gradodocente=$request->gradodocente;
    $infoasistencias=AsistenciaEspecial::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->get(); 
    }
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    $gradodocente=preg_replace('/[\[\]\.\;\""]+/', '', $gradodocente);
    $contadorasist=count($infoasistencia)-1;
    for ($i=0; $i <=$contadorasist ; $i++) { 
        if($infoasistencia[$i]->fecha==null){
         $request->validate([
            'diaasistencia' => ['required'],
        ]);
        $infoasistencia[$i]->fecha=$request->diaasistencia;
        $fechaComoEntero = strtotime($request->diaasistencia);
        $mes = date("m", $fechaComoEntero);
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
        $infoasistencia[$i]->mes=$mes;
        $infoasistencia[$i]->estado='Ausente';
        if($tipodoc=='Grado'){
        $infoasistencia[$i]->justificacion=0;
        }
        $presentes=$request->estadoasistencia;
        if(empty($presentes)){
        }
        else{
        $contadorpresentes=count($presentes)-1;
        for ($j=0; $j <=$contadorpresentes; $j++) { 
            if($presentes[$j]==$infoasistencia[$i]->id_alumno){
            $infoasistencia[$i]->estado='Presente';
            break;
            }
        }
        }
        if($tipodoc=='Grado'){
        $infoasistencia[$i]->tardanza=0;  
        $tardanzas=$request->tardanza;
        if(empty($tardanzas)){
        }
        else{
        $contadortardanzas=count($tardanzas)-1;
        for ($j=0; $j <=$contadortardanzas; $j++) { 
            if($tardanzas[$j]==$infoasistencia[$i]->id_alumno){
            $infoasistencia[$i]->tardanza=1; 
            break;
            }
        }
        }
        }
        $infoasistencia[$i]->update();
        }
        else{
        $request->validate([
            'diaasistencia' => ['required'],
        ]);
        if($tipodoc=='Grado'){
        $asistencia=new Asistencia();
        $asistencia->id_alumno=$infoasistencia[$i]->id_alumno;
        $asistencia->nombrealumno=$infoasistencia[$i]->nombrealumno;
        $asistencia->fecha=$request->diaasistencia;
        }
        if($tipodoc!='Grado'){
        $asistencia=new AsistenciaEspecial();
        $asistencia->id_alumno=$infoasistencia[$i]->id_alumno;
        $asistencia->nombrealumno=$infoasistencia[$i]->nombrealumno;
        $asistencia->fecha=$request->diaasistencia;
        }
        $fechaComoEntero = strtotime($request->diaasistencia);
        $mes = date("m", $fechaComoEntero);
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
        $asistencia->mes=$mes;
        $asistencia->estado='Ausente';
        if($tipodoc=='Grado'){
        $asistencia->justificacion=0;
        } 
        $presentes=$request->estadoasistencia;
        if(empty($presentes)){
        }
        else{
        $contadorpresentes=count($presentes)-1;
        
        for ($j=0; $j <=$contadorpresentes; $j++) { 
            if($presentes[$j]==$infoasistencia[$i]->id_alumno){
            $asistencia->estado='Presente';
            break;
            }
        }
        }
        if($tipodoc=='Grado'){
        $asistencia->tardanza=0;  
        $tardanzas=$request->tardanza;
        if(empty($tardanzas)){
        }
        else{
        $contadortardanzas=count($tardanzas)-1;
        for ($j=0; $j <=$contadortardanzas; $j++) { 
            if($tardanzas[$j]==$infoasistencia[$i]->id_alumno){
            $asistencia->tardanza=1; 
            break;
            }
        }
        }
        }
        $asistencia->docente=Auth::user()->idpersona;
        $asistencia->grado=$gradodocente;
        $asistencia->colegio_id=$idcolegio;
        $asistencia->año_id=$idaño;
        $asistencia->save();
        }
    }
    $success='Las asistencias se guardaron correctamente';
    if($tipodoc=='Grado'){
    $mes=$request->mes;
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoasistencias=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('mes',$mes)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    if($infoasistencia->isEmpty()){
    $alugradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('id_alumnos');
    $alugradodocente = preg_replace('/[\[\]\.\;\" "]+/', '', $alugradodocente);
    $alugradodocente=explode(',', $alugradodocente);
    $contadoralugradodocente=count($alugradodocente)-1;
    for ($i=0; $i <=$contadoralugradodocente ; $i++) { 
        $nombrealumno=Alumno::where('id',$alugradodocente[$i])->get();
        foreach($nombrealumno as $nombrealu){
            $nombrealumno="$nombrealu->nombrealumno";
            $apellidoalumno="$nombrealu->apellidoalumno";
        }
        $nombrecompleto[]=$nombrealumno.' '.$apellidoalumno;
    }
   return view('asistencia.listadoasistenciasespe',compact('tipodoc','informacionperiodo','descripcionaño','infoaño','meses','infoasistencia','infoasistencias','mes','nombrecompleto','success'));
    }
    else{
    return view('asistencia.listadoasistenciasespe',compact('tipodoc','informacionperiodo','descripcionaño','infoaño','meses','infoasistencia','infoasistencias','mes','success','gradodocente'));
    } 
    }
    if($tipodoc!='Grado'){
    $infogrado=Grado::where('colegio_id',$idcolegio)->orderby('num_grado','ASC')->get();
        foreach($infogrado as $informaciongrado){
        $docentesespeciales="$informaciongrado->id_docentesespe";
        $docentesespeciales = preg_replace('/[\[\]\.\;\" "]+/', '', $docentesespeciales);
        $docentesespeciales=explode(',', $docentesespeciales);
        $contador=count($docentesespeciales)-1;
        for($i=0;$i<=$contador;$i++){
            if($docentesespeciales[$i]==Auth::user()->idpersona){
            $nombresgrado[]="$informaciongrado->descripcion";
            }
        }
        }
    $mes=$request->mes;
    $grado=$gradodocente;
    $infoasistencias=AsistenciaEspecial::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('mes',$mes)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    if($infoasistencia->isEmpty()){
    $alugradodocente=Grado::where('colegio_id',$idcolegio)->where('id_anio',$idaño)->where('descripcion',$grado)->pluck('id_alumnos');
    $alugradodocente = preg_replace('/[\[\]\.\;\" "]+/', '', $alugradodocente);
    $alugradodocente=explode(',', $alugradodocente);
    $contadoralugradodocente=count($alugradodocente)-1;
    for ($i=0; $i <=$contadoralugradodocente ; $i++) { 
        $nombrealumno=Alumno::where('id',$alugradodocente[$i])->get();
        foreach($nombrealumno as $nombrealu){
            $nombrealumno="$nombrealu->nombrealumno";
            $apellidoalumno="$nombrealu->apellidoalumno";
        }
        $nombrecompleto[]=$nombrealumno.' '.$apellidoalumno;
    }
     return view('asistencia.listadoasistenciasespe',compact('tipodoc','informacionperiodo','descripcionaño','infoaño','meses','infoasistencia','infoasistencias','gradodocente','mes','grado','nombresgrado','nombrecompleto','success'));
    }
    else{
    return view('asistencia.listadoasistenciasespe',compact('tipodoc','informacionperiodo','descripcionaño','infoaño','meses','infoasistencia','infoasistencias','gradodocente','mes','grado','nombresgrado','success'));
    } 
    }
    }
    else{
    $danger='Ya se encuentra cargada la asistencia para la fecha seleccionada.';
    if($tipodoc=='Grado'){
    $mes=$request->mes;
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoasistencias=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('mes',$mes)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
   return view('asistencia.create',compact('tipodoc','infoasistencia','mes','infoasistencias','danger'));  
    }
    if($tipodoc!='Grado'){
    $infogrado=Grado::where('colegio_id',$idcolegio)->orderby('num_grado','ASC')->get();
    $mes=$request->mes;
    $grado=$gradodocente;
    $infoasistencia=AsistenciaEspecial::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('mes',$mes)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    return view('asistencia.create',compact('tipodoc','infoasistencia','mes','danger','gradodocente'));  
    }
}
}
    public function buscador(Request $request)
    {
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $idcolegio=Auth::user()->colegio_id;
    $infoperiodo=Colegio::where('id',$idcolegio)->get();
    foreach($infoperiodo as $infoperi){
      $informacionperiodo="$infoperi->periodo";
    }
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $mes=$request->mes;
    if($tipodoc=='Grado'){
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoasistencia=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->get();
    return view('asistencia.buscadorfecha',compact('tipodoc','informacionperiodo','descripcionaño','infoaño','infoasistencia','mes')); 
    }
    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $infoasistencia=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$grado)->where('año_id',$idaño)->get();
    return view('asistencia.buscadorfecha',compact('tipodoc','informacionperiodo','descripcionaño','infoaño','infoasistencia','mes','grado')); 
    }
    }
    
    public function editarasistencia(Request $request)
    {
    $mes=$request->mes;
    $fechaseleccionada=$request->diaasistencia;
    $request->validate([
            'diaasistencia' => ['required'],
        ]);
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $idcolegio=Auth::user()->colegio_id;
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    if($tipodoc=='Grado'){
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoasistencias=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('fecha',$fechaseleccionada)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    return view('asistencia.editarasistencia',compact('infoasistencia','fechaseleccionada','mes','tipodoc')); 
    }
    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $infoasistencias=AsistenciaEspecial::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$grado)->where('año_id',$idaño)->where('fecha',$fechaseleccionada)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    return view('asistencia.editarasistencia',compact('infoasistencia','fechaseleccionada','mes','tipodoc','grado'));   
    }
    
    }
    public function update(Request $request)
    {
    $fechaseleccionada=$request->diaasistencia;
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $idcolegio=Auth::user()->colegio_id;
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $mes=$request->mes;
    $meses = array('Marzo', 'Abril', 'Mayo', 'Junio',
       'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $success='Las asistencias se modificaron correctamente';
    if($tipodoc=='Grado'){
    $gradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoasistencias=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('fecha',$fechaseleccionada)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    }
    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $infoasistencias=AsistenciaEspecial::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$grado)->where('año_id',$idaño)->where('fecha',$fechaseleccionada)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');  
    }
    $contadorasist=count($infoasistencia)-1;
    for ($i=0; $i <=$contadorasist ; $i++) {
    $infoasistencia[$i]->estado='Ausente'; 
    $presentes=$request->estadoasistencia;
        if(empty($presentes)){
        
        }
        else{
        $contadorpresentes=count($presentes)-1;
        for ($j=0; $j <=$contadorpresentes; $j++) { 
            if($presentes[$j]==$infoasistencia[$i]->id_alumno){
            $infoasistencia[$i]->estado='Presente';
            break;
            }
        }
        }
         if($tipodoc=='Grado'){
        $infoasistencia[$i]->tardanza=0;  
        $tardanzas=$request->tardanza;
        if(empty($tardanzas)){
        }
        else{
        $contadortardanzas=count($tardanzas)-1;
        for ($j=0; $j <=$contadortardanzas; $j++) { 
            if($tardanzas[$j]==$infoasistencia[$i]->id_alumno){
            $infoasistencia[$i]->tardanza=1; 
            break;
            }
        }
        }
        }
    $infoasistencia[$i]->update();
    }
    if($tipodoc=='Grado'){
    $infoasistencias=Asistencia::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$gradodocente)->where('año_id',$idaño)->where('mes',$mes)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
    if($infoasistencia->isEmpty()){
    $alugradodocente=Grado::where('id_docentes',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('id_alumnos');
    $alugradodocente = preg_replace('/[\[\]\.\;\" "]+/', '', $alugradodocente);
    $alugradodocente=explode(',', $alugradodocente);
    $contadoralugradodocente=count($alugradodocente)-1;
    for ($i=0; $i <=$contadoralugradodocente ; $i++) { 
        $nombrealumno=Alumno::where('id',$alugradodocente[$i])->get();
        foreach($nombrealumno as $nombrealu){
            $nombrealumno="$nombrealu->nombrealumno";
            $apellidoalumno="$nombrealu->apellidoalumno";
        }
        $nombrecompleto[]=$nombrealumno.' '.$apellidoalumno;
    }
   return view('asistencia.listadoasistenciasespe',compact('tipodoc','descripcionaño','infoaño','meses','infoasistencia','infoasistencias','mes','nombrecompleto','success'));
    }
    else{
    return view('asistencia.listadoasistenciasespe',compact('tipodoc','descripcionaño','infoaño','meses','infoasistencia','infoasistencias','mes','success'));
    } 
    }
    else{
    $grado=$request->grado;
    $infoasistencias=AsistenciaEspecial::where('docente',Auth::user()->idpersona)->where('colegio_id',$idcolegio)->where('grado',$grado)->where('año_id',$idaño)->where('mes',$mes)->get();
    $infoasistencia=$infoasistencias->unique('nombrealumno');
     $infogrado=Grado::where('colegio_id',$idcolegio)->orderby('num_grado','ASC')->get();
        foreach($infogrado as $informaciongrado){
        $docentesespeciales="$informaciongrado->id_docentesespe";
        $docentesespeciales = preg_replace('/[\[\]\.\;\" "]+/', '', $docentesespeciales);
        $docentesespeciales=explode(',', $docentesespeciales);
        $contador=count($docentesespeciales)-1;
        for($i=0;$i<=$contador;$i++){
            if($docentesespeciales[$i]==Auth::user()->idpersona){
            $nombresgrado[]="$informaciongrado->descripcion";
            }
        }
        }
    if($infoasistencia->isEmpty()){
    $alugradodocente=Grado::where('colegio_id',$idcolegio)->where('id_anio',$idaño)->where('descripcion',$grado)->pluck('id_alumnos');
    $alugradodocente = preg_replace('/[\[\]\.\;\" "]+/', '', $alugradodocente);
    $alugradodocente=explode(',', $alugradodocente);
    $contadoralugradodocente=count($alugradodocente)-1;
    for ($i=0; $i <=$contadoralugradodocente ; $i++) { 
        $nombrealumno=Alumno::where('id',$alugradodocente[$i])->get();
        foreach($nombrealumno as $nombrealu){
            $nombrealumno="$nombrealu->nombrealumno";
            $apellidoalumno="$nombrealu->apellidoalumno";
        }
        $nombrecompleto[]=$nombrealumno.' '.$apellidoalumno;
    }
     return view('asistencia.listadoasistenciasespe',compact('infoasistencia','infoasistencias','fechaseleccionada','tipodoc','descripcionaño','infoaño','meses','mes','success','grado','nombresgrado','nombrecompleto'));
    }
    else{
    return view('asistencia.listadoasistenciasespe',compact('infoasistencia','infoasistencias','fechaseleccionada','tipodoc','descripcionaño','infoaño','meses','mes','success','grado','nombresgrado')); 
    } 
     
    }

    }
    
}