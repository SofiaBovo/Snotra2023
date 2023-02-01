@extends('layouts.main', ['activePage' => 'Editar asistencia', 'titlePage' => __('')])
<?php
$detect = new Mobile_Detect;
?>
@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{ route('asistencia.editar') }}" class="form-horizontal">
        @csrf
        <div class="card">
          <div class= "card-header card-header-info">
          <h4 class="card-title">Editar asistencia</h4>
          </div>
        <div class="card-body">
        @if($tipodoc!='Grado')  
        <div class="text-left">
            <h5><span class="badge badge-success">Edición de asistencias de {{$grado}}.</span></h5>
        </div>
        @endif
        <?php 
        if ($detect->isMobile() or $detect->isTablet()) {?> 
        <div class="row">
          <div class="col">
            <label>Fecha</label>
              <input type="date" id="fechaActual"  name="diaasistencia" class="form-control" >
            @if ($errors->has('diaasistencia'))
                <div id="diaasistencia-error" class="error text-danger pl-3" for="diaasistencia" style="display: block;">
                  <strong>{{ $errors->first('diaasistencia') }}</strong>
                </div>
              @endif
          </div>
          </div>
            @if($tipodoc=='Grado')
              <form>
              <div class="row">
              <div class="col">
              <div style="display:none;">
              <input type="text" value="{{$mes}}" name="mes">
              </div>
              <br>
              <div class="text-right">
              <button type="submit" class="btn btn-sm btn-facebook " >Editar asistencia</button></div>
              </div>
              </div>
              </form>
           
            @endif
            @if($tipodoc!='Grado')
            <form>
              <div class="row">              
              <div class="col">
              <div style="display:none;">
              <input type="text" value="{{$mes}}" name="mes">
              <input type="text" value="{{$grado}}" name="grado">
              </div>
              <br>
              <div class="text-right">
              <button type="submit" class="btn btn-sm btn-facebook " >Editar asistencia</button></div>
              </div>
              </div>

              </form>
            @endif
        </div> 
        
        <?php 
        }
        else{?>
        <div class="row">
          <div class="col">
            <label>Fecha</label>
              <input type="date" id="fechaActual"  name="diaasistencia" class="form-control" >
            @if ($errors->has('diaasistencia'))
                <div id="diaasistencia-error" class="error text-danger pl-3" for="diaasistencia" style="display: block;">
                  <strong>{{ $errors->first('diaasistencia') }}</strong>
                </div>
              @endif
          </div>
            @if($tipodoc=='Grado')
              <form>
              <div class="col">
              <div style="display:none;">
              <input type="text" value="{{$mes}}" name="mes">
              </div>
              <br>
              <button type="submit" class="btn btn-sm btn-facebook " >Editar asistencia</button>
              </div>
              </form>
            @endif
            @if($tipodoc!='Grado')
              <form>
              <div class="col">
              <div style="display:none;">
              <input type="text" value="{{$mes}}" name="mes">
              <input type="text" value="{{$grado}}" name="grado">
              </div>
              <br>
              <button type="submit" class="btn btn-sm btn-facebook " >Editar asistencia</button>
              </div>
              </form>
            @endif
        </div> 
        <?php 
        }
        ?> 
          </div> 
    
         
      </div>
       </form>
        </div>
      </div>
    </div>
  </div>
@endsection