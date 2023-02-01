<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abecedario extends Model
{
	use HasFactory;
    protected $table= 'abecedario';

    protected $fillable = ['id','letras'];
}
