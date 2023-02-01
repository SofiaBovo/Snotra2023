<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Colegio extends Model
{
    use HasFactory;
    protected $table = 'colegio';
    protected $fillable = ['id','nombre','direccion', 'telefono','localidad','provincia','email','users_id','gestion','periodo','turno','grados','divisiones', 'espacioscurriculares','calicualitativa','calinumerica','cue'];

public function scopeUsuario($query, $usuario) {
    	if ($usuario) {
    		return $query->where('users_id','like',"%$usuario%");
    	}
    }

    public function file()
    {
     return $this->belongsTo(File::class);
 }
 public function user()
    {
     return $this->belongsTo(User::class);
    }

 public function docente()
    {
     return $this->belongsTo(Docente::class);
 }
 public function alumno()
    {
     return $this->belongsTo(Alumno::class);
 }

}
