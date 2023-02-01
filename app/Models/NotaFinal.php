<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFinal extends Model
{
    use HasFactory;
    protected $table = 'notafinal';
    protected $fillable = ['id_alumno','grado', 'espacio','nota','observacion','año','colegio_id','docente'];
}