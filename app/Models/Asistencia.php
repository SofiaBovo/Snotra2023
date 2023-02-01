<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencias';
    protected $fillable = ['id','id_alumno','nombrealumno','fecha','estado','docente','grado','colegio_id','año_id','mes','justificacion','gestionjustificacion','fechajusti','comentariojusti','archivojusti'];
}


