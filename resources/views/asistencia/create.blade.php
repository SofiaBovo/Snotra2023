@extends('layouts.main', ['activePage' => 'crear asistencia', 'titlePage' => __('')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{ route('asistencia.store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="card">
          <div class= "card-header card-header-info">
          <h4 class="card-title">Agregar nueva asistencia</h4>
          </div>
        <div class="card-body">
          @if($tipodoc!='Grado')  
        <div class="text-left">
            <h5><span class="badge badge-success">Carga de asistencias de {{$gradodocente}}.</span></h5>
        </div>
        @endif
            @if(empty($danger))
            @else
            <div class="alert alert-danger">
            {{$danger}}
            </div>
            <script type="text/javascript">
            window.setTimeout(function() {
            $(".alert-danger").fadeTo(400, 0).slideUp(400, function(){
            $(this).remove(); 
            });
            }, 2000);
            </script>
            @endif
            @if(empty($error))
            @else
            <div class="alert alert-danger">
            {{$error}}
            </div>
            <script type="text/javascript">
            window.setTimeout(function() {
            $(".alert-danger").fadeTo(400, 0).slideUp(400, function(){
            $(this).remove(); 
            });
            }, 2000);
            </script>
            @endif
        <div class="row">
          <div class="col">
            <script type="text/javascript">
            window.onload = function(){
            var fecha = new Date(); 
            var mes = fecha.getMonth()+1; 
            var dia = fecha.getDate(); 
            var ano = fecha.getFullYear(); 
            if(dia<10)
            dia='0'+dia;
            if(mes<10)
            mes='0'+mes 
            document.getElementById('fechaActual').value=ano+"-"+mes+"-"+dia;
            } 
            </script>
            <label>Fecha</label>
              <input type="date" id="fechaActual"  name="diaasistencia" class="form-control" >
            @if ($errors->has('diaasistencia'))
                <div id="diaasistencia-error" class="error text-danger pl-3" for="diaasistencia" style="display: block;">
                  <strong>{{ $errors->first('diaasistencia') }}</strong>
                </div>
              @endif
          </div>
        </div>
        <br>
        <div id="mostrarjava">
        </div>
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
              
            &nbsp <strong><input type="checkbox" onclick="habilitartardanzatodos()"  id="checkTodos" style="width: 13px;height: 13px; padding: 0;margin:0;vertical-align: bottom;position: relative;top: -6.5px;*overflow: hidden;"/>&nbspMarcar/Desmarcar todos</strong>
              @foreach($infoasistencia as $infoasist)
              <tr>
              <td class="v-align-middle">{{$infoasist->nombrealumno}}</td>
              <td>
              <input type="checkbox" id="estadoasistencias" name="estadoasistencia[]" onclick="habilitartardanza({{$infoasist->id_alumno}})" value="{{$infoasist->id_alumno}}">
              <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
              function habilitartardanzatodos() {
              var arreglotardanzas = document.getElementsByName("tardanza[]");
              var arregloasistencias = document.getElementsByName("estadoasistencia[]");
              for (var i = arregloasistencias.length - 1; i >= 0; i--) {
                if (arregloasistencias[i].checked == true) {
              if(arreglotardanzas[i].checked==true){
              arreglotardanzas[i].checked = false;  
              }
              arreglotardanzas[i].disabled = true;
              } else {
              arreglotardanzas[i].disabled = false;
              }
              }
              }
              </script>
              <script>
              $(function(){
              $('#checkTodos').change(function() {
              $('input[id=estadoasistencias]').prop('checked', $(this).is(':checked'));
              });
              });
              </script>
              </td>
              @if($tipodoc=='Grado') 
              <td>
              <input type="checkbox" id="tardanzas" name="tardanza[]" value="{{$infoasist->id_alumno}}" disabled>
              </td>
              @endif
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        </div>
          
         @if($tipodoc=='Grado')
         <div style="display:none;">
            <input type="text" value="{{$mes}}" name="mes">
          </div>
          <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
          <button type="submit" class="btn btn-sm btn-facebook">Guardar asistencia</button>
          </div>
          </div>
        @endif

        @if($tipodoc!='Grado')
          <div style="display:none;">
            <input type="text" value="{{$gradodocente}}" name="gradodocente">
            <input type="text" value="{{$mes}}" name="mes">
          </div>
          <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
          <button type="submit" class="btn btn-sm btn-facebook">Guardar asistencia</button>
          </div>
          </div>
           
        @endif
      </div>
       </form>
        </div>
      </div>
    </div>
  </div>
@endsection