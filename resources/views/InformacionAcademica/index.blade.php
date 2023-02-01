@extends('layouts.main' , ['activePage' => 'informacionacademica', 'titlePage => Información Académica'])
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
                <form action="{{route('listadoinfoacademica')}}" class="form-horizontal">
                  @csrf
                <div class="row">
                <div class="col">
                <label>Año lectivo</label>
                <select name="añolectivo" id="añolectivo" class="form-control" value="">
                <option value="{{$añolec}}">{{$añolec}}</option>
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
                <option value="{{$infgrado}}">{{$infgrado}}</option>
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
                <select class="form-control alumno" name="alumno" id='alumno' lang="es" style="width: 100%;height:100%">
                <option value="{{$alumno}}"<?php echo 'selected="selected" ';?>>{{$nombrealumno}}</option>
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
                <option value="{{$espaciocurricular}}">{{$espaciocurricular}}</option>
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
                  <a href="{{url ('informacionacademica') }}" class="btn btn-sm btn-facebook">Limpiar</a>
                </div>
                </form>
               @if($inforgrado->isEmpty())
                <div class="text-center"> 
                <h4><span class="badge badge-warning">No se encontraron resultados para los criterios seleccionados en la búsqueda.</span></h4>
                </div>
               @else
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th>Año</th>
                      <th>Alumnos</th>
                      <th>Grado</th>
                      <th>Espacio curricular</th>
                      <?php
                      if($informacionperiodo=='Bimestre'){
                        ?>
                        <th>1ra. Etapa</th>
                        <th>2da. Etapa</th>
                        <th>3ra. Etapa</th>
                        <th>4ta. Etapa</th>
                      <?php 
                    }
                      if($informacionperiodo=='Trimestre'){
                        ?>
                        <th>1ra. Etapa</th>
                        <th>2da. Etapa</th>
                        <th>3ra. Etapa</th>
                      <?php 
                      }
                       if($informacionperiodo=='Cuatrimestre'){
                        ?>
                        <th>1ra. Etapa</th>
                        <th>2da. Etapa</th>
                        <?php 
                      }
                      if($informacionperiodo=='Semestre'){
                        ?>
                        <th>1ra. Etapa</th>
                        <th>2da. Etapa</th>
                        <?php 
                      }
                      ?>
                    </thead>    
                    @foreach($inforgrado as $grado)  
                    <tbody>
                    <tr>
                    <?php 
                    $descripcionaño=App\Models\Año::where('id',$grado->año)->pluck("descripcion");
                    $descripcionaño = preg_replace('/[\[\]\.\;\""]+/', '', $descripcionaño);
                    $nombrealumno=App\Models\Alumno::where('id',$grado->id_alumno)->pluck("nombrecompleto");
                    $nombrealumno = preg_replace('/[\[\]\.\;\""]+/', '', $nombrealumno);
                    ?>
                      <td class="v-align-middle">{{$descripcionaño}}</td>
                      <td class="v-align-middle">{{$nombrealumno}}</td>
                      <td class="v-align-middle">{{$grado->grado}}</td>
                      <td class="v-align-middle">{{$grado->espacio}}</td>
                      <?php 
                      $arregloB=['null','null','null','null'];
                      $arregloT=['null','null','null'];
                      $arregloC=['null','null'];  
                      ?>
                      @foreach($ingrado as $informaciongrado)
                      @if($grado->id_alumno==$informaciongrado->id_alumno && $grado->año==$informaciongrado->año && $grado->espacio==$informaciongrado->espacio && $grado->grado==$informaciongrado->grado)
                      <?php
                      if($informacionperiodo=='Bimestre'){
                      if($informaciongrado->periodo=='Primera Etapa'){
                      $arregloB[0]=$informaciongrado->nota;
                      }
                      elseif($informaciongrado->periodo=='Segunda Etapa'){
                      $arregloB[1]=$informaciongrado->nota; 
                      }
                      elseif($informaciongrado->periodo=='Tercera Etapa'){
                      $arregloB[2]=$informaciongrado->nota; 
                      }
                      else{
                      $arregloB[3]=$informaciongrado->nota; 
                      }
                      }
                      if($informacionperiodo=='Trimestre'){
                      if($informaciongrado->periodo=='Primera Etapa'){
                      $arregloT[0]=$informaciongrado->nota;
                      }
                      elseif($informaciongrado->periodo=='Segunda Etapa'){
                      $arregloT[1]=$informaciongrado->nota; 
                      }
                      else{
                      $arregloT[2]=$informaciongrado->nota; 
                      }
                      }
                      if($informacionperiodo=='Cuatrimestre'){
                      if($informaciongrado->periodo=='Primera Etapa'){
                      $arregloC[0]=$informaciongrado->nota;
                      }
                      elseif($informaciongrado->periodo=='Segunda Etapa'){
                      $arregloC[1]=$informaciongrado->nota; 
                      }
                      }
                      if($informacionperiodo=='Semestre'){
                      if($informaciongrado->periodo=='Primera Etapa'){
                      $arregloC[0]=$informaciongrado->nota;
                      }
                      else{
                      $arregloC[1]=$informaciongrado->nota; 
                      }
                      }
                      ?>
                      @endif
                      @endforeach
                      <?php
                      if($informacionperiodo=='Bimestre'){
                      $contador=count($arregloB)-1; 
                      for($i=0;$i<=$contador;$i++){
                        if($arregloB[$i]=='null'){?>
                          <td class="v-align-middle">-</td>
                        <?php 
                        }
                        else{?>
                          <td class="v-align-middle">{{$arregloB[$i]}}</td>
                        <?php
                        }
                      }
                    }
                    if($informacionperiodo=='Trimestre'){
                      $contador=count($arregloT)-1; 
                      for($i=0;$i<=$contador;$i++){
                        if($arregloT[$i]=='null'){?>
                          <td class="v-align-middle">-</td>
                        <?php 
                        }
                        else{?>
                          <td class="v-align-middle">{{$arregloT[$i]}}</td>
                        <?php
                        }
                      }
                    }
                    if($informacionperiodo=='Cuatrimestre'){
                      $contador=count($arregloC)-1; 
                      for($i=0;$i<=$contador;$i++){
                        if($arregloC[$i]=='null'){?>
                          <td class="v-align-middle">-</td>
                        <?php 
                        }
                        else{?>
                          <td class="v-align-middle">{{$arregloC[$i]}}</td>
                        <?php
                        }
                      }
                    }
                    if($informacionperiodo=='Semestre'){
                      $contador=count($arregloC)-1; 
                      for($i=0;$i<=$contador;$i++){
                        if($arregloC[$i]=='null'){?>
                          <td class="v-align-middle">-</td>
                        <?php 
                        }
                        else{?>
                          <td class="v-align-middle">{{$arregloC[$i]}}</td>
                        <?php
                        }
                      }
                    }
                      ?>
                    </tr>
                    </tbody>
                    @endforeach
                  </table>
                  </div>
                  @if(empty($infgrado) and empty($añolec))
                  <form action="{{url ('linechart') }}">
                    <div style="display: none;">
                    <input type="text" name="alumno" value="{{$nombrealumno}}">
                    <input type="text" name="añolectivo" value="{{$añolec}}">
                    <input type="text" name="grado" value="{{$infgrado}}">
                    <input type="text" name="espacio" value="{{$espaciocurricular}}">
                    </div>
                    <div class="text-right">
                    <button  class="btn btn-sm btn-success">Visualizar gráfico</button>
                    </div>
                  </form>
                  @endif
                  @if(empty($infgrado) and empty($espaciocurricular))
                  <form action="{{url ('linechart') }}">
                    <div style="display: none;">
                    <input type="text" name="alumno" value="{{$nombrealumno}}">
                    <input type="text" name="añolectivo" value="{{$añolec}}">
                    <input type="text" name="grado" value="{{$infgrado}}">
                    <input type="text" name="espacio" value="{{$espaciocurricular}}">
                    </div>
                    <div class="text-right">
                    <button  class="btn btn-sm btn-success">Visualizar gráfico</button>
                    </div>
                  </form>
                  @endif
                  @if(empty($alumno) and empty($espaciocurricular))
                  <form action="{{url ('linechart') }}">
                    <div style="display: none;">
                    <input type="text" name="alumno" value="{{$alumno}}">
                    <input type="text" name="añolectivo" value="{{$añolec}}">
                    <input type="text" name="grado" value="{{$infgrado}}">
                    <input type="text" name="espacio" value="{{$espaciocurricular}}">
                    </div>
                    <div class="text-right">
                    <button  class="btn btn-sm btn-success">Visualizar gráfico</button>
                    </div>
                  </form>
                  @endif
                  @endif
                       </div>
                       <div class="card-footer mr-auto">
                    {{$inforgrado->links()}}
                </div>
                     </div>
                   </div>      
                </div>
          </div>
        </div>
      </div>
     </div>

@endsection


      
