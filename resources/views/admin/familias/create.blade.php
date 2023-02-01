@extends('layouts.main', ['activePage' => 'familias', 'titlePage' => __('')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{ route('storefamilia') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="card">
          <div class= "card-header card-header-info">
          <h4 class="card-title">Agregar nueva familia</h4>
          </div>
        <div class="card-body">
            <br>
            <div class="row">
            <div class="col">
            <label>DNI</label>
            <input type="text" name="dnifamilia" class="form-control" value="{{ old('dnifamilia') }}">
            @if ($errors->has('dnifamilia'))
                <div id="dnifamilia-error" class="error text-danger pl-3" for="dnifamilia" style="display: block;">
                  <strong>{{ $errors->first('dnifamilia') }}</strong>
                </div>
              @endif
          </div>
          <div class="col">
            <label>Nombre</label>
            <input type="text" name="nombrefamilia" class="form-control" value="{{ old('nombrefamilia') }}">
            @if ($errors->has('nombrefamilia'))
                <div id="nombrefamilia-error" class="error text-danger pl-3" for="nombrefamilia" style="display: block;">
                  <strong>{{ $errors->first('nombrefamilia') }}</strong>
                </div>
              @endif
          </div>
          <div class="col">
            <label>Apellido</label>
            <input class="form-control" name="apellidofamilia" value="{{ old('apellidofamilia') }}">
            @if ($errors->has('apellidofamilia'))
                <div id="apellidofamilia-error" class="error text-danger pl-3" for="apellidofamilia" style="display: block;">
                  <strong>{{ $errors->first('apellidofamilia') }}</strong>
                </div>
              @endif
          </div>
          </div>
          <br>
          <div class="row">
          <div class="col">
            <label>Domicilio</label>
            <input class="form-control" name="domiciliofamilia" value="{{ old('domiciliofamilia') }}">
            @if ($errors->has('domiciliofamilia'))
                <div id="domiciliofamilia-error" class="error text-danger pl-3" for="domiciliofamilia" style="display: block;">
                  <strong>{{ $errors->first('domiciliofamilia') }}</strong>
                </div>
              @endif
          </div>
          <div class="col">
            <label>Localidad</label>
            <input class="form-control" name="localidadfamilia" value="{{ old('localidadfamilia') }}">
            @if ($errors->has('localidadfamilia'))
                <div id="localidadfamilia-error" class="error text-danger pl-3" for="localidadfamilia" style="display: block;">
                  <strong>{{ $errors->first('localidadfamilia') }}</strong>
                </div>
              @endif
          </div>
          <div class="col">
            <label>Provincia</label>
            <input class="form-control" name="provinciafamilia" value="{{ old('provinciafamilia') }}">
            @if ($errors->has('provinciafamilia'))
                <div id="provinciafamilia-error" class="error text-danger pl-3" for="provinciafamilia" style="display: block;">
                  <strong>{{ $errors->first('provinciafamilia') }}</strong>
                </div>
              @endif
          </div>
        </div>
        <br>
          <div class="row">
            <div class="col">
            <label>Género</label>
            <select name="generofamilia" id="opciongenerofamilia" class="form-control" value="{{ old('generofamilia') }}">
                    <option></option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select>
                <script
                  src="https://code.jquery.com/jquery-3.2.0.min.js"
                  integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                  crossorigin="anonymous">
               </script>
                <script>
                $(function(){
                $("#opciongenerofamilia").val(value="{{ old('generofamilia') }}")
                });
               </script>
            @if ($errors->has('generofamilia'))
                <div id="generofamilia-error" class="error text-danger pl-3" for="generofamilia" style="display: block;">
                  <strong>{{ $errors->first('generofamilia') }}</strong>
                </div>
              @endif
            </div>
              <div class="col">
            <label>Teléfono celular</label>
            <input type="text" name="telefonofamilia" class="form-control" value="{{ old('telefonofamilia') }}">
            <small id="eventoHelp" class="form-text text-muted" >Debe ingresar el número de teléfono sin el 0, sin el 15 y sin espacios.</small>
            @if ($errors->has('telefonofamilia'))
                <div id="telefonofamilia-error" class="error text-danger pl-3" for="telefonofamilia" style="display: block;">
                  <strong>El campo debe ser del tipo numérico y contener 10 caracteres.</strong>
                </div>
              @endif
          </div>
           <div class="col">
            <label>Correo electrónico</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
          </div>
          <div class="col">
            <label>Vínculo Familiar</label>
              <select name="vinculofamiliar" id="opcionvinculo" class="form-control" value="{{ old('vinculofamiliar') }}">

                    <option></option>
                    <option value="Madre">Madre</option>
                    <option value="Padre">Padre</option>
                    <option value="Tutor">Tutor</option>  
                </select>

            <script
                  src="https://code.jquery.com/jquery-3.2.0.min.js"
                  integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                  crossorigin="anonymous">
               </script>
                <script>
                $(function(){
                $("#opcionvinculo").val(value="{{ old('vinculofamiliar') }}")
                });
               </script>
            @if ($errors->has('vinculofamiliar'))
                <div id="vinculofamiliar-error" class="error text-danger pl-3" for="vinculofamiliar" style="display: block;">
                  <strong>{{ $errors->first('vinculofamiliar') }}</strong>
                </div>
              @endif
          </div>
          

        </div>
                    <br>
      
        <div class="text-right">
      <h4><span class="badge badge-danger">*Recuerde que todos los campos son obligatorios.</span></h4>
      </div>
       
          <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
                <button type="submit" class="btn btn-sm btn-facebook">Guardar</button>
                <button type="reset" class="btn btn-sm btn-facebook">Limpiar</button>
          </div>
        </div>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection