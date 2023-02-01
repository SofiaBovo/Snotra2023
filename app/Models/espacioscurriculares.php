<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class espacioscurriculares extends Model
{
    use HasFactory;

    protected $table= 'espacioscurriculares';

    protected $fillable = [
        'id','nombre', 'tipo',
    ];
}
