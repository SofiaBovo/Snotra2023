
@extends('layouts.main' , ['activePage' => 'eventos', 'titlePage => Calendario de Eventos'])

@section ('content')
<div class="content">
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title"> Calendario</h4>
                <p class="card-category">Calendario de Eventos</p>    
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 text-right">
                  <a class="btn btn-sm btn-facebook text-right"  href="{{ url('/Evento/form') }}"style="margin:10px;">Crear Evento </a>
                    @if(session('success'))
                    <div class="alert alert-success text-left" role="success">
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
      <br>
      <br>
      <div class="row header-calendar" style="margin-right:10px;">
       <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
          <a  href="{{ asset('/Evento/index/') }}/<?= $data['last']; ?>" style="margin:10px;">
            <i class="material-icons" style="font-size:45px;color:white;">chevron_left</i>
          </a>
          <h2 style="font-weight:bold;font-size:30px;margin:10px;"><?= $mespanish; ?> <small style="font-weight:bold;font-size:30px"><?= $data['year']; ?></small></h2>

          <a  href="{{ asset('/Evento/index/') }}/<?= $data['next']; ?>" style="margin:10px;">
            <i class="material-icons" style="font-size:45px;color:white;">navigate_next</i>
          </a>
        </div>
      </div>
      <?php
$detect = new Mobile_Detect;
if ($detect->isMobile() or $detect->isTablet()) {?>
  <div class="row" style="margin-right:10px;">
  <div class="col header-col">LU</div>
  <div class="col header-col">MA</div>
  <div class="col header-col">Mi</div>
  <div class="col header-col">JU</div>
  <div class="col header-col">VI</div>
  <div class="col header-col">SA</div>
  <div class="col header-col">DO</div>
  </div>
<?php
}
else{?>
  <div class="row" style="margin-right:10px;">
  <div class="col header-col">Lunes</div>
  <div class="col header-col">Martes</div>
  <div class="col header-col">Miércoles</div>
  <div class="col header-col">Jueves</div>
  <div class="col header-col">Viernes</div>
  <div class="col header-col">Sábado</div>
  <div class="col header-col">Domingo</div>
  </div>
<?php   
}
?>
        
      <!-- inicio de semana -->
      @foreach ($data['calendar'] as $weekdata)
        <div class="row" style="margin-right:10px;">
          <!-- ciclo de dia por semana -->
          @foreach  ($weekdata['datos'] as $dayweek)

          @if  ($dayweek['mes']==$mes)
            <div class="col box-day">
              {{ $dayweek['dia']  }}
              <!-- evento --> 
              @foreach  ($dayweek['evento'] as $event) 
                <?php
                $participantesevent=explode(' ', $event->participantes);
                                $cantidad=count($participantesevent)-1;
                                for($i=0; $i<=$cantidad; $i++){
                                  $nombreparticipante=App\Models\User::where('id',$participantesevent[$i])->get();
                                  foreach ($nombreparticipante as $nom) {
                                    $nomparti="$nom->name";
                                }
                                }                                
                if(($event->creador==Auth::user()->name) || ($nomparti==Auth::user()->name)){
                  ?>
                <br>
                <?php 
                if ($detect->isMobile() or $detect->isTablet()) {?>
                <a class="badge badge-evento" data-toggle="modal" data-target="#evento{{$event->id}}" href="{{ ($event->id) }}"><i class="bi bi-calendar2-check"></i></a>
                <?php
                }
                else{?>
                <a class="badge badge-info" style="font-size: 15px;"data-toggle="modal" data-target="#evento{{$event->id}}" href="{{ ($event->id) }}"><i class="bi bi-calendar2-check"></i></a> 
                <?php
                }
                }
                ?>
                    <div class="modal fade bd-example-modal-lg" id="evento{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          <div class="modal-header">
                          <i class="material-icons">event</i>&nbsp<h5 class="modal-title" id="exampleModalLabel"><strong> Vista detallada del Evento "{{$event->titulo}}"</strong></h5> 
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>

                          <div class="modal-body text-left">
                            <table class="table">
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Creador del Evento:</strong></label>  {{$event->creador}}
                                </td>
                            </tr>
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Tipo de Evento:</strong></label>  {{$event->tipo}}
                                </td>
                            </tr>
                              <tr>
                                <?php 
                                if(empty($event->descripcion)){
                                
                                } 
                                else{?>
                                <td class="v-align-middle" >
                                <label><strong>Comentario sobre el evento:</strong></label>  {{$event->descripcion}}
                                </td>
                                <?php 
                                }
                                ?>
                              </tr>
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Lugar:</strong></label>  {{$event->lugar}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Fecha:</strong></label>  {{ \Carbon\Carbon::parse($event->fecha)->format('d/m/Y')}}
                                </td>
                              </tr>
                              <tr>
                              <td class="v-align-middle">
                              <label><strong>Hora:</strong></label>   {{$event->hora}}
                              </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Participantes:</strong></label>  
                                <?php
                                $participantesevent=explode(' ', $event->participantes);
                                $cantidad=count($participantesevent)-1;
                                for($i=0; $i<=$cantidad; $i++){
                                  $nombreparticipante=App\Models\User::where('id',$participantesevent[$i])->get();
                                  foreach ($nombreparticipante as $nom) {
                                    $nomparti="$nom->name"; 
                                }
                                  echo "<br>".$nomparti; 
                                  $estadoevento= App\Models\estadoevento::where('id_participante',$participantesevent[$i])->where('id_evento', $event->id)->get();
                                  foreach ($estadoevento as $estevent) {
                                     $estadoevent="$estevent->estado";
                                     if($estadoevent=='Pendiente'){?>
                                      <i title="Pendiente" class="bi bi-clock  text-center" style="color: #36D1DC;"></i>
                                      <?php
                                     }
                                     if($estadoevent=='Aceptado'){?>
                                      <i title="Aceptado" class="bi bi-check-circle text-center" style="color: #3DC515;"></i>
                                      <?php
                                     }
                                     if($estadoevent=='Rechazado'){?>
                                      <i title="Rechazado" class="bi bi-x-circle text-center" style="color: #FC0417;"></i>
                                      <?php
                                     }
                                   } 
                                }
                                ?>
                                </td>
                              </tr>
                           </table>
                           <?php

                           $usuarioauten=Auth::user()->name;
                           if($usuarioauten ==$event->creador)
                           {?>
                         <div class="modal-footer justify-content-center">
                          <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal2{{$event->id}}" title="Eliminar evento">
                            <i class="material-icons">delete_outline</i>
                          </button>
                          <div class="modal fade" id="myModal2{{$event->id}}" role="dialog">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                          <p class="text-center">¿Está seguro que desea eliminar el evento <strong>{{$event->titulo}}?</strong></p>
                          </div>
                          <div class="modal-footer justify-content-center">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          <form action="{{route('deletevento',$event->id)}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('DELETE')
                          <button class="btn btn-success" type="submit" rel="tooltip">Aceptar</button>
                          </form>
                           </div>
                           </div>
                          </div>
                          </div> 
                           <a href="{{route('editarevento',['id' =>$event->id])}}" class="btn btn-sm btn-warning" title="Editar evento"><i class="material-icons">edit</i></a>
                         </div>
                         <?php
                       }
                       ?>

                         </div>
                         </div>
                         </div>
                       </div>
                       
              @endforeach
            </div>
          @else
          <div class="col box-dayoff">
          </div>
          @endif


          @endforeach
        </div>
      @endforeach

      </div>
      
    </div>
       </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
  
@endsection