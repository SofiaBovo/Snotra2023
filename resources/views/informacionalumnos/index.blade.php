@extends('layouts.main' , ['activePage' => 'infoalumnos', 'titlePage => Información académica'])
@section ('content')
<div class="content">
  <div class="container-fluid">
  <div class="row">
  <div class="col-md-12">
  <div class="row">
  <div class="col-md-12">
  @if(sizeof($idalumno)==0)
    <div class="card">
      <div class="card-header card-header-info">
      <h4 class="card-title">Información académica</h4>   
      </div>
       <div class="card-body">
        <div class="col-md-12 text-center">
        <h4><span class="badge badge-warning">Aún no fueron creados los alumnos asociados a este usuario.</span></h4>
        </div>
      </div>
    </div>
  @else
  <?php
  $contadorinformes=count($informes)-1;
  $contadoralumnos=count($idalumno)-1;
  $contadornotasfinales=count($informesfinales)-1;
  for($j=0;$j<=$contadoralumnos;$j++){?>
  <div class="card">
      <div class="card-header card-header-info">
        <?php 
        $nombrealumno=App\Models\Alumno::where('id',$idalumno[$j])->pluck('nombrecompleto');
        $nombrealumno = preg_replace('/[\[\]\.\;\""]+/', '', $nombrealumno);
        ?>
        <h4 class="card-title"><i class="fa-solid fa-user-graduate"></i> {{$nombrealumno}}</h4>   
      </div>
       <div class="card-body">
        <div class="table-responsive">
                <table class="table">
                  <thead class="text-primary">
                    <th>Espacio</th>
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
                    <th>Valoración final</th>
                  </thead>
                  <tbody>
                    <?php
                    $contadorespacios=count($nombreespacio)-1;
                    if($informacionperiodo=='Bimestre'){
                    $cont=($contadorespacios+1)*4;
                    }
                    elseif($informacionperiodo=='Trimestre'){
                    $cont=($contadorespacios+1)*3;
                    }
                    else{
                    $cont=($contadorespacios+1)*2;
                    }
                    for($m=0;$m<=$contadorespacios;$m++){
                    ?>
                    <tr>
                    <td class="v-align-middle">{{$nombreespacio[$m]}}</td>
                    <?php
                    for($k=0;$k<$cont;$k++){
                    $infor=$informes[$j];
                    if($infor[$k]->id_alumno==$idalumno[$j] and $infor[$k]->espacio==$nombreespacio[$m]){?>
                    <td class="v-align-middle">{{$infor[$k]->nota}}</td>
                    <?php
                    }
                    }
                    $inform=$informesfinales[$j];
                    if($inform[$m]->id_alumno==$idalumno[$j] and $inform[$m]->espacio==$nombreespacio[$m]){?>
                    <td class="v-align-middle">{{$inform[$m]->nota}}</td>
                    <?php
                    }
                    ?>
                    </tr>
                    <?php
                    }
                    ?>
                  
                  </tbody>
                  
                </table>
        </div>
      </div>
  </div>
<?php
                    }
                    ?>
   @endif
                  </div>        
          </div>
        </div>
        
      </div>
       
     </div>

   </div>

@endsection

