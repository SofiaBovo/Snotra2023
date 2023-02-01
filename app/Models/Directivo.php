<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directivo extends Model
{
    use HasFactory;
    protected $table = 'directivos';
    protected $fillable = ['dni','nombre', 'apellido','telefono','email'];
}
