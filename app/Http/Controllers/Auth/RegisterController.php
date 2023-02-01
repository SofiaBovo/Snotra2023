<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Directivo;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Notifications\InvoicePaid;
use App\Notifications\emailverify;
use Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'alpha', 'max:100'],
            'apellido' => ['required', 'alpha', 'max:100'],
            'dni' => ['required', 'int', 'digits_between:7,8','unique:directivos'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:directivos'],
            'telefono' => ['required','int','min:1000000000','max:9999999999'],
            'password' => ['required', 'string', 'min:8','confirmed', 'regex:/[a-z]{1}/','regex:/[A-Z]{1}/']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";
        for($i=0;$i<12;$i++) {
        $password .= substr($str,rand(0,62),1);
        }
        $data['confirmation_code'] =  $password;
        $directivo=Directivo::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'dni' => $data['dni'],
            'email' => $data['email'],
            'telefono' => $data['telefono'], 
        ]); 
        $usuario=User::create([
            'name' => $data['nombre'] . ' ' . $data['apellido'],
            'role' =>'directivo',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'passwordenc' => Crypt::encrypt($data['password']),
            'idpersona' =>$directivo->id,
            'confirmation_code' => $data['confirmation_code']
        ]);
        Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
        $message->to($data['email'], $data['nombre'])->subject('Verificación de correo electrónico');
        return view('auth.verify');
    });
    }
    public function verify($code)
    {
    $user = User::where('confirmation_code', $code)->first();
    $confirmeduser=User::where('confirmation_code', $code)->pluck("confirmed");
    $confirmeduser = preg_replace('/[\[\]\.\;\" "]+/', '', $confirmeduser);
    if($confirmeduser==1){
    return view('enlaceinvalido');    
    }
    else{
    $user->confirmed = true;
    $user->save();
    return view('auth.verificado');
    }
}
}
