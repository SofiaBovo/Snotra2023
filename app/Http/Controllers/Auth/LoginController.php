<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;
    public function redirectTo()
    {
    $cuentaverificada=Auth::user()->confirmed;
    if($cuentaverificada==1){     
        switch (Auth::user()->role) {
        case 'directivo':
        $this->redirectTo = '/directivo';
        return $this->redirectTo;
        break;
        case 'docente':
        $this->redirectTo = '/docente';
        return $this->redirectTo;
        break;
        case 'familia':
        $this->redirectTo = '/familia';
        return $this->redirectTo;
        break;
    }      
    }
    else{
    Auth::logout();
    $this->redirectTo = '/noverificado';
        return $this->redirectTo;
    }     
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
