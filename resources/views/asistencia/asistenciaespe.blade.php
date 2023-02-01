@extends('layouts.main' , ['activePage' => 'cargasistencia', 'titlePage => Registro de Asistencias'])

@section ('content')
 <div class="content">
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title "> Asistencias</h4>
                <p class="card-category">Registro de asistencias</p>    
              </div>
              <div class="card-body">
              @foreach($infoaño as $año)
                <div class="text-left">
                <h5><span class="badge badge-success">El año escolar activo es el {{$año->descripcion}}.</span></h5>
                </div>
              @endforeach
              <form action="{{route('listado.asistencias')}}">
              <div class="row">
              <div class="col">
              <label>Mes</label>
              <select name="mes" id="mes" class="form-control">
                <?php 
                $mes=date("m");
                if($mes==1){
                $mes='Enero';
                }
                if($mes==2){
                $mes='Febrero';
                }
                if($mes==3){
                $mes='Marzo';
                }
                if($mes==4){
                $mes='Abril';
                }
                if($mes==5){
                $mes='Mayo';
                }
                if($mes==6){
                $mes='Junio';
                }
                if($mes==7){
                $mes='Julio';
                }
                if($mes==8){
                $mes='Agosto';
                }
                if($mes==9){
                $mes='Septiembre';
                }
                if($mes==10){
                $mes='Octubre';
                }
                if($mes==11){
                $mes='Noviembre';
                }
                if($mes==12){
                $mes='Diciembre';
                }
                ?>
                <option value="{{$mes}}">{{$mes}}</option>
                <?php
                $cont=count($meses)-1;
                for($i=0;$i<=$cont;$i++){
                    ?>
                <option value="{{$meses[$i]}}">{{$meses[$i]}}</option>
                <?php
                }
                ?>
                </select>
              </div>
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
              </div>
            </div>
              <br>
              <div class="text-right">
                  <button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
              </div>
            </form>
              </div>
                  
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
@endsection


      
