<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'alumnos';
    protected $fillable = ['dnialumno','nombrealumno', 'apellidoalumno', 'nombrecompleto','fechanacimiento','generoalumno','domicilio','localidad','provincia','grado'];

    public function scopeApellidos($query, $apellidos) {

        if ($apellidos) {
            return $query->where('apellidoalumno','like',"%$apellidos%");
        }
    }
    public function scopeNombres($query, $nombres) {

        if ($nombres) {
            return $query->where('nombrealumno','like',"%$nombres%");
        }
    }
    public function scopeDNIs($query, $dnis) {

        if ($dnis) {
            return $query->where('dnialumno','like',"%$dnis%");
        }
    }
    public function scopeGrados($query, $grados) {

        if ($grados) {
            return $query->where('grado','like',"%$grados%");
        }
    }
}


