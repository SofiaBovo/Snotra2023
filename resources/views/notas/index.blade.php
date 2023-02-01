@extends('layouts.main' , ['activePage' => 'carganotas', 'titlePage => Registro de notas'])
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
                <h4 class="card-title ">Registro de valoraciones por etapa</h4>
              </div>
              <div class="card-body">
                @foreach($infoaño as $año)
                  <div class="text-left">
                  <h5><span class="badge badge-success">El año escolar activo es el {{$año->descripcion}}.</span></h5>
                  </div>
                @endforeach
                @if(sizeof($nombresgrado)==0)
                <div class="text-center">
                <h5><span class="badge badge-warning">Para cargar notas se necesita estar asociado a al menos un grado.</span></h5>
                </div>
                @else
                @if(sizeof($criterios)==0)
                <div class="text-center">
                <h5><span class="badge badge-warning">Aún no hay criterios de evaluación creados.</span></h5>
                <u><strong><a class="text-primary" href="{{route('buscadornotas')}}">Volver al buscador</a></strong></u>
                </div>
                @else
                <form>
                <div class="row">
                @if($tipodoc!='Grado')
                <div class="col">
                <label>Grado</label>
                <select name="grado" id="grado" class="form-control" value="{{$grado}}">
                <option value="{{$grado}}">{{$grado}}</option>
                <?php
                $cont=count($nombresgrado)-1;
                for($i=0;$i<=$cont;$i++){
                  if($nombresgrado[$i]!=$grado){
                    ?>
                <option value="{{$nombresgrado[$i]}}">{{$nombresgrado[$i]}}</option>
                <?php
                }
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
                <select name="espacio" id="espacio" class="form-control" value="{{$espacio}}">
                <option value="{{$espacio}}">{{$espacio}}</option>
                <?php
                $nombreespacios = preg_replace('/[\[\]\.\;\""]+/', '', $nombreespacios);
                $cont=count($nombreespacios)-1;
                for($i=0;$i<=$cont;$i++){
                if($nombreespacios[$i]!=$espacio){
                  ?>
                <option value="{{$nombreespacios[$i]}}">{{$nombreespacios[$i]}}</option>
                <?php
                }
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
                <select name="periodo" id="periodo" class="form-control">
                <option value="{{$periodo}}">{{$periodo}}</option>
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
                <form class="form-horizontal" method="POST">
                  @csrf
                  @METHOD('PUT')
                <div style="display: none;">
                  <input type="text" value="{{$periodo}}" name="periodo">
                  @if($tipodoc=='Grado')
                  <input type="text" value="{{$espacio}}" name="espacio">
                  @endif
                  @if($tipodoc!='Grado')
                  <input type="text" value="{{$grado}}" name="grado">
                  @endif
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th>Alumnos</th>
                      @foreach($infocriterios as $infocrit) 
                      <th>{{$infocrit->criterio}}</th>
                      @endforeach
                      <?php 
                      if ($detect->isMobile() or $detect->isTablet()) {?>
                      <th>Final</th>
                      <?php
                      }
                      else{?>
                      <th>Valoración final &nbsp<a data-toggle="popover" title="Cálculo Nota Final" data-content="La nota final es obtenida automáticamente de acuerdo a las valoraciones cargadas y a la ponderación de cada criterio de evaluación."><i class="bi bi-exclamation-circle" class="text-primary" ></i></a>  </th>
                      <?php 
                      }
                      ?>
                      <th>Síntesis de la etapa</th>
                    </thead>
                    <script >$('[data-toggle="popover"]').popover();  </script>
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
                    @foreach($infoalumnos as $infoalu)        
                    <tbody>
                    <tr>
                      <td class="v-align-middle">{{$infoalu->nombrealumno}} {{$infoalu->apellidoalumno}}</td>
                      @foreach($infonotas as $infonot)
                      @if($infonot->id_alumno==$infoalu->id_alumno)
                      <td class="v-align-middle">
                        <select name="calificacion[]" id="calificacion" class="select-css">
                        <?php
                        $califi = preg_replace('/[\[\]\.\;\""]+/', '', $califi);
                        $cont=count($califi)-1;
                        ?>
                        <option value="{{$infonot->nota}}" <?php echo 'selected="selected" ';?>>{{$infonot->nota}}</option>
                        <option value=""></option>
                        <?php
                        for($i=0;$i<=$cont;$i++){?>
                        <option value="{{$califi[$i]}}">{{$califi[$i]}}</option>
                        <?php
                        }
                        ?>
                        </select>
                      </td>
                      @endif
                      @endforeach  
                      <td class="v-align-middle">
                          <?php
                        foreach($infoinformes as $infoinf){
                         $idalumno="$infoinf->id_alumno";
                              if($idalumno==$infoalu->id_alumno){
                                ?>
                                <input name="notafinal[]" id="notafinal" class="form-control" value="{{$infoinf->nota}}" disabled></input>
                        <?php
                        }
                      }
                        ?>
                        
                      </td>
                      <td class="v-align-middle">
                        <a style="color: #00bcd4;font-size: 1.5em;"data-toggle="modal" data-target="#myModal{{$infoalu->id_alumno}}" title="Síntesis">
                            <i class="bi bi-journals"></i>
                          </a>
                          <div class="modal fade bd-example-modal-lg" id="myModal{{$infoalu->id_alumno}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><strong>Síntesis del alumno {{$infoalu->nombrealumno}} {{$infoalu->apellidoalumno}}</strong></h5>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                             <?php
                             foreach($infoinformes as $infoinf)
                              {
                              $idalumno="$infoinf->id_alumno";
                              if($idalumno==$infoalu->id_alumno){
                              ?>
                              <div class="text-right"><small class="form-text text-muted contador" id="contador">150 caracteres restantes.</small></div>
                              <textarea placeholder="Ingrese aquí la síntesis." class="form-control" rows="3" name="observacion[]" id="observacion" style="border: thin solid lightgrey;" aria-describedby="comentHelp"  maxlength="150" value="{{$infoinf->observacion}}">{{$infoinf->observacion}}</textarea>


                              <?php
                              }
                              }
                             ?>  
                             
                            <div class="modal-footer">
                    <div class="  col-xs-12 col-sm-12 col-md-12 text-right">
                    <button formaction="{{route('observacion.update',$infoalu->id_alumno)}}" type="submit" class="btn btn-sm btn-facebook">Guardar</button>
                    </div>
                  </div>
                  <script type="text/javascript">
var limit = 150;
$(function() {
    $("#observacion").on("input", function () {
        //al cambiar el texto del txt_detalle
        var init = $(this).val().length;
        total_characters = (limit - init);
        $('#contador').html(total_characters + " caracteres restantes.");
    });
});
</script>
                         </div>
                       </div>
                     </div>
                   </div>
                      </td>                      
                    </tr>                                         

                    </tbody>
                    @endforeach
                  </table>
                </div>
                <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
                <button formaction="{{route('notas.update',$infoalu->id_alumno)}}" type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
          </div>
        </div>
      </form>
                        <?php
                        $califi = preg_replace('/[\[\]\.\;\""]+/', '', $califi);
                        if($infoco==NULL)
                        {
                        $califica = preg_replace('/[\[\]\.\;\""]+/', '', $califica);
                        $cont=count($califi)-1;
                        ?>
                        <?php 
                        if ($detect->isMobile() or $detect->isTablet()) {?>
                        <span class="badge badge-warning">La nota final es obtenida automáticamente de acuerdo a las valoraciones <br> cargadas y a la ponderación de cada criterio de evaluación.</span>
                        <?php
                        }
                      else{?>
                       <h5><span class="badge badge-warning">Referencias:
                        <?php
                        for($i=0;$i<=$cont;$i++){?>
                          <strong>{{$califi[$i]}}</strong>: {{$califica[$i]}}
                        <?php
                        }
                        ?>
                      </span></h5> 
                      <?php
                      }
                    }
                    ?>
            </div>
          </div>
          @endif
          @endif
        </div>
      </div>
     </div>
   </div>
 </div>
</div>
@endsection