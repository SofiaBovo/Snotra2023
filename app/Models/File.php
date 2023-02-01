<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Colegio;

class File extends Model
{
    use HasFactory;
    protected $fillable= ['file'];
    protected $primaryKey = 'id';

 public function colegio()
    {
     return $this->hasOne(Colegio::class, 'files_id', 'id');
    }
}
