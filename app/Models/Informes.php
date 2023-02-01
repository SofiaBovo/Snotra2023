<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informes extends Model
{
    use HasFactory;
    protected $table = 'informes';
    protected $fillable = ['id_alumno','grado', 'espacio','nota','observacion','año','colegio_id','periodo','docente'];

    public function scopegrados($query, $grados) {

        if ($grados) {
            return $query->where('grado','like',"%$grados%");
        }
    }
    public function scopeaños($query, $años) {

        if ($años) {
            return $query->where('año','like',"%$años%");
        }
    }
    public function scopealumnos($query, $alumnos) {

        if ($alumnos) {
            return $query->where('id_alumno','like',"%$alumnos%");
        }
    }
    public function scopeespacios($query, $espacios) {

        if ($espacios) {
            return $query->where('espacio','like',"%$espacios%");
        }
    }
}