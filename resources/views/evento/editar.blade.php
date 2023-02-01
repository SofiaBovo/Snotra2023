@extends('layouts.main' , ['activePage' => 'eventos', 'titlePage => Editar Evento'])

@section ('content')
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{route('actualizarevento',$id->id)}}" method="POST" class="form-horizontal">
        @csrf
        @METHOD('PUT')
        <div class="card">
          <div class= "card-header card-header-info">
          <h4 class="card-title">Editar evento</h4>
          </div>
        <div class="card-body">
       <div class="form-group">
                <label>Tipo de Evento</label>
                <select name="tipo" id="tipoevento" class="form-control" value="{{$id->tipo}}">
                    <option value="Acto Escolar" <?php if($id->tipo=='Acto escolar') echo 'selected="selected" ';?>>Acto Escolar</option>
                    <option value="Reunión" <?php if($id->tipo=='Reunión') echo 'selected="selected" ';?>>Reunión</option>
                </select>
                <script>
                $(function(){
                $("#tipoevento").val(value="{{ old('tipo') }}")
                });
               </script>
            @if ($errors->has('tipo'))
                <div id="tipo-error" class="error text-danger pl-3" for="tipo" style="display: block;">
                  <strong>{{ $errors->first('tipo') }}</strong>
                </div>
              @endif
              
          </div>
    
    <div class="form-group">
    <label >Título del Evento</label>
    <input type="text" class="form-control" name="titulo" aria-describedby="eventoHelp" value="{{$id->titulo}}">
    <small id="eventoHelp" class="form-text text-muted">Por ejemplo: Acto fin de año.</small>
    @if ($errors->has('titulo'))
                <div id="titulo-error" class="error text-danger pl-3" for="titulo" style="display: block;">
                  <strong>{{ $errors->first('titulo') }}</strong>
                </div>
              @endif
    </div>
<script type="text/javascript">
var limit = 150;
$(function() {
    $("#descripcion").on("input", function () {
        //al cambiar el texto del txt_detalle
        var init = $(this).val().length;
        total_characters = (limit - init);
        $('#contador').html(total_characters + " caracteres restantes.");
    });
});
</script>
     <div class="form-group">
    <label>Comentario sobre el evento.<small class="form-text text-muted contador" id="contador">150 caracteres restantes.</small></label>
    <textarea class="form-control" rows="3" name="descripcion" id="descripcion" style="border: thin solid lightgrey;" aria-describedby="comentHelp" value="{{$id->descripcion}}" maxlength="150">{{ old('descripcion', $id->descripcion) }}</textarea>
    <small id="comentHelp" class="form-text text-muted">Este campo es opcional. </small>
    @if ($errors->has('descripcion'))
                <div id="descripcion-error" class="error text-danger pl-3" for="descripcion" style="display: block;">
                  <strong>{{ $errors->first('descripcion') }}</strong>
                </div>
              @endif
    </div>

  <div class="form-group">
    <label >Lugar del Evento</label>
    <input type="text" class="form-control" name="lugar" value="{{$id->lugar}}">
    @if ($errors->has('lugar'))
                <div id="lugar-error" class="error text-danger pl-3" for="lugar" style="display: block;">
                  <strong>{{ $errors->first('lugar') }}</strong>
                </div>
              @endif
    </div>
      <?php
      $detect = new Mobile_Detect;
      if ($detect->isMobile() or $detect->isTablet()) {?>
        <div class="form-group" >
          <label>Fecha del Evento</label>
            <input type="date" name="fecha" class="form-control"  value="{{$id->fecha}}" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>">
            @if ($errors->has('fecha'))
                <div id="fecha-error" class="error text-danger pl-3" for="fecha" style="display: block;">
                  <strong>{{ $errors->first('fecha') }}</strong>
                </div>
              @endif
    </div>
    <div class="form-group">
          <label>Hora del Evento</label>
            <input type="time" name="hora" class="form-control"  value="{{$id->hora}}">
            @if ($errors->has('hora'))
                <div id="hora-error" class="error text-danger pl-3" for="hora" style="display: block;">
                  <strong>{{ $errors->first('hora') }}</strong>
                </div>
              @endif
    </div>
        <?php 
        }
        else{?>
        <div class="row">
        <div class="form-group col" style="margin-left:-15px; ">
          <label>Fecha del Evento</label>
            <input type="date" name="fecha" class="form-control"  value="{{$id->fecha}}" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>">
            @if ($errors->has('fecha'))
                <div id="fecha-error" class="error text-danger pl-3" for="fecha" style="display: block;">
                  <strong>{{ $errors->first('fecha') }}</strong>
                </div>
              @endif
        </div>
        <div class="form-group col">
          <label>Hora del Evento</label>
            <input type="time" name="hora" class="form-control"  value="{{$id->hora}}">
            @if ($errors->has('hora'))
                <div id="hora-error" class="error text-danger pl-3" for="hora" style="display: block;">
                  <strong>{{ $errors->first('hora') }}</strong>
                </div>
              @endif
    </div>
  </div>
  <?php   
        }
        ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
  <div class="form-group">
    <label>Participantes</label><br>
    <select class="form-control participantes" name="participantes[]" id='participantes' multiple="multiple" lang="es" value="{{$id->participantes}}">
    <?php
    $array=explode(' ', $id->participantes);
    for ($i=0;$i<count($array);$i++)    
      {     
       $nombreparticipante=App\Models\User::where('id',$array[$i])->get();
        foreach ($nombreparticipante as $nom) {
          $nomparti="$nom->name";
          $idparti="$nom->id";
        }
      ?>
        <option value="{{$idparti}}"<?php echo 'selected="selected" ';?>>
       {{$nomparti}}
       </option>
       <?php
      }
      ?>
    </select>
    <script type="text/javascript">
    $('.participantes').select2({
    placeholder: 'Ingrese nombre o apellido',
    ajax: {
    url: '/autocomplete/getAutocomplete/',
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
              return {
                  text: item.name,
                  id: item.id
              }
          })
      };
    },

    cache: true
    }
});
    
</script>

    @if ($errors->has('participantes'))
                <div id="participantes-error" class="error text-danger pl-3" for="participantes" style="display: block;">
                  <strong>{{ $errors->first('participantes') }}</strong>
                </div>
              @endif
    </div>

      

</div>
  <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
                <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
          </div>
        </div>
      </form>
    </div> 
    </div> 
    </div> 
    </div> 
    </div> 


  
@endsection