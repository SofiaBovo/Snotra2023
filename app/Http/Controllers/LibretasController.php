<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;
use ZipArchive;
use App\Models\Año;
use App\Models\Docente;
use App\Models\Colegio;
use App\Models\Grado;
use App\Models\Alumno;
use App\Models\Informes;
use App\Models\Familia;
use Mail;

class LibretasController extends Controller
{
    public function buscador()
    {
    $idcolegio=Auth::user()->colegio_id;
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $nombresgrado=Grado::where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infoperiodo=Colegio::where('id',$idcolegio)->get();
    foreach($infoperiodo as $infoperi){
      $informacionperiodo="$infoperi->periodo";
    }
    return view('libretas.buscador',compact('infoaño','nombresgrado','informacionperiodo')); 
    }

    public function index(Request $request)
    {
    $grado=$request->grado;
    $periodo=$request->periodo;
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
    $nombresgrado=Grado::where('colegio_id',$idcolegio)->where('id_anio',$idaño)->pluck('descripcion');
    $infogrado=Informes::where('colegio_id',$idcolegio)->where('año',$idaño)->where('grado',$grado)->where('periodo',$periodo)->get();
    $infogrado=$infogrado->unique('id_alumno');
    $infogrado=$infogrado->pluck('id_alumno');

  if(sizeof($infogrado)==0) 
  {
    if($informacionperiodo=='Bimestre' and $periodo=='Cuarta Etapa'){
    return view('libretas.informefinal',compact('infoaño','informacionperiodo','grado','periodo','infogrado','descripcionaño'));
    }
    if($informacionperiodo=='Trimestre' and $periodo=='Tercera Etapa'){
    return view('libretas.informefinal',compact('infoaño','informacionperiodo','grado','periodo','infogrado','descripcionaño'));
    }
    if($informacionperiodo=='Cuatrimestre' and $periodo=='Segunda Etapa'){
    return view('libretas.informefinal',compact('infoaño','informacionperiodo','grado','periodo','infogrado','descripcionaño'));
    }
    if($informacionperiodo=='Semestre' and $periodo=='Primera Etapa'){
    return view('libretas.informefinal',compact('infoaño','informacionperiodo','grado','periodo','infogrado','descripcionaño'));
    }
    return view('libretas.listadoalumnos',compact('infoaño','informacionperiodo','grado','periodo','infogrado','descripcionaño'));
  }
  else
  {
   $infogrado = preg_replace('/[\[\]\.\;\""]+/', '', $infogrado);
    $infogrado=explode(',',$infogrado);
    $contador=count($infogrado)-1;
    for ($i=0; $i <=$contador ; $i++) { 
        $nombrealumno[]=Alumno::where('id',$infogrado[$i])->pluck('nombrealumno');
        $apellidoalumno[]=Alumno::where('id',$infogrado[$i])->pluck('apellidoalumno');
        $idalumno[]=Alumno::where('id',$infogrado[$i])->pluck('id');
    }
    $nombrealumno = preg_replace('/[\[\]\.\;\" "]+/', '', $nombrealumno);
    $apellidoalumno = preg_replace('/[\[\]\.\;\" "]+/', '', $apellidoalumno);
    $idalumno = preg_replace('/[\[\]\.\;\" "]+/', '', $idalumno);
    if($informacionperiodo=='Bimestre' and $periodo=='Cuarta Etapa'){
    return view('libretas.informefinal',compact('infoaño','informacionperiodo','nombrealumno','nombresgrado','apellidoalumno','grado','periodo','idalumno','infogrado','descripcionaño'));
    }
    if($informacionperiodo=='Trimestre' and $periodo=='Tercera Etapa'){
    return view('libretas.informefinal',compact('infoaño','informacionperiodo','nombrealumno','nombresgrado','apellidoalumno','grado','periodo','idalumno','infogrado','descripcionaño'));
    }
    if($informacionperiodo=='Cuatrimestre' and $periodo=='Segunda Etapa'){
    return view('libretas.informefinal',compact('infoaño','informacionperiodo','nombrealumno','nombresgrado','apellidoalumno','grado','periodo','idalumno','infogrado','descripcionaño'));
    }
    if($informacionperiodo=='Semestre' and $periodo=='Segunda Etapa'){
    return view('libretas.informefinal',compact('infoaño','informacionperiodo','nombrealumno','nombresgrado','apellidoalumno','grado','periodo','idalumno','infogrado','descripcionaño'));
    }
    return view('libretas.listadoalumnos',compact('infoaño','informacionperiodo','nombrealumno','nombresgrado','apellidoalumno','grado','periodo','idalumno','infogrado','descripcionaño'));
    }
    }
    public function generarlibreta(Request $request, $nombrecompleto)
    {
    $periodo=$request->periodo;
    $pdf = \PDF::loadView('libretas.pdf', compact('nombrecompleto','periodo'));
    return $pdf->download('InformeEscolar'.'-'.$nombrecompleto.'.pdf');
    }

    public function informefinal(Request $request, $nombrecompleto)
    {
    $periodo=$request->periodo;
    $idcolegio=Auth::user()->colegio_id;
    $infoperiodo=Colegio::where('id',$idcolegio)->get();
    foreach($infoperiodo as $infoperi){
      $informacionperiodo="$infoperi->periodo";
    }
    $pdf = \PDF::loadView('libretas.pdfinformefinal', compact('nombrecompleto','informacionperiodo','periodo'));
    return $pdf->download('InformeFinal'.'-'.$nombrecompleto.'.pdf');
    }

    public function compartirinforme(Request $request, $nombrecompleto){
    $idcolegio=Auth::user()->colegio_id;
    $infoperiodo=Colegio::where('id',$idcolegio)->get();
    foreach($infoperiodo as $infoperi){
      $informacionperiodo="$infoperi->periodo";
    }
    $periodo=$request->periodo;
    $idalumno=$request->idalumno;
    $nombrecompleto=$request->nombrecompleto;
    $nombrecolegio=$request->nombrecolegio;
    $direccioncolegio=$request->direccioncolegio;
    $localidadcolegio=$request->localidadcolegio;
    $provinciacolegio=$request->provinciacolegio;
    $telefonocolegio=$request->telefonocolegio;
    $emailcolegio=$request->emailcolegio;
    $gradoalumno=$request->gradoalumno;
    $descripcionaño=$request->descripcionaño;
    $idfamilia=Alumno::where('id',$idalumno)->pluck('familias_id');
    $idfamilia = preg_replace('/[\[\]\.\;\" "]+/', '', $idfamilia);
    $emailfamilia=Familia::where('id',$idfamilia)->pluck('email');
    $emailfamilia = preg_replace('/[\[\]\\;\" "]+/', '', $emailfamilia);
    $nombrefamilia=Familia::where('id',$idfamilia)->pluck('nombrefamilia');
    $nombrefamilia = preg_replace('/[\[\]\\;\" "]+/', '', $nombrefamilia);
    $apellidofamilia=Familia::where('id',$idfamilia)->pluck('apellidofamilia');
    $apellidofamilia = preg_replace('/[\[\]\\;\" "]+/', '', $apellidofamilia);
    if($informacionperiodo=='Bimestre' and $periodo=='Cuarta Etapa'){
    $pdf = \PDF::loadView('libretas.pdfinformefinal', compact('nombrecompleto','periodo','informacionperiodo'));
    Mail::send('emails/templates/send-invoice2', $request->all(), function ($mail) use ($pdf,$nombrecompleto,$emailfamilia) {
    $mail->from('snotraeducacion@gmail.com','Snotra');
    $mail->to($emailfamilia);
    $mail->subject('Informe escolar de '. $nombrecompleto);
    $mail->attachData($pdf->output(), 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    });
    }
    elseif($informacionperiodo=='Trimestre' and $periodo=='Tercera Etapa'){
    $pdf = \PDF::loadView('libretas.pdfinformefinal', compact('nombrecompleto','periodo','informacionperiodo'));
    Mail::send('emails/templates/send-invoice2', $request->all(), function ($mail) use ($pdf,$nombrecompleto,$emailfamilia) {
    $mail->from('snotraeducacion@gmail.com','Snotra');
    $mail->to($emailfamilia);
    $mail->subject('Informe escolar de '. $nombrecompleto);
    $mail->attachData($pdf->output(), 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    });
    }
    elseif($informacionperiodo=='Cuatrimestre' and $periodo=='Segunda Etapa'){
    $pdf = \PDF::loadView('libretas.pdfinformefinal', compact('nombrecompleto','periodo','informacionperiodo'));
    Mail::send('emails/templates/send-invoice2', $request->all(), function ($mail) use ($pdf,$nombrecompleto,$emailfamilia) {
    $mail->from('snotraeducacion@gmail.com','Snotra');
    $mail->to($emailfamilia);
    $mail->subject('Informe escolar de '. $nombrecompleto);
    $mail->attachData($pdf->output(), 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    });
    }
    elseif($informacionperiodo=='Semestre' and $periodo=='Segunda Etapa'){
    $pdf = \PDF::loadView('libretas.pdfinformefinal', compact('nombrecompleto','periodo','informacionperiodo'));
    Mail::send('emails/templates/send-invoice2', $request->all(), function ($mail) use ($pdf,$nombrecompleto,$emailfamilia) {
    $mail->from('snotraeducacion@gmail.com','Snotra');
    $mail->to($emailfamilia);
    $mail->subject('Informe escolar de '. $nombrecompleto);
    $mail->attachData($pdf->output(), 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    });
    }
    else{
    $pdf = \PDF::loadView('libretas.pdf', compact('nombrecompleto','periodo','informacionperiodo'));
    Mail::send('emails/templates/send-invoice', $request->all(), function ($mail) use ($pdf,$nombrecompleto,$emailfamilia) {
    $mail->from('snotraeducacion@gmail.com','Snotra');
    $mail->to($emailfamilia);
    $mail->subject('Informe escolar de '. $nombrecompleto);
    $mail->attachData($pdf->output(), 'InformeEscolar'.'-'.$nombrecompleto.'.pdf');
    });
    }
    return back()->with('success', 'El informe se ha compartido correctamente a '. $nombrefamilia.' '.$apellidofamilia.' '.'('.$emailfamilia.')'.'.');
    }
    public function generartodosinformes(Request $request){ 
    $grado=$request->grado;
    $periodo=$request->periodo;
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
    $nombre=Alumno::where('grado',$grado)->where('colegio_id',$idcolegio)->pluck('nombrecompleto');
    $nombre = preg_replace('/[\[\]\.\;\""]+/', '', $nombre);
    $nombre=explode(',',$nombre);
    $contadoralumnos=count($nombre)-1;
    $zipfile = new ZipArchive();
    $zipfile->open(storage_path('app/public/archivos/Informes'.'-'.$grado.'.zip'), ZipArchive::CREATE);
    if($informacionperiodo=='Bimestre' and $periodo=='Cuarta Etapa'){
    for ($i=0; $i <=$contadoralumnos ; $i++) { 
    $nombrecompleto=$nombre[$i];
    $pdf = \PDF::loadView('libretas.pdfinformefinal', compact('nombrecompleto','periodo','informacionperiodo'))
        ->save(storage_path('app/public/archivos/') . 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    $zipfile->addFile(storage_path('app/public/archivos/InformeFinal'.'-'.$nombrecompleto.'.pdf'), 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    }
    }
    elseif($informacionperiodo=='Trimestre' and $periodo=='Tercera Etapa'){
    for ($i=0; $i <=$contadoralumnos ; $i++) { 
    $nombrecompleto=$nombre[$i];
    $pdf = \PDF::loadView('libretas.pdfinformefinal', compact('nombrecompleto','periodo','informacionperiodo'))
    ->save(storage_path('app/public/archivos/') . 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    $zipfile->addFile(storage_path('app/public/archivos/InformeFinal'.'-'.$nombrecompleto.'.pdf'), 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    }
    }
    elseif($informacionperiodo=='Cuatrimestre' and $periodo=='Segunda Etapa'){
    for ($i=0; $i <=$contadoralumnos ; $i++) { 
    $nombrecompleto=$nombre[$i];
    $pdf = \PDF::loadView('libretas.pdfinformefinal', compact('nombrecompleto','periodo','informacionperiodo'))
        ->save(storage_path('app/public/archivos/') . 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    $zipfile->addFile(storage_path('app/public/archivos/InformeFinal'.'-'.$nombrecompleto.'.pdf'), 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    }
    }
    elseif($informacionperiodo=='Semestre' and $periodo=='Segunda Etapa'){
    for ($i=0; $i <=$contadoralumnos ; $i++) { 
    $nombrecompleto=$nombre[$i];
    $pdf = \PDF::loadView('libretas.pdfinformefinal', compact('nombrecompleto','periodo','informacionperiodo'))
        ->save(storage_path('app/public/archivos/') . 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    $zipfile->addFile(storage_path('app/public/archivos/InformeFinal'.'-'.$nombrecompleto.'.pdf'), 'InformeFinal'.'-'.$nombrecompleto.'.pdf');
    }
    }
    else{
    for ($i=0; $i <=$contadoralumnos ; $i++) { 
    $nombrecompleto=$nombre[$i];
    $pdf = \PDF::loadView('libretas.pdf', compact('nombrecompleto','periodo'))
        ->save(storage_path('app/public/archivos/') . 'InformeEscolar'.'-'.$nombrecompleto.'.pdf');
    $zipfile->addFile(storage_path('app/public/archivos/InformeEscolar'.'-'.$nombrecompleto.'.pdf'), 'InformeEscolar'.'-'.$nombrecompleto.'.pdf');
    }
    }
    $zipfile->close();
    return response()->download(storage_path('app/public/archivos/Informes'.'-'.$grado.'.zip'));
}
}