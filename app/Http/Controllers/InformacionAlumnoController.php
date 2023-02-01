<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Año;
use App\Models\Docente;
use App\Models\Colegio;
use App\Models\Grado;
use App\Models\Alumno;
use App\Models\Informes;
use App\Models\espacioscurriculares;
use App\Models\NotaFinal;

class InformacionAlumnoController extends Controller
{
public function index()
    {
    $idcolegio=Auth::user()->colegio_id;
    $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
     foreach($infoaño as $activo){
      $idaño="$activo->id";
      $descripcionaño="$activo->descripcion";
    }
    $idfamilia=Auth::user()->idpersona;
    $idalumno=Alumno::where('familias_id',$idfamilia)->pluck('id');
    $contadoralumnos=count($idalumno)-1;
    for($i=0;$i<=$contadoralumnos;$i++){
    $informes[]=Informes::where('id_alumno',$idalumno[$i])->get();
    $informesfinales[]=NotaFinal::where('id_alumno',$idalumno[$i])->get();
    }
    $infocolegio=Colegio::where('id',$idcolegio)->pluck("espacioscurriculares");
    $infocolegio = preg_replace('/[\[\]\.\;\" "]+/', '', $infocolegio);
    $infocolegio = str_replace('\\','',$infocolegio); 
    $infocolegio=explode(',',$infocolegio);
    $contadorespacios=count($infocolegio)-1;
    for ($i=0; $i <=$contadorespacios ; $i++) { 
    $nombreespacio[]=espacioscurriculares::where('id',$infocolegio[$i])->pluck("nombre");
    }
    $nombreespacio = preg_replace('/[\[\]\.\;\""]+/', '', $nombreespacio);
    $informacionperiodo=Colegio::where('id',$idcolegio)->pluck("periodo");
    $informacionperiodo = preg_replace('/[\[\]\.\;\" "]+/', '', $informacionperiodo);
    return view('informacionalumnos.index',compact('informes','idalumno','nombreespacio','informacionperiodo','informesfinales'));
    }
}