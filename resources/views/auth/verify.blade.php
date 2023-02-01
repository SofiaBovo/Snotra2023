@extends('layouts.main', ['class' => 'off-canvas-sidebar', 'activePage' => 'verify', 'title' => __('')])


@section('content')

<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-info text-center">
              <p class="card-title">{{ __('VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO') }}</p>
            </div>
            <div class="card-body" align="center">
                 <div class="logo" align="center">
                    <img style="width:65px" src="{{ asset ('img/registroOK.png')}}" >
                </div>
                <p class="card-description text-center" align="center"></p>
                  {{ __('El usuario ha sido registrado con éxito. Se le ha enviado el enlace para confirmar la cuenta al correo electrónico con el que se hizo el registro.') }}
                </div>
                <div class="card-body" align="center">


                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                        </div>
                    @endif
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
