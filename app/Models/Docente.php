<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docentes';
    protected $fillable = ['id','dnidocente','nombredocente', 'apellidodocente','fechanacimientodoc','generodocente','domiciliodocente','localidaddocente','provinciadocente','estadocivildoc','telefonodocente','emaildocente','legajo','especialidad'];

    public function scopeApellidos($query, $apellidos) {

        if ($apellidos) {
            return $query->where('apellidodocente','like',"%$apellidos%");
        }
    }
    public function scopeNombres($query, $nombres) {

        if ($nombres) {
            return $query->where('nombredocente','like',"%$nombres%");
        }
    }
    public function scopeDNIs($query, $dnis) {

        if ($dnis) {
            return $query->where('dnidocente','like',"%$dnis%");
        }
    }

}
