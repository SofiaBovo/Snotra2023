@extends('layouts.main', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __()]) 

@section('content')
<?php
$detect = new Mobile_Detect;
if ($detect->isMobile() or $detect->isTablet()) {?>
<div class="container"style="margin-top: 10%;">
<?php 
}
else{?>
<div class="container"> 
<?php
}
?>
  <div class="row align-items-center">
    <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
    </div>
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">

      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf        
        <div class="card card-login card-hidden mb-3" style="margin-top: 2%; margin-left: 2%;">
          <div class="card-header card-header-info text-center">
            <h4 class="card-title"><strong>{{ __('INICIAR SESIÓN') }}</strong></h4>
          </div>
          <div class="card-body">
            <p class="card-description text-center">
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="bi bi-envelope-fill"></i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Correo electrónico') }}" autocomplete="off">
              </div>
              @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="bi bi-bag-fill"></i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Contraseña') }}">
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-facebook  btn-sm">{{ __('INGRESAR') }}</button>
          </div>
            <div class="row">
        <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-light">
                    <medium>{{ __('¿Olvidaste tu contraseña?') }}</medium>
                </a>
            @endif
        </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
