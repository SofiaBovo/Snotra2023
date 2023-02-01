@extends('layouts.main', ['activePage' => 'profile', 'titlePage' => __('User Profile')])
<?php
$detect = new Mobile_Detect;
?>
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @if ($user->role=='directivo')
          <form method="post" action="{{route('profile.updatepersonal')}}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">{{ __('Información personal') }}</h4>
              </div>
              <div class="card-body ">
                @if(session('success'))
                    <div class="alert alert-success" role="success">
                    {{session('success')}}
                    </div>
                    <script type="text/javascript">
                    window.setTimeout(function() {
                    $(".alert-success").fadeTo(400, 0).slideUp(400, function(){
                    $(this).remove(); 
                    });
                    }, 1000);
                    </script>
                    @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-7">
                    <i><label>{{ old('email', auth()->user()->email) }}</label></i> 
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                  </div>
                </div>
              <div class="row">
                  <label class="col-sm-2 col-form-label">Nombre</label>
                  <div class="col-sm-7">
                      <input class="form-control" name="nombre" id="input-nombre" type="text" placeholder="{{ __('Nombre') }}" value="{{$directivo->nombre}}"/>
                      @if ($errors->has('nombre'))
                        <span id="nombre-error" class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                      @endif
                    </div>
                  </div>
             
                <div class="row">
                  <label class="col-sm-2 col-form-label">Apellido</label>
                  <div class="col-sm-7">
                      <input class="form-control" name="apellido" id="input-apellido" type="text" placeholder="{{ __('Apellido') }}" value="{{$directivo->apellido}}"/>
                      @if ($errors->has('apellido'))
                        <span id="apellido-error" class="error text-danger" for="input-apellido">{{ $errors->first('apellido') }}</span>
                      @endif
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">DNI</label>
                  <div class="col-sm-7">
                      <input class="form-control" name="dni" id="input-dni" type="text" placeholder="{{ __('DNI') }}" value="{{$directivo->dni}}"/>
                      @if ($errors->has('dni'))
                        <span id="dni-error" class="error text-danger" for="input-dni">{{ $errors->first('dni') }}</span>
                      @endif
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Teléfono</label>
                  <div class="col-sm-7">
                      <input class="form-control" name="telefono" id="input-telefono" type="text" placeholder="{{ __('telefono') }}" value="{{$directivo->telefono}}"/>
                      @if ($errors->has('telefono'))
                        <span id="telefono-error" class="error text-danger" for="input-telefono">{{ $errors->first('telefono') }}</span>
                      @endif
                  </div>
                </div>
               </div>
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-sm btn-facebook">{{ __('Actualizar cambios') }}</button>
              </div>
                </div>
              <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                    <br>
                    <br>
                    <br>
                     <?php 

                  }
                  else{?>
      </form> 
        <?php 
                  }
                  ?>
                @endif

      @if ($user->role=='docente')
    <form method="post" action="{{route('profile.updatepersonal')}}" autocomplete="off" class="form-horizontal">
    @csrf
    @method('put')
    <div class="card ">
    <div class="card-header card-header-info">
      <h4 class="card-title">{{ __('Información personal') }}</h4>
    </div>
    <div class="card-body ">
    @if(session('success'))
    <div class="alert alert-success" role="success">
    {{session('success')}}
    </div>
    <script type="text/javascript">
    window.setTimeout(function() {
    $(".alert-success").fadeTo(400, 0).slideUp(400, function(){
    $(this).remove(); 
    });
    }, 1000);
    </script>
    @endif
    
    <div class="row">
      <label class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-7">
      <i><label>{{ old('email', auth()->user()->email) }}</label></i>
      @if ($errors->has('email'))
      <span id="emaildocente-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
      @endif
      </div>
    </div>

    <div class="row">
      <label class="col-sm-2 col-form-label">Especialidad</label>
      <div class="col-sm-7">
      <i><label>{{$docente->especialidad}}</label></i>
      @if ($errors->has('especialidad'))
      <div id="especialidad-error" class="error text-danger pl-3" for="input-especialidad" style="display: block;">
      <strong>{{ $errors->first('especialidad') }}</strong>
      </div>
      @endif
      </div>
    </div>
    
    <div class="row">
      <label class="col-sm-2 col-form-label">Nombre</label>
      <div class="col-sm-7">
      <input class="form-control{{ $errors->has('nombredocente') ? ' is-invalid' : '' }}" name="nombredocente" id="input-nombre" type="text" placeholder="{{ __('Nombre') }}" value="{{$docente->nombredocente}}"/>
      @if ($errors->has('nombredocente'))
      <span id="nombredocente-error" class="error text-danger" for="input-nombredocente">{{ $errors->first('nombredocente') }}</span>
      @endif
      </div>
    </div>

    <div class="row">
      <label class="col-sm-2 col-form-label">Apellido</label>
      <div class="col-sm-7">
      <input class="form-control" name="apellidodocente" value="{{$docente->apellidodocente}}">
      @if ($errors->has('apellidodocente'))
      <div id="apellidodocente-error" class="error text-danger pl-3" for="input-apellidodocente" style="display: block;">
      <strong>{{ $errors->first('apellidodocente') }}</strong>
      </div>
      @endif
      </div>
    </div>
    
    <div class="row">
      <label class="col-sm-2 col-form-label">DNI</label>
      <div class="col-sm-7">
      <input class="form-control" name="dnidocente" id="input-dni" type="text" placeholder="{{ __('DNI') }}" value="{{$docente->dnidocente}}"/>
      @if ($errors->has('dnidocente'))
      <span id="dni-error" class="error text-danger" for="input-dnidocente">{{ $errors->first('dnidocente') }}</span>
      @endif
      </div>
    </div>

    <div class="row">
      <label class="col-sm-2 col-form-label">Fecha de nacimiento</label>
      <div class="col-sm-7">
      <input type="date" name="fechanacimientodoc" class="form-control" min="1951-01-01" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 18 years"));?>" value="{{$docente->fechanacimientodoc}}">
      @if ($errors->has('fechanacimientodoc'))
      <div id="fechanacimientodoc-error" class="error text-danger pl-3" for="input-fechanacimientodoc" style="display: block;">
      <strong>{{ $errors->first('fechanacimientodoc') }}</strong>
      </div>
      @endif
      </div>
    </div>

    <div class="row">
      <label class="col-sm-2 col-form-label">Género</label>
      <div class="col-sm-7">
      <select name="generodocente" id="opciongenero" class="form-control" value="{{$docente->generodocente}}">
      <option></option>
      <option value="Femenino" <?php if($docente->generodocente=='Femenino') echo 'selected="selected" ';?>>Femenino</option>
      <option value="Masculino" <?php if($docente->generodocente=='Masculino') echo 'selected="selected" ';?>>Masculino</option>
      </select>          
      @if ($errors->has('generodocente'))
      <div id="generodocente-error" class="error text-danger pl-3" for="input-generodocente" style="display: block;">
      <strong>{{ $errors->first('generodocente') }}</strong>
      </div>
      @endif
      </div>
    </div>

    <div class="row">
      <label class="col-sm-2 col-form-label">Estado civil</label>
      <div class="col-sm-7">
      <select name="estadocivildoc" id="opcionestadocivil" class="form-control" value="{{$docente->estadocivildoc}}">
      <option></option>
      <option value="Soltera/o" <?php if($docente->estadocivildoc=='Soltera/o') echo 'selected="selected" ';?>>Soltera/o</option>
      <option value="Casada/o" <?php if($docente->estadocivildoc=='Casada/o') echo 'selected="selected" ';?>>Casada/o</option>
      <option value="Divorciada/o" <?php if($docente->estadocivildoc=='Divorciada/o') echo 'selected="selected" ';?>>Divorciada/o</option>
      <option value="Viuda/o" <?php if($docente->estadocivildoc=='Viuda/o') echo 'selected="selected" ';?>>Viuda/o</option>
      <option value="En concubitato" <?php if($docente->estadocivildoc=='En concubitato') echo 'selected="selected" ';?>>En concubitato</option>
      </select>
      @if ($errors->has('estadocivildoc'))
      <div id="estadocivildoc-error" class="error text-danger pl-3" for="input-estadocivildoc" style="display: block;">
      <strong>{{ $errors->first('estadocivildoc') }}</strong>
      </div>
      @endif
      </div>
    </div>

    <div class="row">
      <label class="col-sm-2 col-form-label">Domicilio</label>
      <div class="col-sm-7">
      <input type="text" name="domiciliodocente" class="form-control" value="{{$docente->domiciliodocente}}">
      @if ($errors->has('domiciliodocente'))
      <div id="domiciliodocente-error" class="error text-danger pl-3" for="input-domiciliodocente" style="display: block;">
      <strong>{{ $errors->first('domiciliodocente') }}</strong>
      </div>
      @endif
      </div>
    </div> 

    <div class="row">
      <label class="col-sm-2 col-form-label">Localidad</label>
      <div class="col-sm-7">
      <input type="text" name="localidaddocente" class="form-control" value="{{$docente->localidaddocente}}">
      @if ($errors->has('localidaddocente'))
      <div id="localidaddocente-error" class="error text-danger pl-3" for="input-localidaddocente" style="display: block;">
      <strong>{{ $errors->first('localidaddocente') }}</strong>
      </div>
      @endif
      </div>
    </div>

    <div class="row">
      <label class="col-sm-2 col-form-label">Provincia</label>
      <div class="col-sm-7">
      <input type="text" name="provinciadocente" class="form-control" value="{{$docente->provinciadocente}}">
      @if ($errors->has('provinciadocente'))
      <div id="provinciadocente-error" class="error text-danger pl-3" for="input-provinciadocente" style="display: block;">
      <strong>{{ $errors->first('provinciadocente') }}</strong>
      </div>
      @endif
      </div>
    </div>

    <div class="row">
      <label class="col-sm-2 col-form-label">Teléfono</label>
      <div class="col-sm-7">
      <input type="text" name="telefonodocente" class="form-control" value="{{$docente->telefonodocente}}">
      @if ($errors->has('telefonodocente'))
      <div id="telefonodocente-error" class="error text-danger pl-3" for="input-telefonodocente" style="display: block;">
      <strong>{{ $errors->first('telefonodocente') }}</strong>
      </div>
      @endif
      </div>
    </div>
        
    <div class="row">
      <label class="col-sm-2 col-form-label">Legajo</label>
      <div class="col-sm-7">
      <input type="text" name="legajo" class="form-control" value="{{$docente->legajo}}">
      @if ($errors->has('legajo'))
      <div id="legajo-error" class="error text-danger pl-3" for="input-legajo" style="display: block;">
      <strong>{{ $errors->first('legajo') }}</strong>
      </div>
      @endif
      </div>
    </div>

 
    
    </div>
      <div class="card-footer ml-auto mr-auto">
      <button type="submit" class="btn btn-sm btn-facebook">{{ __('Actualizar cambios') }}</button>
      </div>
  
  </div>
  <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                    <br>
                    <br>
                    <br>
                     <?php 

                  }
                  else{?>
      </form> 
        <?php 
                  }
                  ?>
  @endif


        @if ($user->role=='familia')
        
        <form method="post" action="{{route('profile.updatepersonal')}}" autocomplete="off" class="form-horizontal">
        @csrf
        @method('put')
            
        <div class="card ">
          <div class="card-header card-header-info">
          <h4 class="card-title">{{ __('Información personal') }}</h4>
          </div>
        <div class="card-body ">
          @if(session('success'))
          <div class="alert alert-success" role="success">
          {{session('success')}}
          </div>
          <script type="text/javascript">
          window.setTimeout(function() {
          $(".alert-success").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
          });
          }, 1000);
          </script>
          @endif
        
          <div class="row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-7">
            <i><label> {{$familia->email}}</label></i>
            @if ($errors->has('email'))
            <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
            <strong>{{ $errors->first('email') }}</strong>
            </div>
            @endif
            </div>
          </div>
          
          <div class="row">
            <label class="col-sm-2 col-form-label">DNI</label>
            <div class="col-sm-7">
            <input type="text" name="dnifamilia" class="form-control" value="{{$familia->dnifamilia}}">
            @if ($errors->has('dnifamilia'))
            <div id="dnifamilia-error" class="error text-danger pl-3" for="dnifamilia" style="display: block;">
            <strong>{{ $errors->first('dnifamilia') }}</strong>
            </div>
            @endif
            </div>
          </div>
          
          <div class="row">
            <label class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-7">
            <input type="text" name="nombrefamilia" class="form-control" value="{{$familia->nombrefamilia}}">
            @if ($errors->has('nombrefamilia'))
            <div id="nombrefamilia-error" class="error text-danger pl-3" for="nombrefamilia" style="display: block;">
            <strong>{{ $errors->first('nombrefamilia') }}</strong>
            </div>
            @endif
            </div>
          </div>
          
          <div class="row">
            <label class="col-sm-2 col-form-label">Apellido</label>
            <div class="col-sm-7">
            <input class="form-control" name="apellidofamilia" value="{{$familia->apellidofamilia}}">
            @if ($errors->has('apellidofamilia'))
            <div id="apellidofamilia-error" class="error text-danger pl-3" for="apellidofamilia" style="display: block;">
            <strong>{{ $errors->first('apellidofamilia') }}</strong>
            </div>
            @endif
            </div>
          </div>
          
          <div class="row">
            <label class="col-sm-2 col-form-label">Género</label>
            <div class="col-sm-7">
            <select name="generofamilia" class="form-control" value="{{$familia->generofamilia}}">
            <option></option>
            <option value="Femenino" <?php if($familia->generofamilia=='Femenino') echo 'selected="selected" ';?>>Femenino</option>
            <option value="Masculino" <?php if($familia->generofamilia=='Masculino') echo 'selected="selected" ';?>>Masculino</option>
            </select>
            @if ($errors->has('generofamilia'))
            <div id="generofamilia-error" class="error text-danger pl-3" for="generofamilia" style="display: block;">
            <strong>{{ $errors->first('generofamilia') }}</strong>
            </div>
            @endif
            </div>
          </div>
          
          <div class="row">
            <label class="col-sm-2 col-form-label">Telefono</label>
            <div class="col-sm-7">
            <input type="text" name="telefono" class="form-control" value="{{$familia->telefono}}">
            @if ($errors->has('telefono'))
            <div id="telefono-error" class="error text-danger pl-3" for="telefono" style="display: block;">
            <strong>{{ $errors->first('telefono') }}</strong>
            </div>
            @endif
            </div>
          </div>
          
          <div class="row">
            <label class="col-sm-2 col-form-label">Vínculo Familiar</label>
            <div class="col-sm-7">
            <select name="vinculofamiliar" class="form-control" value="{{$familia->vinculofamiliar}}">
            <option></option>
            <option value="Madre" <?php if($familia->vinculofamiliar=='Madre') echo 'selected="selected" ';?>>Madre</option>
            <option value="Padre" <?php if($familia->vinculofamiliar=='Padre') echo 'selected="selected" ';?>>Padre</option>
            <option value="Tutor" <?php if($familia->vinculofamiliar=='Tutor') echo 'selected="selected" ';?>>Tutor </option>
                </select>
            @if ($errors->has('vinculofamiliar'))
            <div id="vinculofamiliar-error" class="error text-danger pl-3" for="vinculofamiliar" style="display: block;">
            <strong>{{ $errors->first('vinculofamiliar') }}</strong>
            </div>
            @endif
            </div>
          </div>
</div>
        
        <div class="card-footer ml-auto mr-auto">
          <button type="submit" class="btn btn-sm btn-facebook">{{ __('Actualizar cambios') }}</button>
        </div>
        
      </div>
    <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                    <br>
                    <br>
                    <br>
                    <br>
                     <?php 

                  }
                  else{?>
      </form> 
        <?php 
                  }
                  ?>

      
      
        @endif
            <form method="post" action="{{route('profile.updatecontra')}}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <br>
            <br>

                <div class="card ">

              <div class="card-header card-header-info">

                <h4 class="card-title">{{ __('Contraseña') }}</h4>
              </div>
              <div class="card-body ">
                @if (session('status_password'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_password') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Contraseña actual') }}</label>
                  <div class="col-sm-7">
                      <input class="form-control" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="{{$contra}}"/>
                      @if ($errors->has('old_password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                      @endif
                  </div>
                </div>
            
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __('Nueva contraseña') }}</label>
                  <div class="col-sm-7">
                      <input class="form-control" name="password" id="input-password" type="password" />
                      @if ($errors->has('password'))
                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                      @endif
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirmar nueva contraseña') }}</label>
                  <div class="col-sm-7">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password"/>
                  </div>
                </div>
              </div>
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-sm btn-facebook">{{ __('Modificar contraseña') }}</button>
              </div>
              </div>
              
              </div>
            </form>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection