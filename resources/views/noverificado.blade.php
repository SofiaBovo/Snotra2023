
@extends('layouts.main', ['class' => 'off-canvas-sidebar', 'activePage' => 'noverificado', 'title' => __('')])

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-info text-center" >
              <p class="card-title"><strong>{{ __('EMAIL NO VERIFICADO') }}</strong></p>
            </div>
            <div class="card-body" align="center">
              <p class="card-description text-light"></p>
                   {{ __('La cuenta aún no ha sido verificada. Diríjase a su correo electrónico para verificar la cuenta y luego podrá acceder a la plataforma.')}} 
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection