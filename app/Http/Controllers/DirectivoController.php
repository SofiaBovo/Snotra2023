<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Chat;

class DirectivoController extends Controller
{
      public function index()
    {
        return view('directivo');
    }
}
