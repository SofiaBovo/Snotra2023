<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calificacioncualitativa extends Model
{
    use HasFactory;

    protected $table= 'calificacioncualitativa';

    protected $fillable = ['id_calificacion','calificacion','codigo','valor','orden'];
}
