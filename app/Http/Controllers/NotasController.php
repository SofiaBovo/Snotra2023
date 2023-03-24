<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Año;
use App\Models\Docente;
use App\Models\Grado;
use App\Models\Colegio;
use App\Models\Alumno;
use App\Models\Notas;
use App\Models\CriteriosEvaluacion;
use App\Models\espacioscurriculares;
use App\Models\calificacioncualitativa;
use App\Models\Informes;
use App\Models\NotaFinal;

class NotasController extends Controller
{
    public function __construct()
   {
    $this->middleware('auth');
   }

    public function buscador()
   {
    $idcolegio=Auth::user()->colegio_id;
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $infoperiodo=Colegio::where('id',$idcolegio)->get();
    foreach($infoperiodo as $infoperi){
      $informacionperiodo="$infoperi->periodo";
    }
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
    $idaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->pluck("id");
    $idaño = preg_replace('/[\[\]\.\;\" "]+/', '', $idaño);
    $infocolegio=Colegio::where('id',$idcolegio)->get();
      foreach($infocolegio as $info){
            $infocol="$info->espacioscurriculares";
      }
    if($tipodoc=='Grado'){
        $infocol = preg_replace('/[\[\]\.\;\""]+/', '', $infocol);
        $infocol=explode(',', $infocol);
        $contador=count($infocol)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombreespacios[]=espacioscurriculares::where('id',$infocol[$i])->pluck("nombre");
        }
        $nombresgrado=Grado::where('id_docentes',$idpersona)->where('id_anio',$idaño)->where('colegio_id',$idcolegio)->pluck("descripcion");
        if(empty($nombresgrado)){
      return view('notas.buscador',compact('infoaño','nombreespacios','tipodoc','informacionperiodo'));
    }
    else{
    return view('notas.buscador',compact('infoaño','nombreespacios','tipodoc','informacionperiodo','nombresgrado'));
      }
        
    }
    else{
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
    if(empty($nombresgrado)){
      return view('notas.buscador',compact('infoaño','informacionperiodo','tipodoc'));
    }
    else{
    return view('notas.buscador',compact('infoaño','nombresgrado','informacionperiodo','tipodoc'));
      }
    }
   }
  
  public function index(Request $request, Notas $id)
   {
    $idpersona= Auth::user()->idpersona;
    $idusuario= Auth::user()->id;
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
      $añoactivo="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $periodo=$request->periodo;
    $infocole=Colegio::where('id',$idcolegio)->get();
      foreach($infocole as $info){
            $infoco="$info->calinumerica";
            $infocali="$info->calicualitativa";
      }

      if($infoco==NULL)
        {
        $infocali = preg_replace('/[\[\]\.\;\""]+/', '', $infocali);
        $infocali=explode(',', $infocali);
        $contador=count($infocali)-1;
        for ($i=0; $i <= $contador ; $i++) { 

        $calificacion[]=calificacioncualitativa::where('id_calificacion',$infocali[$i])->pluck("orden");

        
        }
        $calificacion= preg_replace('/[\[\]\.\;\""]+/', '', $calificacion);
        rsort($calificacion);
        $contador=count($calificacion)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        
        $cal[]=calificacioncualitativa::where('id_calificacion',$infocali[$i])->pluck("orden");
        }
        rsort($cal);
        for ($i=0; $i <= $contador ; $i++) { 
        $califi[]=calificacioncualitativa::where('orden',$cal[$i])->pluck("codigo");
        $califica[]=calificacioncualitativa::where('orden',$cal[$i])->pluck("calificacion");
        }

        $califi = preg_replace('/[\[\]\.\;\""]+/', '', $califi);
        $califica = preg_replace('/[\[\]\.\;\""]+/', '', $califica);
        } 
        else
        {
        $infoco=explode(',', $infoco);
        $infoco = preg_replace('/[\[\]\.\;\""]+/', '', $infoco);
        $minimo= head($infoco);
        $maximo= last($infoco);
        for ($i=$minimo; $i <= $maximo ; $i++) { 
        $califi[]=$i;
        }
      }
    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $request->validate([
            'grado' => ['required'],
            'periodo' => ['required'],
    ]);
    $criterios=criteriosevaluacion::where('id_usuario', $idusuario)->where('periodo',$periodo)->where('id_grado',$grado)->where('id_año',$descripcionaño)->get();
    $infonotas=Notas::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
    $infoalumnos=$infonotas->unique('nombrealumno','apellidoalumno');
    $infocriterios=$infonotas->unique('criterio');
    $infoinformes=Informes::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
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
    if($infoco==NULL)   {
         if(empty($nombresgrado)){
          return view('notas.index',compact('infoaño','informacionperiodo','grado','periodo','tipodoc','id','infoalumnos','infocriterios','califi','infoinformes','califica','infonotas','infoco','criterios'));     
         }
         else{
         return view('notas.index',compact('infoaño','informacionperiodo','nombresgrado','grado','periodo','tipodoc','id','infoalumnos','infocriterios','califi','infoinformes','califica','infonotas','infoco','criterios'));
        }   
        }
        else  {
        if(empty($nombresgrado)){
         return view('notas.index',compact('infoaño','informacionperiodo','grado','periodo','tipodoc','id','infoalumnos','infocriterios','califi','infoinformes','infonotas','infoco','criterios'));
         }
         else{
            return view('notas.index',compact('infoaño','informacionperiodo','nombresgrado','grado','periodo','tipodoc','id','infoalumnos','infocriterios','califi','infoinformes','infonotas','infoco','criterios'));

         }   
        }
    }
    else{
    $espacio=$request->espacio;
    $request->validate([
            'espacio' => ['required'],
            'periodo' => ['required'],
    ]);
    $infonotas=Notas::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
    $criterios=criteriosevaluacion::where('id_usuario', $idusuario)->where('periodo',$periodo)->where('id_espacio',$espacio)->where('id_año',$descripcionaño)->get();
    $infoalumnos=$infonotas->unique('nombrealumno','apellidoalumno');
    $infocriterios=$infonotas->unique('criterio');
    $infoinformes=Informes::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
    $infocolegio=Colegio::where('id',$idcolegio)->get();
      foreach($infocolegio as $info){
            $infocol="$info->espacioscurriculares";
      }
    $infocol = preg_replace('/[\[\]\.\;\""]+/', '', $infocol);
        $infocol=explode(',', $infocol);
        $contador=count($infocol)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombreespacios[]=espacioscurriculares::where('id',$infocol[$i])->pluck("nombre");
        }
        $nombresgrado=Grado::where('id_docentes',$idpersona)->where('id_anio',$añoactivo)->where('colegio_id',$idcolegio)->pluck("descripcion");
        
    if($infoco==NULL)   {
         return view('notas.index',compact('infoaño','informacionperiodo','periodo','espacio','tipodoc','nombreespacios','infonotas','id','infocriterios','infoalumnos', 'califi','infoinformes','califica','infoco','nombresgrado','criterios'));  

        }
        else  {
         return view('notas.index',compact('infoaño','informacionperiodo','periodo','espacio','tipodoc','nombreespacios','infonotas','id','infocriterios','infoalumnos', 'califi','infoinformes','infoco','nombresgrado','criterios'));  

        }
  }
}
    public function updateobservacion(Request $request,$id_alumno)
    {
       $idcolegio=Auth::user()->colegio_id;
       $infoperiodo=Colegio::where('id',$idcolegio)->get();
       foreach($infoperiodo as $infoperi){
       $informacionperiodo="$infoperi->periodo";
      }
     $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $añoactivo="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $periodo=$request->periodo;
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $alu=Notas::where('id_alumno',$id_alumno)->get();
    foreach($alu as $nombre){
      $nomalu="$nombre->nombrealumno";
      $apealu="$nombre->apellidoalumno";
    }
    $infalumno=Alumno::where('nombrealumno', $nomalu)->where('apellidoalumno',$apealu)->get();
    foreach($infalumno as $informacionalumno){
      $idalumno="$informacionalumno->id";
    }
    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $infonotas=Informes::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck("id_alumno");
    $conta=count($infonotas)-1;
    $data= $request->observacion;
    $idalumnos=Informes::where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck("id_alumno")->unique();
    $idalumnos = preg_replace('/[\[\]\.\;\""]+/', '', $idalumnos);
    $idalumnos=explode(',',$idalumnos);
    for ($i=0; $i <=$conta ; $i++) { 
    $busquedaInformes=Informes::where('id_alumno', $id_alumno)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('docente',Auth::user()->id)->where('periodo',$periodo)->first();
    if($idalumnos[$i]==$id_alumno){
    $busquedaInformes->observacion=$data[$i]; 
    $busquedaInformes->save();
    }
    }
    return redirect()->back()->with('success', 'La síntesis se guardó correctamente.');
    }
    if($tipodoc=='Grado'){
    $infocolegio=Colegio::where('id',$idcolegio)->get();
      foreach($infocolegio as $info){
            $infocol="$info->espacioscurriculares";
      }
        $infocol = preg_replace('/[\[\]\.\;\""]+/', '', $infocol);
        $infocol=explode(',', $infocol);
        $contador=count($infocol)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombreespacios[]=espacioscurriculares::where('id',$infocol[$i])->pluck("nombre");
        }
    $espacio=$request->espacio;
    $infonotas=Informes::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck("id_alumno");
    $conta=count($infonotas)-1;
    $data= $request->observacion;
    $idalumnos=Informes::where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck("id_alumno");
    $idalumnos = preg_replace('/[\[\]\.\;\""]+/', '', $idalumnos);
    $idalumnos=explode(',',$idalumnos);
    for ($i=0; $i <=$conta ; $i++) { 
    $busquedaInformes=Informes::where('id_alumno', $id_alumno)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->first();
    if($idalumnos[$i]==$id_alumno){
    $busquedaInformes->observacion=$data[$i]; 
    $busquedaInformes->save();
    }
    }
    return redirect()->back()->with('success', 'La síntesis se guardó correctamente.');
    }  
  }

  public function updatenota(Request $request,$id_alumno)
    {
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $cali=$request->calificacion;
    $periodo=$request->periodo;
    $idcolegio=Auth::user()->colegio_id;
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $añoactivo="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $infocole=Colegio::where('id',$idcolegio)->get();
      foreach($infocole as $info){
            $infoco="$info->calinumerica";
            $infocali="$info->calicualitativa";
      }
    if($tipodoc=='Grado'){
    $espacio=$request->espacio;
    $grado=Grado::where('id_docentes',$idpersona)->where('id_anio',$añoactivo)->where('colegio_id',$idcolegio)->pluck("descripcion");
    $grado= preg_replace('/[\[\]\.\;\""]+/', '', $grado);
    $infonotas=Informes::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck("id_alumno");
    $infoalumnos=Informes::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
    $infonot=Notas::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
    $infocriterios=$infonot->unique('criterio');
    foreach($infocriterios as $infocrit) 
        {
            $criterio[]=$infocrit->criterio;
        }
    $cantidadnotas=count($cali)-1;          
    $contador=count($criterio);
    for ($i=0;$i<=$cantidadnotas;$i=$i+$contador){
        $elemento=floor($i/$contador);
        for($j=0;$j<$contador;$j++){
            $busquedaNotas=Notas::where('id_alumno',$infonotas[$elemento])->where('criterio',$criterio[$j])->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('docente',Auth::user()->id)->where('periodo',$periodo)->first();
            $busquedaNotas->nota=$cali[$i+$j]; 
            $busquedaNotas->save();
        }
    }
    foreach($infocriterios as $criterio){
        $nombrecriterio[]="$criterio->criterio";
    }

    $contcriterio=count($nombrecriterio)-1;
    for($i=0;$i<=$contcriterio;$i++){
         $pondecriterios[]=CriteriosEvaluacion::where('criterio',$nombrecriterio[$i])->where('id_espacio',$espacio)->where('id_usuario',Auth::user()->id)->where('periodo',$periodo)->pluck("ponderacion");
    }
    $pondecriterios = preg_replace('/[\[\]\.\;\""]+/', '', $pondecriterios);
    $sumaponderacion=array_sum($pondecriterios);
    foreach($infoalumnos as $infoalu){
        $idalumnos[]="$infoalu->id_alumno";
    }
    $contalu=count($idalumnos)-1;
    for ($i=0; $i <=$contalu ; $i++) { 
    $informacionnota[]=Notas::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('id_alumno',$idalumnos[$i])->pluck('nota');
    }

    $contnota=count($informacionnota)-1;
    if ($infoco == NULL) {
    for ($i=0; $i <=$contnota ; $i++) {
    $contotal=count($informacionnota[$i])-1;
    $variable=$informacionnota[$i];
    for ($j=0; $j <=$contotal ; $j++) { 
        $valornota[]=calificacioncualitativa::where('codigo',$variable[$j])->pluck('valor');
    }
    $variable = preg_replace('/[\[\]\\;\""]+/', '', $valornota);
    }
    $cont1=count($variable)-1;
    $cont2=count($pondecriterios)-1;
    $cont3=count($pondecriterios);
    for ($i=0; $i <=$cont1 ; $i=$i+$cont3) { 
         $suma=0;
    for ($j=0; $j <=$cont2 ; $j++) { 
    $suma=$suma+($pondecriterios[$j] * $variable[$i+$j]);
    }
    $array[]=$suma;
    }
    }
    else
    {
    $cont2=count($pondecriterios)-1;
    for ($i=0; $i <=$contnota ; $i++) {
         $suma=0;
    $nota=$informacionnota[$i];
    for ($j=0; $j <=$cont2 ; $j++) { 
    $suma=$suma+($pondecriterios[$j] * $nota[$j]);
    }
    $array[]=$suma;
    }
    }
    $contarray=count($array)-1;
    for($i=0;$i<=$contarray;$i++){
        $calculototal[]=$array[$i]/$sumaponderacion;
    }
    $contadortotal=count($calculototal)-1;
    if($infoco==NULL)
    {
        $infocali = preg_replace('/[\[\]\.\;\""]+/', '', $infocali);
        $infocali=explode(',', $infocali);
        $contador=count($infocali)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $calificacion[]=calificacioncualitativa::where('id_calificacion',$infocali[$i])->pluck("codigo");
        }
        $contadorcalificacion=count($calificacion)-1;
        $calificacion = preg_replace('/[\[\]\.\;\""]+/', '', $calificacion);
        foreach($infoalumnos as $informacion){
        for($i=0;$i<=$contadortotal;$i++){
        if($informacion->id_alumno==$infonotas[$i]){
        if(1<=$calculototal[$i] and $calculototal[$i]<=3){
        $infonota[]='NS';
    }
    elseif(3<$calculototal[$i] and $calculototal[$i]<=5){
        for($j=0;$j<=$contadorcalificacion;$j++){
        if($calificacion[$j]=='S'){
            $infonota[]='S';
        }
        if($calificacion[$j]=='I'){
            $infonota[]='I';
        }
    }
    } 
    elseif(5<$calculototal[$i] and $calculototal[$i]<=7){
        for($j=0;$j<=$contadorcalificacion;$j++){
        if($calificacion[$j]=='R'){
            $infonota[]='R';
        }
        if($calificacion[$j]=='B'){
            $infonota[]='B';
        }
    }
    }
    elseif(7<$calculototal[$i] and $calculototal[$i]<=9){
        $infonota[]='MB';
    } 
    elseif(9<$calculototal[$i]){
        for($j=0;$j<=$contadorcalificacion;$j++){
        if($calificacion[$j]=='E'){
            $infonota[]='E';
        }
        if($calificacion[$j]=='SB'){
            $infonota[]='SB';
        }
    }
}
$informacion->nota=$infonota[$i];
$informacion->save();
$listadonotas=NotaFinal::where('docente',Auth::user()->id)->where('espacio',$espacio)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('id_alumno',$idalumnos[$i])->get();
if($listadonotas->isEmpty()){
$notafinal=new NotaFinal();
$notafinal->id_alumno=$idalumnos[$i];
$notafinal->docente=Auth::user()->id;
$notafinal->grado=$grado;
$notafinal->espacio=$espacio;
$notafinal->año=$añoactivo;
$notafinal->colegio_id=$idcolegio;
$notafinal->save();
}
}
}
}
}
    else
    {
    foreach($infoalumnos as $informacion){
    for($i=0;$i<=$contadortotal;$i++){
        if($informacion->id_alumno==$infonotas[$i]){
        $redondeo[$i]= round($calculototal[$i]);
        $informacion->nota=$redondeo[$i];
        $informacion->save();
$listadonotas=NotaFinal::where('docente',Auth::user()->id)->where('espacio',$espacio)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('id_alumno',$idalumnos[$i])->get();
if($listadonotas->isEmpty()){
$notafinal=new NotaFinal();
$notafinal->id_alumno=$idalumnos[$i];
$notafinal->docente=Auth::user()->id;
$notafinal->grado=$grado;
$notafinal->espacio=$espacio;
$notafinal->año=$añoactivo;
$notafinal->colegio_id=$idcolegio;
$notafinal->save();
    }
}
    }   
    }
    }

    return redirect()->back()->with('success', 'Las valoraciones se guardaron correctamente.');
    }
    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $espacio=Docente::where('id',$idpersona)->pluck("especialidad");
    $espacio = preg_replace('/[\[\]\.\;\""]+/', '', $espacio);
    $infonotas=Informes::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck("id_alumno");
    $infoalumnos=Informes::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
    $infonot=Notas::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
    $infocriterios=$infonot->unique('criterio');
    foreach($infocriterios as $infocrit) 
        {
            $criterio[]=$infocrit->criterio;
        }
    $cantidadnotas=count($cali)-1;          
    $contador=count($criterio);
    for ($i=0;$i<=$cantidadnotas;$i=$i+$contador){
        $elemento=floor($i/$contador);
        for($j=0;$j<$contador;$j++){
            $busquedaNotas=Notas::where('id_alumno',$infonotas[$elemento])->where('criterio',$criterio[$j])->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('docente',Auth::user()->id)->where('periodo',$periodo)->first();
            $busquedaNotas->nota=$cali[$i+$j]; 
            $busquedaNotas->save();
        }
    }
    foreach($infocriterios as $criterio){
        $nombrecriterio[]="$criterio->criterio";
    }
    $contcriterio=count($nombrecriterio)-1;
    for($i=0;$i<=$contcriterio;$i++){
         $pondecriterios[]=CriteriosEvaluacion::where('criterio',$nombrecriterio[$i])->where('id_grado',$grado)->where('id_usuario',Auth::user()->id)->where('periodo',$periodo)->pluck("ponderacion");
    }
    $pondecriterios = preg_replace('/[\[\]\.\;\""]+/', '', $pondecriterios);
    $sumaponderacion=array_sum($pondecriterios);
    foreach($infoalumnos as $infoalu){
        $idalumnos[]="$infoalu->id_alumno";
    }
    $contalu=count($idalumnos)-1;
    for ($i=0; $i <=$contalu ; $i++) { 
    $informacionnota[]=Notas::where('docente',Auth::user()->id)->where('periodo',$periodo)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('id_alumno',$idalumnos[$i])->pluck('nota');
    }
    $contnota=count($informacionnota)-1;
    if ($infoco == NULL) {
    for ($i=0; $i <=$contnota ; $i++) {
    $contotal=count($informacionnota[$i])-1;
    $variable=$informacionnota[$i];
    for ($j=0; $j <=$contotal ; $j++) { 
        $valornota[]=calificacioncualitativa::where('codigo',$variable[$j])->pluck('valor');
    }
    $variable = preg_replace('/[\[\]\\;\""]+/', '', $valornota);
    }
    $cont1=count($variable)-1;
    $cont2=count($pondecriterios)-1;
    $cont3=count($pondecriterios);
    for ($i=0; $i <=$cont1 ; $i=$i+$cont3) {
    $suma=0;
    for ($j=0; $j <=$cont2 ; $j++) { 
    $suma=$suma+($pondecriterios[$j] * $variable[$i+$j]);
    }
    $array[]=$suma;
    }
    }
    else
    {
    $cont2=count($pondecriterios)-1;
    for ($i=0; $i <=$contnota ; $i++) {
         $suma=0;
    $nota=$informacionnota[$i];
    for ($j=0; $j <=$cont2 ; $j++) { 
        
    $suma=$suma+($pondecriterios[$j] * $nota[$j]);
    }
    $array[]=$suma;
    }
    }
    $contarray=count($array)-1;
    for($i=0;$i<=$contarray;$i++){
        $calculototal[]=$array[$i]/$sumaponderacion;
    }
    $contadortotal=count($calculototal)-1;
    if($infoco==NULL)
    {
        $infocali = preg_replace('/[\[\]\.\;\""]+/', '', $infocali);
        $infocali=explode(',', $infocali);
        $contador=count($infocali)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $calificacion[]=calificacioncualitativa::where('id_calificacion',$infocali[$i])->pluck("codigo");
        }
        $contadorcalificacion=count($calificacion)-1;
        $calificacion = preg_replace('/[\[\]\.\;\""]+/', '', $calificacion);
        foreach($infoalumnos as $informacion){
        for($i=0;$i<=$contadortotal;$i++){
        if($informacion->id_alumno==$infonotas[$i]){
        if(1<=$calculototal[$i] and $calculototal[$i]<=3){
        $infonota[]='NS';
    }
    elseif(3<$calculototal[$i] and $calculototal[$i]<=5){
        for($j=0;$j<=$contadorcalificacion;$j++){
        if($calificacion[$j]=='S'){
            $infonota[]='S';
        }
        if($calificacion[$j]=='I'){
            $infonota[]='I';
        }
    }
    } 
    elseif(5<$calculototal[$i] and $calculototal[$i]<=7){
        for($j=0;$j<=$contadorcalificacion;$j++){
        if($calificacion[$j]=='R'){
            $infonota[]='R';
        }
        if($calificacion[$j]=='B'){
            $infonota[]='B';
        }
    }
    }
    elseif(7<$calculototal[$i] and $calculototal[$i]<=9){
        $infonota[]='MB';
    } 
    elseif(9<$calculototal[$i]){
        for($j=0;$j<=$contadorcalificacion;$j++){
        if($calificacion[$j]=='E'){
            $infonota[]='E';
        }
        if($calificacion[$j]=='SB'){
            $infonota[]='SB';
        }
    }
}
$informacion->nota=$infonota[$i];
$informacion->save();
$listadonotas=NotaFinal::where('docente',Auth::user()->id)->where('espacio',$espacio)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('id_alumno',$idalumnos[$i])->get();
if($listadonotas->isEmpty()){
$notafinal=new NotaFinal();
$notafinal->id_alumno=$idalumnos[$i];
$notafinal->docente=Auth::user()->id;
$notafinal->grado=$grado;
$notafinal->espacio=$espacio;
$notafinal->año=$añoactivo;
$notafinal->colegio_id=$idcolegio;
$notafinal->save();
}
}
}
}
}
    else
    {
    foreach($infoalumnos as $informacion){
    for($i=0;$i<=$contadortotal;$i++){
        if($informacion->id_alumno==$infonotas[$i]){
        $redondeo[$i]= round($calculototal[$i]);
        $informacion->nota=$redondeo[$i];
        $informacion->save();
    }
    }   
    }
$listadonotas=NotaFinal::where('docente',Auth::user()->id)->where('espacio',$espacio)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('id_alumno',$idalumnos[$i])->get();
if($listadonotas->isEmpty()){
$notafinal=new NotaFinal();
$notafinal->id_alumno=$idalumnos[$i];
$notafinal->docente=Auth::user()->id;
$notafinal->grado=$grado;
$notafinal->espacio=$espacio;
$notafinal->año=$añoactivo;
$notafinal->colegio_id=$idcolegio;
$notafinal->save();
    }
}

    return redirect()->back()->with('success', 'Las valoraciones se guardaron correctamente.');
    }
}

public function buscadornotasfinales()
   {
    $idcolegio=Auth::user()->colegio_id;
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $infoperiodo=Colegio::where('id',$idcolegio)->get();
    foreach($infoperiodo as $infoperi){
      $informacionperiodo="$infoperi->periodo";
    }
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
    $idaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->pluck("id");
    $idaño = preg_replace('/[\[\]\.\;\" "]+/', '', $idaño);
    $infocolegio=Colegio::where('id',$idcolegio)->get();
      foreach($infocolegio as $info){
            $infocol="$info->espacioscurriculares";
      }
    if($tipodoc=='Grado'){
        $infocol = preg_replace('/[\[\]\.\;\""]+/', '', $infocol);
        $infocol=explode(',', $infocol);
        $contador=count($infocol)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombreespacios[]=espacioscurriculares::where('id',$infocol[$i])->pluck("nombre");
        }
         $nombresgrado=Grado::where('id_docentes',$idpersona)->where('id_anio',$idaño)->where('colegio_id',$idcolegio)->pluck("descripcion");
        if(empty($nombresgrado)){
      return view('notas.buscadornotasfinales',compact('infoaño','nombreespacios','tipodoc','informacionperiodo'));
    }
    else{
    return view('notas.buscadornotasfinales',compact('infoaño','nombreespacios','tipodoc','informacionperiodo','nombresgrado'));
      }
      
    }
    else{
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
      if(empty($nombresgrado)){
      return view('notas.buscadornotasfinales',compact('infoaño','informacionperiodo','tipodoc'));  
      }
      else{
      return view('notas.buscadornotasfinales',compact('infoaño','nombresgrado','informacionperiodo','tipodoc'));
  }
      }
   }
   public function listadonotasfinales(Request $request, Notas $id)
   {
    $idpersona= Auth::user()->idpersona;
    $idusuario= Auth::user()->id;
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
    $añoactivo="$activo->id";
    $descripcionaño="$activo->descripcion";
    }
    $infocole=Colegio::where('id',$idcolegio)->get();
      foreach($infocole as $info){
            $infoco="$info->calinumerica";
            $infocali="$info->calicualitativa";
    }
    if($infoco==NULL)
    {
    $infocali = preg_replace('/[\[\]\.\;\""]+/', '', $infocali);
    $infocali=explode(',', $infocali);
    $contador=count($infocali)-1;
    for ($i=0; $i <= $contador ; $i++) { 
    $calificacion[]=calificacioncualitativa::where('id_calificacion',$infocali[$i])->pluck("orden");
    }
    $calificacion= preg_replace('/[\[\]\.\;\""]+/', '', $calificacion);
    rsort($calificacion);
    $contador=count($calificacion)-1;
    for ($i=0; $i <= $contador ; $i++) { 
        
        $cal[]=calificacioncualitativa::where('id_calificacion',$infocali[$i])->pluck("orden");
        }
        rsort($cal);
        for ($i=0; $i <= $contador ; $i++) { 
        $califi[]=calificacioncualitativa::where('orden',$cal[$i])->pluck("codigo");
        $califica[]=calificacioncualitativa::where('orden',$cal[$i])->pluck("calificacion");
        }
    $califi = preg_replace('/[\[\]\.\;\""]+/', '', $califi);
    $califica = preg_replace('/[\[\]\.\;\""]+/', '', $califica);
    } 
    else
    {
    $infoco=explode(',', $infoco);
    $infoco = preg_replace('/[\[\]\.\;\""]+/', '', $infoco);
    $minimo= head($infoco);
    $maximo= last($infoco);
    for ($i=$minimo; $i <= $maximo ; $i++) { 
    $califi[]=$i;
    }
    }

    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $request->validate([
            'grado' => ['required'],
    ]);
    $criterios=criteriosevaluacion::where('id_usuario', $idusuario)->where('id_año',$descripcionaño)->where('id_grado',$grado)->get();
   $infoinformes=Informes::where('docente',Auth::user()->id)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->paginate(5);
    $infoalumnos=$infoinformes->unique('id_alumno');
    $idalumnos=$infoalumnos->pluck('id_alumno');
    $notafinal=NotaFinal::where('docente',Auth::user()->id)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->paginate(5);
    $notafinal=$notafinal->unique('id_alumno');
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
    $contadoralu=count($idalumnos)-1;
    for ($i=0;$i<=$contadoralu;$i++) { 
    $datosalumnos=Alumno::where('id',$idalumnos[$i])->get();
    foreach($datosalumnos as $datoalumno){
    $nombresalumnos[$i]=$datoalumno->nombrecompleto;
    }
    }
    if($infoco==NULL){
         return view('notas.listadofinales',compact('infoaño','informacionperiodo','nombresgrado','grado','tipodoc','id','infoalumnos','califi','infoinformes','califica','notafinal','infoco','idalumnos','nombresalumnos','criterios'));   
    }
    else{
    return view('notas.listadofinales',compact('infoaño','informacionperiodo','nombresgrado','grado','tipodoc','id','infoalumnos','califi','infoinformes','infoco','notafinal','idalumnos','nombresalumnos','criterios'));   
        }
    }
    else{
    $espacio=$request->espacio;
    $request->validate([
            'espacio' => ['required'],
    ]);
    $criterios=criteriosevaluacion::where('id_usuario', $idusuario)->where('id_año',$descripcionaño)->where('id_espacio',$espacio)->get();
    $infoinformes=Informes::where('docente',Auth::user()->id)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
    $infoalumnos=$infoinformes->unique('id_alumno');
    $idalumnos=$infoalumnos->pluck('id_alumno');
    $notafinal=NotaFinal::where('docente',Auth::user()->id)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->get();
    $notafinal=$notafinal->unique('id_alumno');
    $contadoralu=count($idalumnos)-1;
    for ($i=0;$i<=$contadoralu;$i++) { 
    $datosalumnos=Alumno::where('id',$idalumnos[$i])->get();
    foreach($datosalumnos as $datoalumno){
    $nombresalumnos[$i]=$datoalumno->nombrecompleto;
    }
    }
    $infocolegio=Colegio::where('id',$idcolegio)->get();
    foreach($infocolegio as $info){
    $infocol="$info->espacioscurriculares";
    }
    $infocol = preg_replace('/[\[\]\.\;\""]+/', '', $infocol);
    $infocol=explode(',', $infocol);
    $contador=count($infocol)-1;
    for ($i=0; $i <= $contador ; $i++) { 
    $nombreespacios[]=espacioscurriculares::where('id',$infocol[$i])->pluck("nombre");
        }
    $nombresgrado=Grado::where('id_docentes',$idpersona)->where('id_anio',$añoactivo)->where('colegio_id',$idcolegio)->pluck("descripcion");
    if($infoco==NULL){
        if(sizeof($criterios)==0){
        return view('notas.listadofinales',compact('infoaño','informacionperiodo','espacio','tipodoc','nombreespacios','id','idalumnos','califi','infoinformes','califica','infoco','notafinal','criterios','nombresgrado'));      
        }
        else{
        return view('notas.listadofinales',compact('infoaño','informacionperiodo','espacio','tipodoc','nombreespacios','id','idalumnos','califi','infoinformes','califica','infoco','notafinal','criterios','nombresgrado','nombresalumnos'));    
        }
         
    }
    else{
    if(sizeof($criterios)==0){
    return view('notas.listadofinales',compact('infoaño','informacionperiodo','espacio','tipodoc','nombreespacios','id','idalumnos', 'califi','infoinformes','infoco','notafinal','criterios','nombresgrado'));    
    }
    else{
    return view('notas.listadofinales',compact('infoaño','informacionperiodo','espacio','tipodoc','nombreespacios','id','nombresalumnos','idalumnos', 'califi','infoinformes','infoco','notafinal','criterios','nombresgrado'));       
    }
    
        }
  }
}
public function updateobservacionfinal(Request $request,$id_alumnos)
    {
       $idcolegio=Auth::user()->colegio_id;
       $infoperiodo=Colegio::where('id',$idcolegio)->get();
       foreach($infoperiodo as $infoperi){
       $informacionperiodo="$infoperi->periodo";
       }
     $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $añoactivo="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    $alu=Notas::where('id_alumno',$id_alumnos)->get();
    foreach($alu as $nombre){
      $nomalu="$nombre->nombrealumno";
      $apealu="$nombre->apellidoalumno";
    }
    $infalumno=Alumno::where('nombrealumno', $nomalu)->where('apellidoalumno',$apealu)->get();
    foreach($infalumno as $informacionalumno){
      $idalumno="$informacionalumno->id";
    }
    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $data= $request->observacion;
    $contador=count($data)-1;
    $idalumnos=NotaFinal::where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck("id_alumno");
    $idalumnos = preg_replace('/[\[\]\.\;\""]+/', '', $idalumnos);
    $idalumnos=explode(',',$idalumnos);
    for ($i=0; $i <=$contador ; $i++) { 
    $busquedaInformes=NotaFinal::where('id_alumno', $id_alumnos)->where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->where('docente',Auth::user()->id)->first();
    if($idalumnos[$i]==$id_alumnos){
    $busquedaInformes->observacion=$data[$i]; 
    $busquedaInformes->save();
    }
    }
     return redirect()->back()->with('success', 'La síntesis se guardó correctamente.');
    }
    if($tipodoc=='Grado'){
    $infocolegio=Colegio::where('id',$idcolegio)->get();
      foreach($infocolegio as $info){
            $infocol="$info->espacioscurriculares";
      }
        $infocol = preg_replace('/[\[\]\.\;\""]+/', '', $infocol);
        $infocol=explode(',', $infocol);
        $contador=count($infocol)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombreespacios[]=espacioscurriculares::where('id',$infocol[$i])->pluck("nombre");
        }
    $espacio=$request->espacio;
    $data= $request->observacion;
    $contador=count($data)-1;
    $idalumnos=NotaFinal::where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck("id_alumno");
    $idalumnos = preg_replace('/[\[\]\.\;\""]+/', '', $idalumnos);
    $idalumnos=explode(',',$idalumnos);
    for ($i=0; $i <=$contador ; $i++) { 
    $busquedaInformes=NotaFinal::where('id_alumno', $id_alumnos)->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->first();
    if($idalumnos[$i]==$id_alumnos){
    $busquedaInformes->observacion=$data[$i]; 
    $busquedaInformes->save();
    }
    }
    return redirect()->back()->with('success', 'La síntesis se guardó correctamente.');
    }  
  }
public function updatenotafinal(Request $request)
    {
       $idcolegio=Auth::user()->colegio_id;
       $infoperiodo=Colegio::where('id',$idcolegio)->get();
       foreach($infoperiodo as $infoperi){
       $informacionperiodo="$infoperi->periodo";
       }
     $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $añoactivo="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $idpersona= Auth::user()->idpersona;
    $tipodocente=Docente::where('id',$idpersona)->get();
    foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
    }
    if($tipodoc!='Grado'){
    $grado=$request->grado;
    $alumnonota=NotaFinal::where('grado',$grado)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck('id_alumno')->unique();
    $notafinal= $request->calificacion;
    $contador=count($notafinal)-1;
    for ($i=0; $i <=$contador ; $i++) {
    $busquedaInformes=NotaFinal::where('id_alumno', $alumnonota[$i])->where('grado',$grado)->where('colegio_id',$idcolegio)->where('docente',Auth::user()->id)->where('año',$añoactivo)->first();
       if($notafinal[$i]!=null){
    $busquedaInformes->nota=$notafinal[$i]; 
    $busquedaInformes->save();
    }
    }
    return redirect()->back()->with('success', 'Las valoraciones se guardaron correctamente.');
    }
    if($tipodoc=='Grado'){
    $infocolegio=Colegio::where('id',$idcolegio)->get();
      foreach($infocolegio as $info){
            $infocol="$info->espacioscurriculares";
      }
        $infocol = preg_replace('/[\[\]\.\;\""]+/', '', $infocol);
        $infocol=explode(',', $infocol);
        $contador=count($infocol)-1;
        for ($i=0; $i <= $contador ; $i++) { 
        $nombreespacios[]=espacioscurriculares::where('id',$infocol[$i])->pluck("nombre");
        }
    $espacio=$request->espacio;
    $alumnonota=NotaFinal::where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->pluck('id_alumno');
    $notafinal= $request->calificacion;
    $contador=count($notafinal)-1;
    for ($i=0; $i <=$contador ; $i++) {
    $busquedaInformes=NotaFinal::where('id_alumno', $alumnonota[$i])->where('espacio',$espacio)->where('colegio_id',$idcolegio)->where('año',$añoactivo)->first();
       if($notafinal[$i]!=null){
    $busquedaInformes->nota=$notafinal[$i]; 
    $busquedaInformes->save();
    }
    }
    return redirect()->back()->with('success', 'Las valoraciones se guardaron correctamente.');
    }  
  }
}
