@extends('layouts.main', ['activePage' => 'configuraciones', 'titlePage' => __('')])

@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script type="text/javascript">
function valoracionnumerica() {
    var x = document.getElementById('valoracionnumerica');
    if (x.style.display =='none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
</script>
  <script type="text/javascript">
function valoracioncualitativa() {
    var x = document.getElementById('valoracioncualitativa');
    if (x.style.display =='none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
</script>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12">
        <form action="{{ url('configuraciones/create') }}" method="POST" class="form-horizontal">
          @csrf
            
            <div class="card">
            
            <div class= "card-header card-header-info">
            <h4 class="card-title">Configuraciones</h4>
            <p class="card-category">Configuraciones básicas</p>
            </div>

             @if($colegio->isEmpty())
              <br>
              <div class="col-md-12 text-center">
              <h4><span class="badge badge-warning">Para cargar las configuraciones básicas, antes deberá cargar la información del colegio.</span></h4>
              </div>
              <br>
              @else

            
            <div class="card-body">
              @if(session('success'))
                    <div class="alert alert-success text-left" role="success">
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

            <div class="col">
            
            <label><strong>Período</strong></label>
            <br>
            @foreach($colegio as $colegios)
            <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="periodo" value="Bimestre" <?php if($colegios->periodo=='Bimestre') echo 'checked ';?>>Bimestre
                  <span class="circle">
                      <span class="check"></span>
                  </span>
                </label>
              </div>
                  <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="periodo" value="Trimestre"<?php if($colegios->periodo=='Trimestre') echo 'checked ';?>>Trimestre
                  <span class="circle">
                      <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="periodo" value="Cuatrimestre"<?php if($colegios->periodo=='Cuatrimestre') echo 'checked ';?>>Cuatrimestre
                  <span class="circle">
                      <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="periodo"  value="Semestre" <?php if($colegios->periodo=='Semestre') echo 'checked ';?>>Semestre
                  <span class="circle">
                      <span class="check"></span>
                  </span>
                </label>
              </div>

            @if ($errors->has('periodo'))
                <div id="periodo-error" class="error text-danger pl-3" for="periodo" style="display: block;">
                  <strong>{{ $errors->first('periodo') }}</strong>
                </div>
              @endif
         <br>

         <br>
         

         <label><strong>Turno</strong></label>
            <br>
            <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="turno"  value="Mañana"<?php if($colegios->turno=='Mañana') echo 'checked ';?>>Mañana
                  <span class="circle">
                      <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="turno" value="Tarde"<?php if($colegios->turno=='Tarde') echo 'checked ';?>>Tarde
                  <span class="circle">
                      <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="turno" value="Ambos"<?php if($colegios->turno=='Ambos') echo 'checked ';?>>Ambos
                  <span class="circle">
                      <span class="check"></span>
                  </span>
                </label>
              </div>
            @if ($errors->has('turno'))
                <div id="turno-error" class="error text-danger pl-3" for="turno" style="display: block;">
                  <strong>{{ $errors->first('turno') }}</strong>
                </div>
              @endif
          <br>

          <br>
          <label><strong>Cantidad de grados</strong></label>
            <br>
            <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="grados"  value="Seis"<?php if($colegios->grados=='Seis') echo 'checked ';?>>Seis Grados
                  <span class="circle">
                      <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="grados"  value="Siete"<?php if($colegios->grados=='Siete') echo 'checked ';?>>Siete Grados
                  <span class="circle">
                      <span class="check"></span>
                  </span>
                </label>
              </div>
              @if ($errors->has('turno'))
                <div id="grados-error" class="error text-danger pl-3" for="grados" style="display: block;">
                  <strong>{{ $errors->first('grados') }}</strong>
                </div>
              @endif
              <br>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
              
          <div class="form-group">
          <label><strong>Divisiones</strong></label>
          <br>
          <select class="form-control divisiones" name="divisiones[]" id='divisiones' multiple="multiple" lang="es" style="width: 100%">
          @if(empty($colegios->divisiones))
          @else
          <?php
            $res = preg_replace('/[\[\]\.\;\" "]+/', '', $colegios->divisiones);
            $array=explode(',', $res);
            for ($i=0;$i<=count($array)-1;$i++){     
              $division=App\Models\Abecedario::where('id',$array[$i])->get();
              foreach ($division as $div) {
              $letradiv="$div->letras";
              $iddiv="$div->id";
                }
          ?>
            <option value="{{$iddiv}}"<?php echo 'selected="selected" ';?>>{{$letradiv}}</option>
          <?php
          }
          ?>
          @endif
          </select>
          <script type="text/javascript">
            $('.divisiones').select2({
            placeholder: 'Ingrese las divisiones que desea agregar',
            ajax: {
            url: '/autocomplete/divisiones/',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
            results:  $.map(data, function (item) {
              return {
                  text: item.letras,
                  id: item.id,
              }
          })
          };
          },
            cache: true
            }
            });
            $('#divisiones').select2('data');
        </script>
        <small id="eventoHelp" class="form-text text-muted">Por ejemplo: A.</small>
    @if ($errors->has('divisiones'))
      <div id="divisiones-error" class="error text-danger pl-3" for="divisiones" style="display: block;">
      <strong>{{ $errors->first('divisiones') }}</strong>
      </div>
      @endif
    </div>


    <div class="form-group">
    <label for="espacioscurriculares"><strong>Espacios curriculares</strong></label>
    <br>
    <select class="form-control espacioscurriculares" name="espacioscurriculares[]" id='espacioscurriculares' multiple="multiple" lang="es" style="width: 100%">
      @if(empty($colegios->espacioscurriculares))
      @else
      <?php
        $res = preg_replace('/[\[\]\.\;\" "]+/', '', $colegios->espacioscurriculares);
        $array=explode(',', $res);
     for ($i=0;$i<=count($array)-1;$i++)    
      {     
       $espacio=App\Models\espacioscurriculares::where('id',$array[$i])->get();
        foreach ($espacio as $es) {
          $espa="$es->nombre";
          $idespa="$es->id";
        }
      ?>
        <option value="{{$idespa}}"<?php echo 'selected="selected" ';?>>
       {{$espa}}
       </option>
       <?php
      }
      ?>
      @endif
    </select>
    <small id="eventoHelp" class="form-text text-muted">Por ejemplo: Matemática.</small>
    <script type="text/javascript">
    $('.espacioscurriculares').select2({

    tokenSeparators: [','],
    placeholder: 'Ingrese los espacios curriculares que desea agregar',
    minimumInputLength: 3,
    tags: true,
    tokenSeparatrs : [ ',' , ' ' ],
    ajax: {
    url: '/autocomplete/espacioscurriculares/',
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
              return {
                  text: item.nombre,
                  id: item.id
              }
          })
      };
    },
    cache: true
    }
});
</script>
    @if ($errors->has('espacioscurriculares'))
      <div id="espacioscurriculares-error" class="error text-danger pl-3" for="espacioscurriculares" style="display: block;">
      <strong>{{ $errors->first('espacioscurriculares') }}</strong>
      </div>
      @endif
    </div>
    <div class="form-group">
    <label><strong>Forma de calificación</strong></label>
    <div class="row">
    <br>
    <?php 
    $detect = new Mobile_Detect;
    if ($detect->isMobile() or $detect->isTablet()) {?>
    &nbsp&nbsp&nbsp&nbsp&nbsp<div class="col form-check-inline form-group">
    <?php 
    }
    else{?>
    <div class="col form-check-inline form-group"> 
    <?php 
    }
    ?>
    <script type="text/javascript">
    function modificarradio() {
    var num = document.getElementById('calificacionnumerica');
    var cuali = document.getElementById('calificacioncualitativa');
    var numerico = document.getElementById('numerico');
    var cualitativo = document.getElementById('cualitativo');
    var cualitativa= document.getElementById('calicualitativas');
    var numerica= document.getElementById('califinumericas');
    var numericas= document.getElementById('califinumericass');
    if(num.checked){
    if (numerico.style.display =='none') {
        numerico.style.display = 'block';
        cualitativo.style.display = 'none';
        cualitativa.disabled=true;
    } 
    }
    if(cuali.checked){
    if (cualitativo.style.display =='none') {
        cualitativo.style.display = 'block';
        numerico.style.display = 'none';
        numerica.disabled=true;
        numericas.disabled=true;
    }
    }
}
    </script>
        <label class="form-check-label">
        <input class="form-check-input" type="radio" name="calificacion" value="calificacion" id="calificacionnumerica" onchange="modificarradio()" <?php if(empty($colegios->calicualitativa)) echo 'checked ';?>>Calificación Numérica
        </label>&nbsp&nbsp&nbsp&nbsp
        <br>
        @if ($errors->has('calinumerica'))
        <div id="calinumerica-error" class="error text-danger pl-3" for="calinumerica" style="display: block;"><strong>{{ $errors->first('calinumerica') }}</strong>
            </div>
       @endif
        <label class="form-check-label">
        <input class="form-check-input" id="calificacioncualitativa" type="radio" name="calificacion" value="Cualitativa" onchange="modificarradio()" <?php if(empty($colegios->calinumerica)) echo 'checked ';?>>Calificación Cualitativa
        </label>
    </div> 
    </div>
    <div id="numerico" style="display:none;">
    <small><u><strong>Valores a modificar</strong></u></small>
      <br>
      <label>Valor Mínimo</label> 
          <input type="number" name="minimo" style="width: 6%" min="1">
          &nbsp&nbsp 
      <label>Valor Máximo</label>
      <input type="number" name="maximo" style="width: 6%" min="1" max="100">
    </div>
    <div id="cualitativo" style="display:none;">
      <small><u><strong>Valores a modificar</strong></u></small>
     <select class="form-control calicualitativa" name="calicualitativa[]" id="calicualitativa" multiple="multiple" lang="es" style="width: 100%">
    </select>
    <small id="eventoHelp" class="form-text text-muted">Por ejemplo: Excelente.</small>
    <script type="text/javascript">
    $('.calicualitativa').select2({
    placeholder: 'Ingrese las calificaciones que desea agregar',
    tokenSeparators: [','],
    tags: true,
    tokenSeparatrs : [ ',' , ' ' ],
    ajax: {
    url: '/autocomplete/calificacion/',
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
              return {
                  text: item.calificacion,
                  id: item.id_calificacion
              }
          })
      };
    },
    cache: true
    }
});
</script>
    </div>
      <?php
      if(empty($colegios->calicualitativa) and $colegios->calinumerica){
      $caracteres=$colegios->calinumerica;
      $caracteres = preg_replace('/[\[\]\.\;\""]+/', '', $caracteres);
      $caracteres=explode(',',$caracteres);
      $valormaximo = $caracteres[1];
      $valorminimo = $caracteres[0];
      ?>
      <div>
      <small><u><strong>Valores actuales</strong></u></small>
      <br>
      <label>Valor Mínimo</label> 
          <input type="number" name="minimo" style="width: 6%" min="1" value="{{$valorminimo}}" id="califinumericas">
          &nbsp&nbsp 
      <label>Valor Máximo</label>
      <input type="number" name="maximo" id="califinumericass" style="width: 6%" value="{{$valormaximo}}" min="1" max="100">
    </div>
    </div>

    <?php 
    }
    if(empty($colegios->calinumerica) and $colegios->calicualitativa){?>
    <small><u><strong>Valores actuales</strong></u></small>
    <select class="form-control calicualitativas" name="calicualitativas[]" id="calicualitativas" multiple="multiple" lang="es" style="width: 100%"><?php echo 'selected="selected" ';?>
    @if(empty($colegios->calicualitativa))
      @else
      <?php
        $res = preg_replace('/[\[\]\.\;\" "]+/', '', $colegios->calicualitativa);
        $array=explode(',', $res);
     for ($i=0;$i<=count($array)-1;$i++)    
      {     
       $calificaciones=App\Models\calificacioncualitativa::where('id_calificacion',$array[$i])->get();
        foreach ($calificaciones as $cali) {
          $nombrecali="$cali->calificacion";
          $idcali="$cali->id_calificacion";
        }
      ?>
        <option value="{{$idcali}}"<?php echo 'selected="selected" ';?>>
       {{$nombrecali}}
       </option>
       <?php
      }
      ?>
      @endif
    </select>
    <small id="eventoHelp" class="form-text text-muted">Por ejemplo: Excelente.</small>
    <script type="text/javascript">
    $('.calicualitativas').select2({
    placeholder: 'Ingrese las calificaciones que desea agregar',
    tokenSeparators: [','],
    tokenSeparatrs : [ ',' , ' ' ],
    ajax: {
    url: '/autocomplete/calificacion/',
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
              return {
                  text: item.calificacion,
                  id: item.id_calificacion
              }
          })
      };
    },
    cache: true
    }
});
</script>
  @if ($errors->has('calificacion'))
  <div id="calificacion-error" class="error text-danger pl-3" for="calificacion" style="display: block;">
      <strong>{{ $errors->first('calificacion') }}</strong>
      </div>
      @endif
   </div>
   <?php 
    }
    ?>
    </div>



    </div> <!--cierra el col-->
              
              @endforeach


    </div> <!--cierra el row-->
          



      <div class="card-footer">
        <div class="  col-xs-12 col-sm-12 col-md-12 text-right ">
          <button type="submit" class="btn btn-sm btn-facebook">Guardar</button>
        </div>
      </div>
         @endif
      



      </div> <!--cierra card body-->
      
      </div>
      
      </div>
      
      </form>
      </div>
    </div>
   </div>
   </div>
@endsection



