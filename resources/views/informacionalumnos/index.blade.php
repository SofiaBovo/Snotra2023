@extends('layouts.main' , ['activePage' => 'infoalumnos', 'titlePage => Información académica'])
@section ('content')
<div class="content">
  <div class="container-fluid">
  <div class="row">
  <div class="col-md-12">
  <div class="row">
  <div class="col-md-12">
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
                    ?>
                  <?php
                  $arregloB=['null','null','null','null'];
                  $arregloT=['null','null','null'];
                  $arregloC=['null','null'];  
                  for($m=0;$m<=$contadorespacios;$m++){
                    ?>
                    <td class="v-align-middle">{{$nombreespacio[$m]}}</td>
                    <?php
                  for($i=0;$i<=$contadorinformes;$i++){  
                  for($k=0;$k<$cont;$k++){
                  $infor=$informes[$i];
                  if($infor[$k]->espacio==$nombreespacio[$m] and $infor[$k]->id_alumno==$idalumno[$j]){
                    if($informacionperiodo=='Bimestre'){
                      if($infor[$k]->periodo=='Primera Etapa'){
                      $arregloB[0]=$infor[$k]->nota;
                      }
                      elseif($infor[$k]->periodo=='Segunda Etapa'){
                      $arregloB[1]=$infor[$k]->nota; 
                      }
                      elseif($infor[$k]->periodo=='Tercera Etapa'){
                      $arregloB[2]=$infor[$k]->nota; 
                      }
                      else{
                      $arregloB[3]=$infor[$k]->nota; 
                      }
                      }
                      if($informacionperiodo=='Trimestre'){
                      if($infor[$k]->periodo=='Primera Etapa'){
                      $arregloT[0]=$infor[$k]->nota;
                      }
                      elseif($infor[$k]->periodo=='Segunda Etapa'){
                      $arregloT[1]=$infor[$k]->nota; 
                      }
                      else{
                      $arregloT[2]=$infor[$k]->nota; 
                      }
                      }
                      if($informacionperiodo=='Cuatrimestre'){
                      if($infor[$k]->periodo=='Primera Etapa'){
                      $arregloC[0]=$infor[$k]->nota;
                      }
                      elseif($infor[$k]->periodo=='Segunda Etapa'){
                      $arregloC[1]=$infor[$k]->nota; 
                      }
                      }
                      if($informacionperiodo=='Semestre'){
                      if($infor[$k]->periodo=='Primera Etapa'){
                      $arregloC[0]=$infor[$k]->nota;
                      }
                      else{
                      $arregloC[1]=$infor[$k]->nota; 
                      }
                      }
                      }
                      }
                    }
                    if($informacionperiodo=='Bimestre'){
                      $contador=count($arregloB)-1; 
                      for($u=0;$u<=$contador;$u++){
                        if($arregloB[$u]=='null'){?>
                          <td class="v-align-middle">-</td>
                        <?php 
                        }
                        else{?>
                          <td class="v-align-middle">{{$arregloB[$u]}}</td>
                        <?php
                        }
                      }
                    }
                    if($informacionperiodo=='Trimestre'){
                      $contador=count($arregloT)-1; 
                      for($u=0;$u<=$contador;$u++){
                        if($arregloT[$u]=='null'){?>
                          <td class="v-align-middle">-</td>
                        <?php 
                        }
                        else{?>
                          <td class="v-align-middle">{{$arregloT[$u]}}</td>
                        <?php
                        }
                      }
                    }
                    if($informacionperiodo=='Cuatrimestre'){
                      $contador=count($arregloC)-1; 
                      for($u=0;$u<=$contador;$u++){
                        if($arregloC[$u]=='null'){?>
                          <td class="v-align-middle">-</td>
                        <?php 
                        }
                        else{?>
                          <td class="v-align-middle">{{$arregloC[$u]}}</td>
                        <?php
                        }
                      }
                    }
                    if($informacionperiodo=='Semestre'){
                      $contador=count($arregloC)-1; 
                      for($u=0;$u<=$contador;$u++){
                        if($arregloC[$u]=='null'){?>
                          <td class="v-align-middle">-</td>
                        <?php 
                        }
                        else{?>
                          <td class="v-align-middle">{{$arregloC[$u]}}</td>
                        <?php
                        }
                      }
                    }
                    for($p=0;$p<=$contadornotasfinales;$p++){
                    for($k=0;$k<$cont;$k++){
                    $inform=$informesfinales[$p];
                    if($inform[$k]->espacio==$nombreespacio[$m] and $inform[$k]->id_alumno==$idalumno[$j]){
                      if($inform[$k]->nota==NULL){?>
                      <td class="v-align-middle">-</td>
                      <?php
                      }
                      else{
                      if($inform[$k]->nota=='E' or $inform[$k]->nota=='SB' or $inform[$k]->nota==10){
                      ?>
                      <td class="v-align-middle"><mark style="border-radius: 10px;background-color:#CBFC99;">{{$inform[$k]->nota}}</mark></td>
                      <?php 
                      }
                      if($inform[$k]->nota=='MB' or $inform[$k]->nota==8 or $inform[$k]->nota==9){
                      ?>
                      <td class="v-align-middle"><mark style="border-radius: 10px;background-color:#FBFC99 ;">{{$inform[$k]->nota}}</mark></td>
                      <?php 
                      }
                      if($inform[$k]->nota=='B' or $inform[$k]->nota=='R' or $inform[$k]->nota==7 or $inform[$k]->nota==6){
                      ?>
                      <td class="v-align-middle"><mark style="border-radius: 10px;background-color:#FCD799 ;">{{$inform[$k]->nota}}</mark></td>
                      <?php 
                      }
                      if($inform[$k]->nota=='S' or $inform[$k]->nota=='I' or $inform[$k]->nota==4 or $inform[$k]->nota==5){
                      ?>
                      <td class="v-align-middle"><mark style="border-radius: 10px;background-color:#FCBC99 ;">{{$inform[$k]->nota}}</mark></td>
                      <?php 
                      }
                      if($inform[$k]->nota=='NS' or $inform[$k]->nota==1 or $inform[$k]->nota==2 or $inform[$k]->nota==3){
                      ?>
                      <td class="v-align-middle"><mark style="border-radius: 10px;background-color:#FCA399 ;">{{$inform[$k]->nota}}</mark></td>
                      <?php 
                      }
                      }
                      
                    }
                  }
                  }

                    ?>
                    </tbody>
                    <?php 
                  }
                  ?>
                  
                </table>
        </div>
      </div>
  </div> 
  <?php
  }
  ?>            
</div>
           
          </div>
        </div>
        
      </div>
       
     </div>

   </div>

@endsection

