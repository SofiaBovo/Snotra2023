@extends('layouts.main', ['activePage' => 'editargrado', 'titlePage' => __('')])
  
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{route('actualizargrado',$grados->id)}}" method="POST" class="form-horizontal">
        @csrf
        @METHOD('PUT')
        <div class="card">
          <div class= "card-header card-header-info">
          <h4 class="card-title">Editar {{$grados->descripcion}}</h4>
          </div>
        <div class="card-body">
          <div class="col form-group">
            <label>Seleccionar año escolar</label>
              <select name="id_anio" class="form-control">
                <option value="{{$grados->id_anio}}" <?php echo 'selected="selected" ';?>>
                  <?php
                  use App\Models\Año;
                  $seleccionaño=Año::where('id', $grados->id_anio)->get();
                  foreach ($seleccionaño as $select) {
                    $seleccion="$select->descripcion";
                  }
                  ?>
                  {{$seleccion}}</option>
                  @foreach($año as $años)
                  <?php if($años->id!=$grados->id_anio){?>
                  <option value="{{$años->id}}">{{$años->descripcion}} </option>
                  <?php 
                  }
                  ?>
                  @endforeach
              </select>
            @if ($errors->has('id_anio'))
                <div id="id_anio-error" class="error text-danger pl-3" for="id_anio" style="display: block;">
                  <strong>{{ $errors->first('id_anio') }}</strong>
                </div>
              @endif
          </div>
            <div class="col form-group">
            <label>Seleccionar docente de grado</label>
              <select name="id_docentes" class="form-control">
                <option value="{{$grados->id_docentes}}" <?php echo 'selected="selected" ';?>>
                  <?php
                  use App\Models\Docente;
                  $selecciongrado=Docente::where('id', $grados->id_docentes)->get();
                  foreach ($selecciongrado as $selectdoc) {
                    $seleccionnombre="$selectdoc->nombredocente";
                    $seleccionapellido="$selectdoc->apellidodocente";
                  }
                  ?>
                  {{$seleccionnombre}} {{$seleccionapellido}}</option>
                  @foreach($docentes as $doc)
                  <option value="{{$doc->id}}">{{$doc->nombredocente}} {{$doc->apellidodocente}}</option>
                  @endforeach
                </select>
            @if ($errors->has('id_docentes'))
                <div id="id_docentes-error" class="error text-danger pl-3" for="id_docentes" style="display: block;">
                  <strong>{{ $errors->first('id_docentes') }}</strong>
                </div>
              @endif
          </div>   
          </div>
          <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
                <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
          </div>
        </div>
      </div>
      </form>
        </div>
        
      </div>
    </div>
  </div>
@endsection