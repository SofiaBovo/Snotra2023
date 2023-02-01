@extends('layouts.main', ['activePage' => 'criteriosevaluacion', 'titlePage' => __('')])
<?php
      $detect = new Mobile_Detect;
?>
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{ route('criterios.store') }}" method="POST" class="form-horizontal" id="form" name="form">
        @csrf
        <div class="card">
          <div class= "card-header card-header-info">
          <h4 class="card-title">Agregar criterio de evaluación</h4>
          </div>
        <div class="card-body">
        @foreach($infoaño as $año)
          <div class="text-left">
            <h5><span class="badge badge-info">El año escolar activo es el {{$año->descripcion}}.</span></h5>
          </div>
        @endforeach
        @if(sizeof($nombresgrado)==0)
            <div class="text-center">
            <h5><span class="badge badge-warning">Para crear criterios es necesario estar asociado a al menos un grado.</span></h5>
          </div>
          @else
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
          <?php 
          if ($detect->isMobile() or $detect->isTablet()) {?>
          @if($tipodoc=='Grado')
          @if($valor=='0')
          <div class="row" style="margin-right: 3px; margin-left: 3px;">
            <label>Espacio curricular</label>
              <select name="espaciocurricular" id="espaciocurricular" class="form-control" value="{{ old('espaciocurricular') }}">
                <option value=""></option>
                <?php
                $contador=count($nombreespacios)-1;
                for ($i=0; $i <= $contador ; $i++) { 
                $nombreespacios = preg_replace('/[\[\]\.\;\""]+/', '', $nombreespacios);
                  ?>
                <option value="{{$nombreespacios[$i]}}">{{$nombreespacios[$i]}}</option>
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
          <br>
          <div class="text-center">
              <input type="checkbox" name="aplicaespacios" id="aplicaespacios" value="aplicaespacios"onclick="espaciocurricular.disabled =this.checked">&nbsp<label>Todos los espacios curriculares</label>
          </div>
          @else
          <div class="row">
            <label>Espacio curricular</label>
              <select name="espaciocurricular" id="espaciocurricular" class="form-control" value="{{ old('espaciocurricular') }}">
                
                <option value="{{$nombreespaciocurri}}">{{$nombreespaciocurri}}</option>
                <option value=""></option>
                <?php
                $contador=count($infocol)-1;
                for ($i=0; $i <= $contador ; $i++) { 
                $nombreespacios=App\Models\espacioscurriculares::where('id',$infocol[$i])->get();
                foreach($nombreespacios as $nombreesp){
                $nomespacio="$nombreesp->nombre";
                ?>
                <option value="{{$nomespacio}}">{{$nomespacio}}</option>
                <?php
                }
                }
                ?>
              </select>
            @if ($errors->has('espaciocurricular'))
                <div id="espaciocurricular-error" class="error text-danger pl-3" for="espaciocurricular" style="display: block;">
                  <strong>{{ $errors->first('espaciocurricular') }}</strong>
                </div>
              @endif
          </div>
          <div class="row">
              <br>
              <input type="checkbox" name="aplicaespacios" id="aplicaespacios" value="aplicaespacios"onclick="espaciocurricular.disabled =this.checked" checked="{{$check3}}">&nbsp<label>Aplica a todos los espacios curriculares</label>
          </div>
          @endif
          @else
          @if($valor=='0')
          <div class="row" style="margin-right: 3px; margin-left: 3px;">
            <label>Grado</label>
              <select name="grado" id="grado" class="form-control" value="{{old('grado') }}">
                    <option value=""></option>
                    <?php
                    $cont=count($nombresgrado)-1;
                    for($i=0;$i<=$cont;$i++){?>
                    <option value="{{$nombresgrado[$i]}}">{{$nombresgrado[$i]}}</option>
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
          <br>
            <div class="text-center" >
              <input type="checkbox" name="aplicagrados" id="aplicagrados" value="aplicagrados" onclick="grado.disabled =this.checked,aplicadivisiones.disabled =this.checked">&nbsp<label>Todos los grados</label>
              &nbsp&nbsp<input type="checkbox" name="aplicadivisiones" id="aplicadivisiones" value="aplicadivisiones">&nbsp<label>Todas las divisiones</label>
            </div>

            @else
            <div class="row" style="margin-right: 3px; margin-left: 3px;">
            <label>Grado</label>
              <select name="grado" id="grado" class="form-control" value="{{old('grado') }}">
                    <option value="{{$nombregrado}}">{{$nombregrado}}</option>
                    <option value=""></option>
                    <?php
                    $cont=count($nombresgrado)-1;
                    for($i=0;$i<=$cont;$i++){?>
                    <option value="{{$nombresgrado[$i]}}">{{$nombresgrado[$i]}}</option>
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
            <div class="row">
              <input type="checkbox" name="aplicagrados" id="aplicagrados" value="aplicagrados" onclick="grado.disabled =this.checked,aplicadivisiones.disabled =this.checked" checked="{{$check1}}">&nbsp<label>Aplica a todos los grados</label>
              <input type="checkbox" name="aplicadivisiones" id="aplicadivisiones" value="aplicadivisiones" checked="{{$check2}}">&nbsp<label>Aplica a todas las divisiones</label>
            </div>
            @endif
            @endif
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
            <label>Etapa</label>
            <br>
            <select id="periodo" name="periodo" class="form-control" value="periodo">
            <option value=""></option>
                @if($informacionperiodo=='Bimestre')
                <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                <option value="Tercera Etapa">Tercera Etapa</option>
                <option value="Cuarta Etapa">Cuarta Etapa</option>
                @endif
                @if($informacionperiodo=='Trimestre')
               <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                <option value="Tercera Etapa">Tercera Etapa</option>
                @endif
                @if($informacionperiodo=='Cuatrimestre')
                 <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                @endif
                @if($informacionperiodo=='Semestre')
                 <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                @endif
            </select>
            @if ($errors->has('periodo'))
                <div id="periodo-error" class="error text-danger pl-3" for="periodo" style="display: block;">
                  <strong>{{ $errors->first('periodo') }}</strong>
                </div>
              @endif
        </div>
        <br>
        <div class="text-center">
        <input type="checkbox" name="aplicaperiodo" id="aplicaperiodo" value="aplicaperiodo">&nbsp<label>Todas las etapas</label>
        </div>
        <br>
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
            <label>Criterio de evaluación</label>
              <input type="text" name="criterio" class="form-control" value="{{ old('criterio') }}">
            @if ($errors->has('criterio'))
                <div id="criterio-error" class="error text-danger pl-3" for="criterio" style="display: block;">
                  <strong>{{ $errors->first('criterio') }}</strong>
                </div>
              @endif
          </div>
          <br>
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Ponderación</label>
        </div>
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
            <small class="form-text" id="etiqueta"></small>
            &nbsp<input id="input" name="ponderacion" type="range" min="1" max="5" step="1" list="opciones" value="0">
            <datalist id="opciones">
            <option value="1" label="1">
            <option value="2" label="2">
            <option value="3" label="3">
            <option value="4" label="4">
            <option value="5" label="5">
            </datalist>
            <script type="text/javascript">
            var elInput = document.querySelector('#input');
            if (elInput) {
            var etiqueta = document.querySelector('#etiqueta');
            if (etiqueta) {
            if(elInput.value=='1'){
            etiqueta.innerHTML = "Ponderación muy baja";
            document.getElementById('etiqueta').style.color = '#008000';
            }
            elInput.addEventListener('input', function() {
            if(elInput.value=='1'){
            etiqueta.innerHTML = "Ponderación muy baja";
            document.getElementById('etiqueta').style.color = '#008000';
            }
            if(elInput.value=='2'){
            etiqueta.innerHTML = "Ponderación baja";
            document.getElementById('etiqueta').style.color = '#57a639';
            }
            if(elInput.value=='3'){
            etiqueta.innerHTML = "Ponderación media";
            document.getElementById('etiqueta').style.color = '#cccc00';
            }
            if(elInput.value=='4'){
            etiqueta.innerHTML = "Ponderación alta";
            document.getElementById('etiqueta').style.color = '#FF8000';
            }
            if(elInput.value=='5'){
            etiqueta.innerHTML = "Ponderación muy alta";
            document.getElementById('etiqueta').style.color = '#FF0000';
            }
            }, false);
            }
            }
            </script>
            <small class="form-text text-muted">Permite darle un peso al criterio de evaluación para luego obtener una nota final.</small>   
            @if ($errors->has('ponderacion'))
                <div id="ponderacion-error" class="error text-danger pl-3" for="ponderacion" style="display: block;">
                  <strong>{{ $errors->first('ponderacion') }}</strong>
                </div>
              @endif
        </div>
        <br>
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Descripción</label>
             <textarea class="form-control" rows="3" name="descripcion" id="descripcion" style="border: thin solid lightgrey;" aria-describedby="comentHelp" value="{{ old('descripcion') }}" maxlength="150"></textarea>
             <small id="comentHelp" class="form-text text-muted">Este campo es opcional. </small>
            @if ($errors->has('descripcion'))
                <div id="descripcion-error" class="error text-danger pl-3" for="descripcion" style="display: block;">
                  <strong>{{ $errors->first('descripcion') }}</strong>
                </div>
              @endif
            </div>
            <?php 
                    }
                    else{?>
                    @if($tipodoc=='Grado')
          @if($valor=='0')
          <div class="row">
          <div class="col">
            <label>Espacio curricular</label>
              <select name="espaciocurricular" id="espaciocurricular" class="form-control" value="{{ old('espaciocurricular') }}">
                <option value=""></option>
                <?php
                $contador=count($nombreespacios)-1;
                for ($i=0; $i <= $contador ; $i++) { 
                $nombreespacios = preg_replace('/[\[\]\.\;\""]+/', '', $nombreespacios);
                  ?>
                <option value="{{$nombreespacios[$i]}}">{{$nombreespacios[$i]}}</option>
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
          <div class="col">
              <br>
              <input type="checkbox" name="aplicaespacios" id="aplicaespacios" value="aplicaespacios"onclick="espaciocurricular.disabled =this.checked">&nbsp<label>Aplica a todos los espacios curriculares</label>
          </div>
        </div>
          @else
          <div class="row">
          <div class="col">
            <label>Espacio curricular</label>
              <select name="espaciocurricular" id="espaciocurricular" class="form-control" value="{{ old('espaciocurricular') }}">
                
                <option value="{{$nombreespaciocurri}}">{{$nombreespaciocurri}}</option>
                <option value=""></option>
                <?php
                $contador=count($infocol)-1;
                for ($i=0; $i <= $contador ; $i++) { 
                $nombreespacios=App\Models\espacioscurriculares::where('id',$infocol[$i])->get();
                foreach($nombreespacios as $nombreesp){
                $nomespacio="$nombreesp->nombre";
                ?>
                <option value="{{$nomespacio}}">{{$nomespacio}}</option>
                <?php
                }
                }
                ?>
              </select>
            @if ($errors->has('espaciocurricular'))
                <div id="espaciocurricular-error" class="error text-danger pl-3" for="espaciocurricular" style="display: block;">
                  <strong>{{ $errors->first('espaciocurricular') }}</strong>
                </div>
              @endif
          </div>
          <div class="col">
              <br>
              <input type="checkbox" name="aplicaespacios" id="aplicaespacios" value="aplicaespacios"onclick="espaciocurricular.disabled =this.checked" checked="{{$check3}}">&nbsp<label>Aplica a todos los espacios curriculares</label>
          </div>
        </div>
          @endif
          @else
          @if($valor=='0')
          <div class="row">
          <div class="col">
            <label>Grado</label>
              <select name="grado" id="grado" class="form-control" value="{{old('grado') }}">
                    <option value=""></option>
                    <?php
                    $cont=count($nombresgrado)-1;
                    for($i=0;$i<=$cont;$i++){?>
                    <option value="{{$nombresgrado[$i]}}">{{$nombresgrado[$i]}}</option>
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

            <div class="col">
              <br>
              <input type="checkbox" name="aplicagrados" id="aplicagrados" value="aplicagrados" onclick="grado.disabled =this.checked,aplicadivisiones.disabled =this.checked">&nbsp<label>Aplica a todos los grados</label>
              <br><input type="checkbox" name="aplicadivisiones" id="aplicadivisiones" value="aplicadivisiones">&nbsp<label>Aplica a todas las divisiones</label>
            </div>
          </div>
            @else
            <div class="row">
            <div class="col">
            <label>Grado</label>
              <select name="grado" id="grado" class="form-control" value="{{old('grado') }}">
                    <option value="{{$nombregrado}}">{{$nombregrado}}</option>
                    <option value=""></option>
                    <?php
                    $cont=count($nombresgrado)-1;
                    for($i=0;$i<=$cont;$i++){?>
                    <option value="{{$nombresgrado[$i]}}">{{$nombresgrado[$i]}}</option>
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
            <div class="col">
              <br>
              <input type="checkbox" name="aplicagrados" id="aplicagrados" value="aplicagrados" onclick="grado.disabled =this.checked,aplicadivisiones.disabled =this.checked" checked="{{$check1}}">&nbsp<label>Aplica a todos los grados</label>
              <br><input type="checkbox" name="aplicadivisiones" id="aplicadivisiones" value="aplicadivisiones" checked="{{$check2}}">&nbsp<label>Aplica a todas las divisiones</label>
            </div>
          </div>
            @endif
            @endif
        <br>
        <div class="row">
        <div class="col">
            <label>Etapa</label>
            <br>
            <select id="periodo" name="periodo" class="form-control" value="periodo">
            <option value=""></option>
                @if($informacionperiodo=='Bimestre')
                <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                <option value="Tercera Etapa">Tercera Etapa</option>
                <option value="Cuarta Etapa">Cuarta Etapa</option>
                @endif
                @if($informacionperiodo=='Trimestre')
                <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                <option value="Tercera Etapa">Tercera Etapa</option>
                @endif
                @if($informacionperiodo=='Cuatrimestre')
                <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                @endif
                @if($informacionperiodo=='Semestre')
                <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                @endif
            </select>
            @if ($errors->has('periodo'))
                <div id="periodo-error" class="error text-danger pl-3" for="periodo" style="display: block;">
                  <strong>{{ $errors->first('periodo') }}</strong>
                </div>
              @endif
        </div>
        <div class="col">
              <br>
              <br>
              <input type="checkbox" name="aplicaperiodo" id="aplicaperiodo" value="aplicaperiodo">&nbsp<label>Aplica a todas las etapas</label>
        </div>
        </div>
        <br>
        <div class="row">
          <div class="col">
            <label>Criterio de evaluación</label>
              <input type="text" name="criterio" class="form-control" value="{{ old('criterio') }}">
            @if ($errors->has('criterio'))
                <div id="criterio-error" class="error text-danger pl-3" for="criterio" style="display: block;">
                  <strong>{{ $errors->first('criterio') }}</strong>
                </div>
              @endif
          </div>
        <div class="col">
            <label>Ponderación</label>
            <br>
            <small class="form-text" id="etiqueta"></small>
            <input id="input" name="ponderacion" type="range" min="1" max="5" step="1" list="opciones" value="0">
            <datalist id="opciones">
            <option value="1" label="1">
            <option value="2" label="2">
            <option value="3" label="3">
            <option value="4" label="4">
            <option value="5" label="5">
            </datalist>
            <script type="text/javascript">
            var elInput = document.querySelector('#input');
            if (elInput) {
            var etiqueta = document.querySelector('#etiqueta');
            if (etiqueta) {
            if(elInput.value=='1'){
            etiqueta.innerHTML = "Ponderación muy baja";
            document.getElementById('etiqueta').style.color = '#008000';
            }
            elInput.addEventListener('input', function() {
            if(elInput.value=='1'){
            etiqueta.innerHTML = "Ponderación muy baja";
            document.getElementById('etiqueta').style.color = '#008000';
            }
            if(elInput.value=='2'){
            etiqueta.innerHTML = "Ponderación baja";
            document.getElementById('etiqueta').style.color = '#57a639';
            }
            if(elInput.value=='3'){
            etiqueta.innerHTML = "Ponderación media";
            document.getElementById('etiqueta').style.color = '#cccc00';
            }
            if(elInput.value=='4'){
            etiqueta.innerHTML = "Ponderación alta";
            document.getElementById('etiqueta').style.color = '#FF8000';
            }
            if(elInput.value=='5'){
            etiqueta.innerHTML = "Ponderación muy alta";
            document.getElementById('etiqueta').style.color = '#FF0000';
            }
            }, false);
            }
            }
            </script>
            <small class="form-text text-muted">Permite darle un peso al criterio de evaluación para luego obtener una nota final.</small>   
            @if ($errors->has('ponderacion'))
                <div id="ponderacion-error" class="error text-danger pl-3" for="ponderacion" style="display: block;">
                  <strong>{{ $errors->first('ponderacion') }}</strong>
                </div>
              @endif
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col">
          <label>Descripción</label>
             <textarea class="form-control" rows="3" name="descripcion" id="descripcion" style="border: thin solid lightgrey;" aria-describedby="comentHelp" value="{{ old('descripcion') }}" maxlength="150"></textarea>
             <small id="comentHelp" class="form-text text-muted">Este campo es opcional. </small>
            @if ($errors->has('descripcion'))
                <div id="descripcion-error" class="error text-danger pl-3" for="descripcion" style="display: block;">
                  <strong>{{ $errors->first('descripcion') }}</strong>
                </div>
              @endif
            </div>
          </div>  
          <?php 
                    } 
                    ?>

          
         <!-- <div class="text-center">
            <a type="button" class="btn btn-success btn-sm" style="font-size: 0.5em;">
          <i class="bi bi-plus-circle" style="font-size: 2em;color: white;" title="Agregar criterio"></i>
            </a>
          </div> -->
          <br>
          <div class="card-footer">
          <div class=" col-xs-12 col-sm-12 col-md-12 text-center ">
                <button type="submit" class="btn btn-sm btn-facebook" name="guardar" value="1">Guardar y crear otro</button>
                <button type="submit" class="btn btn-sm btn-facebook" name="guardar" value="0">Guardar y salir</button>
                <button type="reset" class="btn btn-sm btn-facebook">Limpiar</button>
          </div>
        </div>
        @endif
      </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection