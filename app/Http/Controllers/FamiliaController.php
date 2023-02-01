<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FamiliaController extends Controller
{
    public function index()
    {
    $idautenticado=Auth::user()->id;
    $eventosproximos=Event::where('participantes', $idautenticado)->where('fecha', '>=', Carbon::now()->format('Y-m-d'))->orderBy('fecha','ASC')->take(2)->get();
    return view('familia',compact('eventosproximos'));
    }
    public function noverificado()
    {
    return view('noverificado');
    }
}