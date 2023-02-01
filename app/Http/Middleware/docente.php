<?php
namespace App\Http\Middleware;
use Auth;
use Closure;
class docente
{
/**
* Handle an incoming request.
* @param  \Illuminate\Http\Request  $request
* @param  \Closure  $next
* @return mixed
*/
public function handle($request, Closure $next)
{
if (!Auth::check()) {
return redirect()->route('login');
}
if (Auth::user()->role == 'directivo') {
return redirect()->route('directivo');
}
if (Auth::user()->role == 'docente') {
return $next($request);
}
if (Auth::user()->role == 'familia') {
return redirect()->route('familia');
}
}
}