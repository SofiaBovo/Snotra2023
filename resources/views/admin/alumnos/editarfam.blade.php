@extends('layouts.main', ['activePage' => 'alumno', 'titlePage' => __('')])
  
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{ route('actualizarfam',$id->id) }}" method="POST" class="form-horizontal" >
        @csrf
        @METHOD('PUT')
        <div class="card" >
          <div class= "card-header card-header-info" >
          <h4 class="card-title">Editar familia</h4>
          </div>
        <div class="card-body" >
          <div class="card" style="border: thin solid lightgrey;">
          <h4 class="card-tittle text-center"><strong>Datos de la Familia</strong></h4>
          <div id="familiar">
          <div class="row">
            <label class="col-sm-2 col-form-label">DNI</label>
            <div class="col-sm-7">
            <input type="text" name="dnifamilia" class="form-control" value="{{$id->dnifamilia}}">
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
            <input type="text" name="nombrefamilia" class="form-control" value="{{$id->nombrefamilia}}">
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
            <input class="form-control" name="apellidofamilia" value="{{$id->apellidofamilia}}">
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
            <select name="generofamilia" id="opciongenerofamilia" class="form-control" value="{{$id->generofamilia}}">
                    <option></option>
                    <option value="Femenino" <?php if($id->generofamilia=='Femenino') echo 'selected="selected" ';?>>Femenino
                    <option value="Masculino" <?php if($id->generofamilia=='Masculino') echo 'selected="selected" ';?>>Masculino
                </select>
  
            @if ($errors->has('generofamilia'))
                <div id="generofamilia-error" class="error text-danger pl-3" for="generofamilia" style="display: block;">
                  <strong>{{ $errors->first('generofamilia') }}</strong>
                </div>
              @endif
            </div>
          </div>
              <div class="row">
            <label class="col-sm-2 col-form-label">Teléfono celular</label>
            <div class="col-sm-7">
            <input type="text" name="telefono" class="form-control" value="{{$id->telefono}}">
            <small id="eventoHelp" class="form-text text-muted" >Debe ingresar el número de teléfono sin el 0, sin el 15 y sin espacios.</small>
            @if ($errors->has('telefono'))
                <div id="telefono-error" class="error text-danger pl-3" for="telefono" style="display: block;">
                  <strong>El campo debe ser del tipo numérico y contener 10 caracteres.</strong>
                </div>
              @endif
            </div>
          </div>

           <div class="row">
            <label class="col-sm-2 col-form-label">Correo electrónico</label>
            <div class="col-sm-7">
            <input type="text" name="email" class="form-control" value="{{$id->email}}">
            @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">Vínculo Familiar</label>
            <div class="col-sm-7">
              <select name="vinculofamiliar" id="opcionvinculo" class="form-control" value="{{$id->vinculofamiliar}}">
                    <option></option>
                    <option value="Madre" <?php if($id->vinculofamiliar=='Madre') echo 'selected="selected" ';?>>Madre
                    <option value="Padre" <?php if($id->vinculofamiliar=='Padre') echo 'selected="selected" ';?>>Padre
                    <option value="Tutor" <?php if($id->vinculofamiliar=='Tutor') echo 'selected="selected" ';?>>Tutor  
                </select>
            @if ($errors->has('vinculofamiliar'))
                <div id="vinculofamiliar-error" class="error text-danger pl-3" for="vinculofamiliar" style="display: block;">
                  <strong>{{ $errors->first('vinculofamiliar') }}</strong>
                </div>
              @endif
            </div>
          </div>
            
            
            </div>

          </div>
  
  </div>
  <div class="text-right">
            <h4><span class="badge badge-danger">*Recuerde que todos los campos son obligatorios.</span></h4>
          </div>
          <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
                <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
          </div>
        </div>
      </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection