<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estadoevento extends Model
{
	use HasFactory;
    protected $table= 'estadoevento';

    protected $fillable = ['id','id_evento','id_participante','estado','motivorechazo','recordatorio'];
}
