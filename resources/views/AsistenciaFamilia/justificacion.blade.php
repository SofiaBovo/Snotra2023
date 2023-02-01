@extends('layouts.main' , ['activePage' => 'justificacioninasistencias', 'titlePage => Gestión de justificaciones'])
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
                <h4 class="card-title "> Gestión de justificaciones</h4>    
              </div>
              <div class="card-body">
              @foreach($infoaño as $año)
                <div class="text-left">
                <h5><span class="badge badge-success">El año escolar activo es el {{$año->descripcion}}.</span></h5>
                </div>
              @endforeach
              <br>
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
              <div class="table-responsive">
                <table class="table">
                  <thead class="text-primary">
                  <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                  <th></th>
                  <th>Alumnos</th>
                  <th>Fecha</th>
                  <th>Acciones</th>

                     <?php 
                  }
                  else{?>
                  <th>Estado</th>
                  <th>Alumnos</th>
                  <th>Fecha de inasistencia</th>
                  <th>Acciones</th>
                  </thead>     
                  <?php 
                  }
                  ?>               
                  <tbody>
                  <?php 
                  foreach($infoasistencia as $infoasist){?>
                  <tr>
                  <td>
                    <?php
                     if($infoasist->gestionjustificacion==NULL){?>
                      <i class="bi bi-x-circle-fill" style="color:#ff6961 ;" title="No gestionada"></i>
                      <?php 
                     }  
                     else{?>
                      <i class="bi bi-check-circle-fill" style="color:#77dd77 ;" title="Gestionada"></i>
                     <?php 
                     }
                     ?>
                  </td>
                  <td class="v-align-middle">{{$infoasist->nombrealumno}}</td>
                  <td>{{\Carbon\Carbon::parse($infoasist->fecha)->format('d-m-Y')}}
                  </td>
                  <td class="td-actions v-align-middle">
                    <button class="btn btn-info" data-toggle="modal" data-target="#myModal{{$infoasist->id}}"> <i class="bi bi-eye"></i>
                    </button> 
                    <div class="modal fade bd-example-modal-lg" id="myModal{{$infoasist->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Justificación de inasistencia</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                    </div>
                    <div class="modal-body">
                      <label>Comentario</label>
                      <textarea class="form-control" rows="3" name="justificacion" id="justificacion" style="border: thin solid lightgrey;" aria-describedby="comentHelp" maxlength="200" value="{{$infoasist->comentariojusti}}">{{$infoasist->comentariojusti}}</textarea>
                      <br>
                      <?php 
                      if(empty($infoasist->archivojusti)){?>
                      <strong><p> No hay archivo adjunto. </p></strong>
                      <?php 
                      }
                      else{
                      ?>
                      <form action="{{route('descargararchivo',$infoasist->id)}}" method="POST">
                       @csrf
                      @METHOD('PUT')
                      <div class="text-left">
                      <button class="btn btn-success" type="submit">Ver archivo adjunto</button>
                     </div>
                      </form>
                      <?php 
                      }
                      ?>
                      <br>
                      <div class="text-right">
                      <small>
                      <?php
                      $idalumno=$infoasist->id_alumno;
                      $datofamilia=App\Models\Alumno::where('id',$idalumno)->pluck('familias_id');
                      $datofamilia = preg_replace('/[\[\]\.\;\""]+/', '', $datofamilia);
                      $nombrefamilia=App\Models\Familia::where('id',$datofamilia)->pluck('nombrefamilia');
                      $nombrefamilia = preg_replace('/[\[\]\.\;\""]+/', '', $nombrefamilia);
                      $apellidofamilia=App\Models\Familia::where('id',$datofamilia)->pluck('apellidofamilia');
                      $apellidofamilia = preg_replace('/[\[\]\.\;\""]+/', '', $apellidofamilia);
                      ?>
                      Justificación cargada por {{$nombrefamilia}} {{$apellidofamilia}} - 
                      Fecha de justificación 
                      {{\Carbon\Carbon::parse($infoasist->fechajusti)->format('d-m-Y')}}.
                      </small>
                    </div>
                      </div>
                      </div>
                     </div>
                   </div>
                   <?php 
                   if($infoasist->gestionjustificacion==NULL){?>
                   <button class="btn btn-success" type="submit" title="Aceptar justificación" data-toggle="modal" data-target="#myModal2{{$infoasist->id}}" > Aceptar
                    </button>
                      <div class="modal fade" id="myModal2{{$infoasist->id}}" role="dialog">
                      <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                      </div>
                      <div class="modal-body">
                      <p class="text-center">¿Está seguro que desea aceptar la justificación de la falta del alumno {{$infoasist->nombrealumno}} para la fecha  {{$infoasist->fecha}}?</p>
                      </div>
                      <div class="modal-footer justify-content-center">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <form action="{{route('aceptarjustificacion',$infoasist->id)}}" method="POST">
                      @csrf
                      @METHOD('PUT')
                      <button class="btn btn-success" type="submit" title="Aceptar justificación"> Aceptar
                      </button>
                      </form>
        </div>
      </div>
      
    </div>
  </div> 
                   </form> 
                  <?php 
                  }
                  else
                  {?>
                  <button class="btn btn-success" disabled title="Aceptar justificación" > Aceptar
                  </button> 
                  <?php
                  }
                  ?>
                     </td>
                  </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                </table>
                <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                    <br>
                <div class="text-center">
                  <i class="bi bi-x-circle-fill" style="color:#ff6961 ;"></i>&nbspNo Gestionada
                  &nbsp<i class="bi bi-check-circle-fill" style="color:#77dd77 ;"></i>&nbspGestionada
                </div>
                <?php 
                  }
                  else{?>
                </div>
                 <?php 
                  }
                  ?>
           
              </div> 
              <div class="card-footer mr-auto">
                    {{ $infoasistencia->links() }}
                  </div>
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
@endsection


      
