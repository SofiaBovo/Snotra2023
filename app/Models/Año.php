<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Año extends Model
{
    use HasFactory;
    protected $table = 'año';
    protected $fillable = ['descripcion','fechainicio', 'fechafin','inicioperiodo1','finperiodo1','inicioperiodo2','finperiodo2','inicioperiodo3','finperiodo3','inicioperiodo4','finperiodo4'];
}