<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriosEvaluacion extends Model
{
    use HasFactory;
    protected $table = 'criteriosevaluacion';
    protected $fillable = ['criterio','id_espacio','id_año','id_grado','id_usuario','ponderacion','descripcion'];

    public function scopeespecialidad($query, $especialidad) {

        if ($especialidad) {
            return $query->where('id_espacio','like',"%$especialidad%");
        }
    }
    public function scopeaño($query, $añoescolar) {

        if ($añoescolar) {
            return $query->where('id_año','like',"%$añoescolar%");
        }
    }

    public function scopegrado($query, $grado) {

        if ($grado) {
            return $query->where('id_grado','like',"%$grado%");
        }
    }
}
