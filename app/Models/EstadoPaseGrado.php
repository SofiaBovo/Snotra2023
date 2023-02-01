<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPaseGrado extends Model
{
	use HasFactory;
    protected $table= 'estadopasegrado';

    protected $fillable = ['id','id_alumno','colegio_id','año_id','estado'];
}
