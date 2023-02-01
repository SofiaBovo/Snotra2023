<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;
    protected $table = 'grado';
    protected $fillable = ['descripcion','id_docentes','id_docentesespe','num_grado','idalumnos','id_anio'];
}