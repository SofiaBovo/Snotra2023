@extends('layouts.main' , ['activePage' => 'cargasistencia', 'titlePage => Registro de Asistencias'])
<?php
$detect = new Mobile_Detect;
?>
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
              <select name="mes" id="mes" class="form-control" onchange="mensajebuscar()">
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
              @if($tipodoc!='Grado')
              <div class="col">
              <label>Grado</label>
                 <select name="grado" id="grado" class="form-control" value="{{old('grado') }}" onchange="mensajebuscar()">
                    <option value="{{$grado}}">{{$grado}}</option>
                    <?php
                    $cont=count($nombresgrado)-1;
                    for($i=0;$i<=$cont;$i++){?>
                    <option value="{{$nombresgrado[$i]}}">{{$nombresgrado[$i]}}</option>
                    <?php
                    }
                    ?>
              </select>
            </div>
              @endif
            </div>
            <br>
            <div id="mensaje" class="text-warning text-center">
              </div>
              <script>
              function mensajebuscar(){
                document.getElementById('mensaje').innerHTML = "<p style='font-size:0.8rem;' class='badge badge-warning'><i style='font-size:1.1rem;' class='bi bi-exclamation-circle'></i><strong>   Para actualizar la tabla presione Buscar.</strong></p>"
              }
              </script>
            
              <br>
              <div class="text-right">
                  <button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
              </div>
            </form>
            <br>
            @if(empty($success))
            @else
            <div class="alert alert-success">
            {{$success}}
            </div>
            <script type="text/javascript">
            window.setTimeout(function() {
            $(".alert-success").fadeTo(400, 0).slideUp(400, function(){
            $(this).remove(); 
            });
            }, 1000);
            </script>
            @endif
              <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                    <th>Alumnos</th>
                    <th>Total</th>
                    <?php 
                     if($mes=='Enero' or $mes=='Marzo' or $mes=='Mayo' or $mes=='Julio' or $mes=='Agosto' or $mes=='Octubre' or $mes=='Diciembre'){
                      $diasmes=31;
                    }
                    if($mes=='Abril' or $mes=='Junio' or $mes=='Septiembre' or $mes=='Noviembre'){
                      $diasmes=30;
                    }
                    if($mes=='Febrero'){
                      $diasmes=28;
                    }
                      for ($i=1; $i <=$diasmes ; $i++) {?>
                      <th>
                      {{$i}}
                      <?php 
                      }
                      ?></th>
                    </thead>                    
                    <tbody>
                    <?php
                    if($infoasistencia->isEmpty()){
                    $contador=count($nombrecompleto)-1;
                    for ($i=0; $i <=$contador ; $i++) {?> 
                     <tr>
                      <td class="v-align-middle">{{$nombrecompleto[$i]}}</td>
                      <td>-</td>
                    <?php
                       for ($j=1; $j <=$diasmes ; $j++) {
                    ?>
                    <td>
                      <i class="bi bi-circle-fill" style="color:#c5c6c8;"></i>
                      </td>
                    <?php
                    }
                    }
                    }
                    else{
                    ?>  
                    @foreach($infoasistencia as $infoasist)
                    <tr>
                      <td class="v-align-middle">{{$infoasist->nombrealumno}}</td>
                    <?php
                    for ($i=1; $i <=$diasmes ; $i++) {
                    $a[$i]= 'No registrada';
                    }
                    $suma=0;
                    for ($i=1; $i <=$diasmes ; $i++) {?>
                    @foreach($infoasistencias as $infoasisten)
                      <?php 
                      if($infoasist->nombrealumno==$infoasisten->nombrealumno){ 
                      $dia=$infoasisten->fecha;
                      $fechaComoEntero = strtotime($dia);
                      $dia = date("d", $fechaComoEntero);
                      if($i==$dia){
                      $a[$i]=$infoasisten->estado;
                      if($infoasisten->tardanza==1){
                        $a[$i]='Tarde';
                        $suma=$suma+0.5;
                      }
                      if($infoasisten->estado=='Ausente'){
                        $suma=$suma+1;
                      }

                      }  
                       }?>
                      @endforeach
                      <?php
                     }?>
                     <td>{{$suma}}</td><?php
                     for ($i=1; $i <=$diasmes ; $i++){
                      if($a[$i]=='Presente'){?>
                      <td>
                      <i class="bi bi-circle-fill" style="color:#77dd77;"></i>
                      </td>  
                      <?php 
                      } 
                      if($a[$i]=='Ausente'){?>
                      <td>
                      <i class="bi bi-circle-fill" style="color:#ff6961;"></i> 
                      </td>
                      <?php 
                      }
                       if($a[$i]=='Ausente justificada'){?>
                      <td>
                      <i class="bi bi-circle-fill" style="color:#6c96c1;"></i> 
                      </td>
                      <?php 
                      }
                      if($a[$i]=='Tarde'){?>
                      <td>
                       <i class="bi bi-circle-fill" style="color:#fdfd96;"></i>
                      </td>
                       <?php 
                       }
                       if($a[$i]=='No registrada'){?>
                      <td>
                      <i class="bi bi-circle-fill" style="color:#c5c6c8;"></i>
                      </td>
                       <?php 
                       }
                       }
                     ?>
                    </tr>
                    @endforeach
                    <?php 
                  }
                  ?>
                    </tbody>
                  </table>
                </div>
              <br>
               @if($tipodoc=='Grado')
              <form>
              <div style="display:none;">
                <input type="text" value="{{$mes}}" name="mes">
              </div>
              <div class="text-right">
                  <button class="btn btn-sm btn-facebook" type="submit" formaction="{{url ('asistencias/create') }}">Cargar asistencia</button>
                  <button class="btn btn-sm btn-facebook" formaction="{{url ('asistencias/edita') }}">Editar Asistencia</button>
              </div>
           </form>
            @endif
            @if($tipodoc!='Grado')
            <form>
              <div style="display:none;">
                <input type="text" value="{{$grado}}" name="grado">
                <input type="text" value="{{$mes}}" name="mes">
              </div>
              <div class="text-right">
                  <button class="btn btn-sm btn-facebook" type="submit" formaction="{{url ('asistencias/create') }}">Cargar asistencia</button>
                  <button class="btn btn-sm btn-facebook" formaction="{{url ('asistencias/edita') }}">Editar Asistencia</button>
              </div>
           </form>

           @endif
               <?php 
          if ($detect->isMobile() or $detect->isTablet()) {?> 
          <br>
          @if($tipodoc=='Grado')
          <div class="row">
                <i class="bi bi-circle-fill" style="color:#c5c6c8;"></i>&nbspNo registrada&nbsp
                <i class="bi bi-circle-fill" style="color:#77dd77;"></i>&nbspPresente&nbsp
                <i class="bi bi-circle-fill" style="color:#ff6961;"></i>&nbspAusente&nbsp
                <i class="bi bi-circle-fill" style="color:#fdfd96;"></i>&nbspTarde&nbsp
                <i class="bi bi-circle-fill" style="color:#6C96C1;"></i>&nbspJustificada&nbsp
              </div>
          @endif
          @if($tipodoc!='Grado')
          <div class="row">
                <i class="bi bi-circle-fill" style="color:#c5c6c8;"></i>&nbspNo registrada&nbsp
                <i class="bi bi-circle-fill" style="color:#77dd77;"></i>&nbspPresente&nbsp
                <i class="bi bi-circle-fill" style="color:#ff6961;"></i>&nbspAusente&nbsp
              </div>
          @endif
          <?php 
          }
          else{?>
            @if($tipodoc=='Grado')
              <div class="row">
                <i class="bi bi-circle-fill" style="color:#c5c6c8;"></i>&nbspNo registrada&nbsp
                <i class="bi bi-circle-fill" style="color:#77dd77;"></i>&nbspPresente&nbsp
                <i class="bi bi-circle-fill" style="color:#ff6961;"></i>&nbspAusente&nbsp
                <i class="bi bi-circle-fill" style="color:#fdfd96;"></i>&nbspTarde&nbsp
                <i class="bi bi-circle-fill" style="color:#6C96C1;"></i>&nbspJustificada&nbsp
              </div>
            @endif
            @if($tipodoc!='Grado')
              <div class="row">
                <i class="bi bi-circle-fill" style="color:#c5c6c8;"></i>&nbspNo registrada&nbsp
                <i class="bi bi-circle-fill" style="color:#77dd77;"></i>&nbspPresente&nbsp
                <i class="bi bi-circle-fill" style="color:#ff6961;"></i>&nbspAusente&nbsp
              </div>
            @endif
               <?php 
                  }
                  ?>
        
              </div> 
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
@endsection


      
