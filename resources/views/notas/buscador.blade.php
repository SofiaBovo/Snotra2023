@extends('layouts.main' , ['activePage' => 'carganotas', 'titlePage => Buscador de notas'])

@section ('content')
 <div class="content">
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title ">Registro de valoraciones por etapa</h4>
              </div>
              <div class="card-body">
                @foreach($infoaño as $año)
                  <div class="text-left">
                  <h5><span class="badge badge-success">El año escolar activo es el {{$año->descripcion}}.</span></h5>
                  </div>
                @endforeach
                @if(empty($nombresgrado))
                <div class="text-center">
                <h5><span class="badge badge-warning">Para cargar notas se necesita estar asociado a al menos un grado.</span></h5>
                </div>
                @else
                <form action="{{route('listadonotas') }}" class="form-horizontal">
                <div class="row">
               @if($tipodoc!='Grado')
                <div class="col">
                <label>Grado</label>
                <select name="grado" id="grado" class="form-control" value="">
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
                @else
                <div class="col">
                <label>Espacio curricular</label>
                <select name="espacio" id="espacio" class="form-control" value="{{ old('espacio')}}">
                <?php
                $nombreespacios = preg_replace('/[\[\]\.\;\""]+/', '', $nombreespacios);
                $cont=count($nombreespacios)-1;
                ?>
                <option value=""></option>
                <?php
                for($i=0;$i<=$cont;$i++){?>
                <option value="{{$nombreespacios[$i]}}">{{$nombreespacios[$i]}}</option>
                <?php
                }
                ?>
                </select>
                @if ($errors->has('espacio'))
                <div id="espacio-error" class="error text-danger pl-3" for="espacio" style="display: block;">
                  <strong>{{ $errors->first('espacio') }}</strong>
                </div>
                @endif
                </div>
                @endif
                <div class="col">
                <label>Etapa</label>
                <select name="periodo" id="periodo" class="form-control" value="{{old('periodo') }}">
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
                </div>
                <br>
                <div class="text-right">
                  <button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
                </div>
                </form>
                @endif
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
</div>
@endsection


      
