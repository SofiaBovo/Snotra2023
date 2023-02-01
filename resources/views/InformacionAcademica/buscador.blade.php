@extends('layouts.main' , ['activePage' => 'informacionacademica', 'titlePage => Información Académica'])
<?php
$detect = new Mobile_Detect;
?>

@section ('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
 <div class="content">
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title ">Información académica</h4>
              </div>
              <div class="card-body">
                @if(empty($informaciongrado))
                <div class="text-center">
                <h4><span class="badge badge-warning">Por el momento no hay información académica para mostrar.</span></h4></div>
                @else
                <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                <div class="text-left col">
                  <h5><span class="badge badge-info">Para una búsqueda eficiente se recomienda seleccionar <br> al menos dos criterios.</span></h5>
                  </div>
                  <?php 
                  }
                  else{?>
                  <div class="text-left col">
                  <h5><span class="badge badge-info">Para una búsqueda eficiente se recomienda seleccionar al menos dos criterios.</span></h5>
                  </div>
                  <?php 
                  }
                  ?>
                @if(session('danger'))
                    <div class="alert alert-danger" role="danger">
                    {{session('danger')}}
                    </div>
                    <script type="text/javascript">
                    window.setTimeout(function() {
                    $(".alert-danger").fadeTo(400, 0).slideUp(400, function(){
                    $(this).remove(); 
                    });
                    }, 1800);
                    </script>
                    @endif
                <form action="{{route('listadoinfoacademica')}}" class="form-horizontal">
                  @csrf
                <div class="row">
                <div class="col">
                <label>Año lectivo</label>
                <select name="añolectivo" id="añolectivo" class="form-control" value="">
                <option value=""></option>
                <?php 
                $contador=count($años)-1;
                for ($i=0; $i <=$contador ; $i++) {?> 
                  <option value="{{$años[$i]}}">{{$años[$i]}}</option>
                <?php
                }
                ?>
                </select>
                @if ($errors->has('añolectivo'))
                <div id="añolectivo-error" class="error text-danger pl-3" for="añolectivo" style="display: block;">
                  <strong>{{ $errors->first('añolectivo') }}</strong>
                </div>
                @endif
                </div>
                <div class="col">
                <label>Grado</label>
                <select name="grado" id="grado" class="form-control" value="">
                <option value=""></option>
                <?php 
                $contadorgrado=count($informaciongrado)-1;
                for ($i=0; $i <=$contadorgrado ; $i++) {?> 
                  <option value="{{$informaciongrado[$i]}}">{{$informaciongrado[$i]}}</option>
                <?php
                }
                ?>
                </select>
                @if ($errors->has('grado'))
                <div id="grado-error" class="error text-danger pl-3" for="grado" style="display: block;">
                  <strong>{{ $errors->first('grado') }}</strong>
                </div>
                @endif
                </div>
                </div>
                <br>
                 <div class="row">
                <div class="col">
                <label>Alumno</label>
                <br>
                <br>
                <select class="form-control alumno" name="alumno" id='alumno' lang="es" style="width: 100%">
                <option value=""></option>
                </select>
                <script type="text/javascript">
                $('.alumno').select2({
                placeholder: 'Ingrese el alumno a buscar',
                ajax: {
                url: '/autocomplete/alumnos/',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                return {
                results:  $.map(data, function (item) {
                return {
                  text: item.nombrecompleto,
                  id: item.id,
                }
                })
                };
                },
                cache: true
                }
                });
                </script>
                @if ($errors->has('alumno'))
                <div id="alumno-error" class="error text-danger pl-3" for="alumno" style="display: block;">
                  <strong>{{ $errors->first('alumno') }}</strong>
                </div>
                @endif
                </div>
                <div class="col">
                <label>Espacio curricular</label>
                <select name="espaciocurricular" id="espaciocurricular" class="form-control" value="">
                <option value=""></option>
                <?php 
                $contadorespacio=count($nombreespacio)-1;
                for ($i=0; $i <=$contadorespacio ; $i++) {?> 
                  <option value="{{$nombreespacio[$i]}}">{{$nombreespacio[$i]}}</option>
                <?php
                }
                ?>
                </select>
                @if ($errors->has('espaciocurricular'))
                <div id="espaciocurricular-error" class="error text-danger pl-3" for="espaciocurricular" style="display: block;">
                  <strong>{{ $errors->first('espaciocurricular') }}</strong>
                </div>
                @endif
                </div>
                </div>
                <br>
                <div class="text-right">
                  <button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
                </div>
                </form>
            </div>
            @endif
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
</div>
@endsection

