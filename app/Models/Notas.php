<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    use HasFactory;
    protected $table = 'notas';
    protected $fillable = ['id','id_alumno','nombrealumno','apellidoalumno','docente','criterio','nota','año','periodo','observacion','grado','colegio_id'];
}