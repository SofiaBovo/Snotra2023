@extends('layouts.main', ['activePage' => 'Editar asistencia', 'titlePage' => __('')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{ route('asistencia.update') }}" method="POST" class="form-horizontal">
        @csrf
        @METHOD('PUT')
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
        <div class="row">
          <div class="col">
            <label>Fecha</label>
              <input type="date" id="fechaActual"  name="diaasistencia" disabled class="form-control" value="{{$fechaseleccionada}}">
          </div>
        </div>
        <br>
        @if($infoasistencia->isEmpty())
        <div class="text-center"> 
        No hay asistencias cargadas para la fecha seleccionada.
        @if($tipodoc=='Grado')
        <form>
        <div style="display:none;">
          <input type="text" value="{{$mes}}" name="mes">
        </div>
        <a class="text-primary" type="submit" href="javascript:history.back()">Seleccionar otra fecha</a>
        </form>
        @else
        <form>
        <div style="display:none;">
          <input type="text" value="{{$grado}}" name="grado">
        </div>
        <a class="text-primary" href="javascript:history.back()">Seleccionar otra fecha</a>
        </form>
        @endif
        </div>
        @else
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>Alumnos</th>
              <th>Asistencia</th>
              @if($tipodoc=='Grado')
              <th>Tardanza</th>
              @endif
            </thead>                    
            <tbody>
              <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
              <script type="text/javascript">
              function habilitartardanza(alumnopresente) {
              var arreglotardanzas = document.getElementsByName("tardanza[]");
              var arregloasistencias = document.getElementsByName("estadoasistencia[]");
              for (var i = arregloasistencias.length - 1; i >= 0; i--) {
                if (arregloasistencias[i].value==alumnopresente) {
                var orden = i;  
                }
              }
              if (arregloasistencias[orden].checked == false) {
              if(arreglotardanzas[orden].checked==true){
              arreglotardanzas[orden].checked = false;  
              }
              arreglotardanzas[orden].disabled = true;
              } else {
              arreglotardanzas[orden].disabled = false;
              }
              }
              </script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
              <script>
              $(function(){
              $('#checkTodos').change(function() {
              $('input[id=estadoasistencias]').prop('checked', $(this).is(':checked'));
              });
              });
              </script>
            @foreach($infoasistencia as $infoasist)
              <tr>
              <td class="v-align-middle">{{$infoasist->nombrealumno}}</td>
              <td>
              <input type="checkbox" id="estadoasistencias" name="estadoasistencia[]"  value="{{$infoasist->id_alumno}}" onclick="habilitartardanza({{$infoasist->id_alumno}})" <?php if($infoasist->estado=='Presente') echo 'checked ';?>>
              </td>
              @if($tipodoc=='Grado')
              <td>
              <input type="checkbox" id="tardanzas" name="tardanza[]" value="{{$infoasist->id_alumno}}"<?php if($infoasist->tardanza==1) echo 'checked ';?>>
              </td>
              @endif
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        </div>
        @if($tipodoc=='Grado')
          <form>
            <div style="display:none;">
                <input type="text" value="{{$mes}}" name="mes">
                <input type="text" value="{{$fechaseleccionada}}" name="diaasistencia">
                
            </div>
            <br>
           <div class="card-footer">
            <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
            <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
           </div>
           </div>
          </form>
        @endif
        @if($tipodoc!='Grado')
          <form>
            <div style="display:none;">
                <input type="text" value="{{$mes}}" name="mes">
                <input type="text" value="{{$grado}}" name="grado">
                <input type="text" value="{{$fechaseleccionada}}" name="diaasistencia">
            </div>
            <br>
           <div class="card-footer">
            <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
            <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
           </div>
           </div>
          </form>
        @endif
        @endif
      </div>
       </form>
        </div>
      </div>
    </div>
  </div>
@endsection