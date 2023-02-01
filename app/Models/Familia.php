<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;
    protected $table = 'familias';
    protected $fillable = ['id','dnifamilia','nombrefamilia', 'apellidofamilia','generofamilia','telefono','email','vinculofamiliar','domiciliofamilia','localidadfamilia','provinciafamilia','nomapefamilia'];

     public function scopeApellidos($query, $apellidos) {

        if ($apellidos) {
            return $query->where('apellidofamilia','like',"%$apellidos%");
        }
    }
    public function scopeDNIs($query, $dnis) {

        if ($dnis) {
            return $query->where('dnifamilia','like',"%$dnis%");
        }
    }
}