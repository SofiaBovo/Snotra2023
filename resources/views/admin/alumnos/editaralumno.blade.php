@extends('layouts.main', ['activePage' => 'alumno', 'titlePage' => __('')])
 <?php
$detect = new Mobile_Detect;
?> 
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{route('alumnos.update',$alu->id) }}" method="POST" class="form-horizontal">
        @csrf
        @METHOD('PUT')
        <?php 
        if ($detect->isMobile() or $detect->isTablet()) {?>
      <div class="card" >
        <div class= "card-header card-header-info">
        <h4 class="card-title">Editar Alumno</h4>
        </div>
      <div class="card-body" >
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>DNI</label>
          <input type="text" name="dnialumno" class="form-control" value="{{$alu->dnialumno}}">
          @if ($errors->has('dnialumno'))
          <div id="dnialumno-error" class="error text-danger pl-3" for="dnialumno" style="display: block;">
          <strong>{{ $errors->first('dnialumno') }}</strong>
          </div>
          @endif
        </div>
         
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Nombre</label>
          <input type="text" name="nombrealumno" class="form-control" value="{{$alu->nombrealumno}}">
          @if ($errors->has('nombrealumno'))
          <div id="nombrealumno-error" class="error text-danger pl-3" for="nombrealumno" style="display: block;">
          <strong>{{ $errors->first('nombrealumno') }}</strong>
          </div>
          @endif
        </div>
          
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Apellido</label>
          <input class="form-control" name="apellidoalumno" value="{{$alu->apellidoalumno}}">
          @if ($errors->has('apellidoalumno'))
          <div id="apellidoalumno-error" class="error text-danger pl-3" for="apellidoalumno" style="display: block;">
          <strong>{{ $errors->first('apellidoalumno') }}</strong>
          </div>
          @endif
        </div>

       
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Fecha de nacimiento</label>
          <input type="date" name="fechanacimiento" class="form-control" min="2006-01-01" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 5 years"));?>" value="{{$alu->fechanacimiento}}">
          @if ($errors->has('fechanacimiento'))
          <div id="fechanacimiento-error" class="error text-danger pl-3" for="fechanacimiento" style="display: block;">
          <strong>{{ $errors->first('fechanacimiento') }}</strong>
          </div>
          @endif
        </div>

        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Género</label>
          <select name="generoalumno" id="opciongenero" class="form-control" value="{{$alu->generoalumno}}" >
          <option></option>
          <option value="Femenino" <?php if($alu->generoalumno=='Femenino') echo 'selected="selected" ';?>>Femenino
          <option value="Masculino" <?php if($alu->generoalumno=='Masculino') echo 'selected="selected" ';?>>Masculino
          </select>
          @if ($errors->has('generoalumno'))
          <div id="generoalumno-error" class="error text-danger pl-3" for="generoalumno" style="display: block;">
          <strong>{{ $errors->first('generoalumno') }}</strong>
          </div>
          @endif
        </div>
        
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Domicilio</label>
          <input type="text" name="domicilio" class="form-control" value="{{$alu->domicilio}}">
          @if ($errors->has('domicilio'))
          <div id="grado-error" class="error text-danger pl-3" for="domicilio" style="display: block;">
          <strong>{{ $errors->first('domicilio') }}</strong>
          </div>
          @endif
        </div>


        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Localidad</label>
          <input type="text" name="localidad" class="form-control" value="{{$alu->localidad}}">
          @if ($errors->has('localidad'))
          <div id="grado-error" class="error text-danger pl-3" for="localidad" style="display: block;">
          <strong>{{ $errors->first('localidad') }}</strong>
          </div>
          @endif
        </div>
          
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Provincia</label>
          <input type="text" name="provincia" class="form-control" value="{{$alu->provincia}}" >
          @if ($errors->has('provincia'))
          <div id="grado-error" class="error text-danger pl-3" for="provincia" style="display: block;">
          <strong>{{ $errors->first('provincia') }}</strong>
          </div>
          @endif
        </div>
      
    </div> <!--cierra tarjeta de alumnos-->
     
      <div class="card-footer">
        <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
          <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
        </div>
      </div>

    </div><!--cierra el card body-->
    </div> <!--cierra el card-->

    <!-- termina mobile--> 

    <?php 
    }
    else{?>
    <div class="card" >
      <div class= "card-header card-header-info">
      <h4 class="card-title">Editar Alumno</h4>
      </div>
    <br>
    <div class="card-body">
    <div class="row">
        <div class="col">
          <label>DNI</label>
          <input type="text" name="dnialumno" class="form-control" value="{{$alu->dnialumno}}">
          @if ($errors->has('dnialumno'))
          <div id="dnialumno-error" class="error text-danger pl-3" for="dnialumno" style="display: block;">
          <strong>{{ $errors->first('dnialumno') }}</strong>
          </div>
          @endif
        </div>
        <div class="col">
          <label>Nombre</label>
          <input type="text" name="nombrealumno" class="form-control" value="{{$alu->nombrealumno}}">
          @if ($errors->has('nombrealumno'))
          <div id="nombrealumno-error" class="error text-danger pl-3" for="nombrealumno" style="display: block;">
          <strong>{{ $errors->first('nombrealumno') }}</strong>
          </div>
          @endif
        </div>
          
        <div class="col">
          <label>Apellido</label>
          <input class="form-control" name="apellidoalumno" value="{{$alu->apellidoalumno}}">
          @if ($errors->has('apellidoalumno'))
          <div id="apellidoalumno-error" class="error text-danger pl-3" for="apellidoalumno" style="display: block;">
          <strong>{{ $errors->first('apellidoalumno') }}</strong>
          </div>
          @endif
        </div>
    </div>
    <br>   
    <div class="row">
        <div class="col">
          <label>Fecha de nacimiento</label>
          <input type="date" name="fechanacimiento" class="form-control" min="2006-01-01" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 5 years"));?>" value="{{$alu->fechanacimiento}}">
          @if ($errors->has('fechanacimiento'))
          <div id="fechanacimiento-error" class="error text-danger pl-3" for="fechanacimiento" style="display: block;">
          <strong>{{ $errors->first('fechanacimiento') }}</strong>
          </div>
          @endif
        </div>

        <div class="col">
          <label>Género</label>
          <select name="generoalumno" id="opciongenero" class="form-control" value="{{$alu->generoalumno}}" >
          <option></option>
          <option value="Femenino" <?php if($alu->generoalumno=='Femenino') echo 'selected="selected" ';?>>Femenino
          <option value="Masculino" <?php if($alu->generoalumno=='Masculino') echo 'selected="selected" ';?>>Masculino
          </select>
          @if ($errors->has('generoalumno'))
          <div id="generoalumno-error" class="error text-danger pl-3" for="generoalumno" style="display: block;">
          <strong>{{ $errors->first('generoalumno') }}</strong>
          </div>
          @endif
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
          <label>Domicilio</label>
          <input type="text" name="domicilio" class="form-control" value="{{$alu->domicilio}}">
          @if ($errors->has('domicilio'))
          <div id="grado-error" class="error text-danger pl-3" for="domicilio" style="display: block;">
          <strong>{{ $errors->first('domicilio') }}</strong>
          </div>
          @endif
        </div>

        <div class="col">
          <label>Localidad</label>
          <input type="text" name="localidad" class="form-control" value="{{$alu->localidad}}">
          @if ($errors->has('localidad'))
          <div id="grado-error" class="error text-danger pl-3" for="localidad" style="display: block;">
          <strong>{{ $errors->first('localidad') }}</strong>
          </div>
          @endif
        </div>
          
        <div class="col">
          <label>Provincia</label>
          <input type="text" name="provincia" class="form-control" value="{{$alu->provincia}}" >
          @if ($errors->has('provincia'))
          <div id="provincia-error" class="error text-danger pl-3" for="provincia" style="display: block;">
          <strong>{{ $errors->first('provincia') }}</strong>
          </div>
          @endif
        </div>
        @if($maximogrado=='Seis')
        <div class="col">
          <label>Grado</label>
          <?php
          ?>
          <select name="grado" id="grado" class="form-control" value="{{ old('grado') }}">
          <?php
          $nombredivision = preg_replace('/[\[\]\.\;\" "]+/', '', $nombredivision);
          $contador=count($nombredivision)-1;
          ?>
          <option>{{$alu->grado}}</option>
          <?php
          for ($i=0; $i <=$contador ; $i++) { 
          ?>
          <option value="Primer grado {{$nombredivision[$i]}}">Primer grado {{$nombredivision[$i]}} </option>
          <?php
          }
          for ($i=0; $i <=$contador ; $i++) { 
          ?>
            <option value="Segundo grado {{$nombredivision[$i]}}">Segundo grado {{$nombredivision[$i]}} </option>
            <?php
              }
            for ($i=0; $i <=$contador ; $i++) { 
              ?>
            <option value="Tercer grado {{$nombredivision[$i]}}">Tercer grado {{$nombredivision[$i]}}</option>
            <?php
              }  
            for ($i=0; $i <=$contador ; $i++) { 
              ?>
            <option value="Cuarto grado {{$nombredivision[$i]}}">Cuarto grado {{$nombredivision[$i]}}</option>
            <?php
              }
              for ($i=0; $i <=$contador ; $i++) { 
              ?>
            <option value="Quinto grado {{$nombredivision[$i]}}">Quinto grado {{$nombredivision[$i]}}</option>
            <?php
              }
              for ($i=0; $i <=$contador ; $i++) { 
              ?>
            <option value="Quinto grado {{$nombredivision[$i]}}">Quinto grado {{$nombredivision[$i]}}</option>
            <?php
              }
              for ($i=0; $i <=$contador ; $i++) { 
              ?>
            <option value="Sexto grado {{$nombredivision[$i]}}">Sexto grado {{$nombredivision[$i]}}</option>
              <?php
              }     
              ?>         
            </select>
            <script>
              src="https://code.jquery.com/jquery-3.2.0.min.js"
              integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
              crossorigin="anonymous">
              </script>
              <script>
                $(function(){
                $("#grado").val(value="{{ old('grado') }}")
                });
              </script>
            @if ($errors->has('grado'))
            <div id="grado-error" class="error text-danger pl-3" for="grado" style="display: block;">
              <strong>{{ $errors->first('grado') }}</strong>
              </div>
              @endif
          </div>
            @endif

            @if($maximogrado=='Siete')
          
          <div class="col">
            <label>Grado</label>
            <?php
            ?>
          
          <select name="grado" id="grado" class="form-control" value="{{ old('grado') }}">
              <?php
            $nombredivision = preg_replace('/[\[\]\.\;\" "]+/', '', $nombredivision);
            $contador=count($nombredivision)-1;
            ?>
            <option value=""></option>
            <?php
            for ($i=0; $i <=$contador ; $i++) { 
              ?>
              <option value="Primer grado {{$nombredivision[$i]}}">Primer grado {{$nombredivision[$i]}} </option>
            <?php
              }
            for ($i=0; $i <=$contador ; $i++) { 
              ?>
              <option value="Segundo grado {{$nombredivision[$i]}}">Segundo grado {{$nombredivision[$i]}} </option>
            <?php
              }
            for ($i=0; $i <=$contador ; $i++) { 
              ?>
              <option value="Tercer grado {{$nombredivision[$i]}}">Tercer grado {{$nombredivision[$i]}}</option>
            <?php
              }  
            for ($i=0; $i <=$contador ; $i++) { 
              ?>
              <option value="Cuarto grado {{$nombredivision[$i]}}">Cuarto grado {{$nombredivision[$i]}}</option>
            <?php
              }
              for ($i=0; $i <=$contador ; $i++) { 
              ?>
              <option value="Quinto grado {{$nombredivision[$i]}}">Quinto grado {{$nombredivision[$i]}}</option>
            <?php
              }
              for ($i=0; $i <=$contador ; $i++) { 
              ?>
              <option value="Quinto grado {{$nombredivision[$i]}}">Quinto grado {{$nombredivision[$i]}}</option>
            <?php
              }
              for ($i=0; $i <=$contador ; $i++) { 
              ?>
              <option value="Sexto grado {{$nombredivision[$i]}}">Sexto grado {{$nombredivision[$i]}}</option>
            <?php
              }   
              for ($i=0; $i <=$contador ; $i++) { 
              ?>
              <option value="Séptimo grado {{$nombredivision[$i]}}">Séptimo grado {{$nombredivision[$i]}}</option>
            <?php
              }     
              ?>         
          </select>
           <script>
              src="https://code.jquery.com/jquery-3.2.0.min.js"
              integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
              crossorigin="anonymous">
              </script>
              <script>
                $(function(){
                $("#grado").val(value="{{ old('grado') }}")
                });
              </script>
            @if ($errors->has('grado'))
            <div id="grado-error" class="error text-danger pl-3" for="grado" style="display: block;">
            <strong>{{ $errors->first('grado') }}</strong>
            </div>
              @endif
            </div>
            @endif


      </div>
      <br>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <div class="row">
        <div class="col">
          <label>Familiar asociado</label>
          <select class="form-control familiar" name="familiar" id="familiar" lang="es" style="width: 100%">
            <?php 
            $datosfamilia=App\Models\Familia::where('id',$alu->familias_id)->pluck("nomapefamilia");
            $datosfamilia = preg_replace('/[\[\]\.\;\""]+/', '', $datosfamilia);
                                ?>
          <option value="{{$alu->familias_id}}"<?php echo 'selected="selected" ';?>>
          {{$datosfamilia}}
       </option>
            </select>
            <script type="text/javascript">
            $('.familiar').select2({
            placeholder: 'Ingrese el nombre y apellido',
            ajax: {
            url: '/autocomplete/familiar/',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
            results:  $.map(data, function (item) {
              return {
                  text: item.nomapefamilia,
                  id: item.id
              }
          })
      };
    },
    cache: true
    }
});
</script>
          @if ($errors->has('familiar'))
          <div id="familiar-error" class="error text-danger pl-3" for="familiar" style="display: block;">
          <strong>{{ $errors->first('familiar') }}</strong>
          </div>
          @endif
        </div>
      </div>
    <br>
  </div>
  <div class="card-footer">
    <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
    <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
    </div>
  </div>

  </div><!--cierra el card body-->
  </div> <!--cierra el card-->
  <?php 
  }
  ?>
        </form>
      </div>
    </div>
  </div>
</div>         
@endsection