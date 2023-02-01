<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
  
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="#"></a>
    </div>
   
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link posicion" data-toggle="dropdown" href="#">
                  <i class="bi bi-chat-dots" style="font-size: 1.5rem; "></i>
                  <?php
                  use App\Models\ChMessage as Message;
                  use App\Models\User;
                  use Carbon\Carbon;
                  $cantidad=Message::where('to_id',Auth::user()->id)->where('seen',0)->count();
                  ?>
                    <span class="num">{{$cantidad}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <?php
                if($cantidad==0)
                {
                  ?>
                  <span class="dropdown-header" >No hay mensajes para leer.</span>
                  <?php
                }
                else{
                    ?>
                <span class="dropdown-header" style="color: #007991;"><strong>MENSAJES NO LEÍDOS</strong></span>
                <span class="dropdown-header" >Tienes {{$cantidad}} mensajes para leer.</span>
                <?php

                  $usuario=Message::all()->where('to_id',Auth::user()->id)->where('seen',0)->sortByDesc('created_at')->unique('from_id');
                  $count = 0;

                  foreach($usuario as $usu)
                    { 
                      if($count == 5){
                        break;
                      }
                      $fromcolegio= "$usu->from_id";
                      $nombreusuario=User::all()->where('id',$fromcolegio);
                      foreach($nombreusuario as $nom)
                          {
                           $nombre= "$nom->name";
                         }
                         $tiempo=$usu->created_at->diffForHumans();
                      ?>
                      <a href="{{url('chatify',$usu->from_id)}}" class="dropdown-item">
                    <i class="bi bi-envelope-fill" style="font-size: 1rem;">&nbsp</i> {{$nombre}}
                      <span class="ml-3 pull-right text-muted text-sm">{{$tiempo}}</span>
                      <?php
                      $count++;
                    }
                  ?>
                  </a>
                  
                  <a href="{{ route('chatify') }}"><span class="dropdown-header text-right">Ver todos los mensajes</span></a>
                  <?php
                    };

                  ?>


                </div>
              </li>
      </ul>
      <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <?php
                  use App\Models\Event;
                  use App\Models\estadoevento;
                  use App\Models\Asistencia;
                  use Illuminate\Support\Facades\Auth;
                  use App\Models\Año;
                  use App\Models\Alumno;
                  $eventosparticipantes=estadoevento::where('id_participante',Auth::user()->id)->get();
                  $idcolegio=Auth::user()->colegio_id;
                  $idpersona= Auth::user()->idpersona;
                  $rol= Auth::user()->role;
                  if($rol=='docente'){
                  $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
                  foreach($infoaño as $activo){
                  $idaño="$activo->id";
                  $descripcionaño="$activo->descripcion";
                  }
                  $nuevajustificacion=Asistencia::where('docente',$idpersona)->where('colegio_id',$idcolegio)->where('año_id',$idaño)->where('justificacion',1)->where('gestionjustificacion',NULL)->orderby('fecha','DESC')->get();
                  }
                  if($rol=='familia'){
                  $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
                  foreach($infoaño as $activo){
                  $idaño="$activo->id";
                  $descripcionaño="$activo->descripcion";
                  }
                  $idfamilia=Auth::user()->idpersona;
                  $nombrealumno=Alumno::where('familias_id',$idfamilia)->pluck('nombrecompleto');
                  $contadoralumnos=count($nombrealumno)-1;
                  for($i=0;$i<=$contadoralumnos;$i++){
                  $nuevajustificacion[]=Asistencia::where('nombrealumno',$nombrealumno[$i])->where('estado','Ausente')->where('justificacion',0)->get();
                  }
                  }
                  $count1=0;
                  foreach($eventosparticipantes as $eventpart)
                  {
                  $evento=Event::where('id',$eventpart->id_evento)->get();
                  foreach($evento as $event){
                  $fechaevento="$event->fecha";
                  if($fechaevento>=date("Y-m-d")){
                  $count1++;
                  }
                }
              }
                  $count2=0;
                  if($rol=='docente'){
                  foreach($nuevajustificacion as $nuevajusti)
                  {
                  $count2++;
                  }
                  }
                  if($rol=='familia'){
                  for($i=0;$i<=$contadoralumnos;$i++){
                foreach($nuevajustificacion[$i] as $nuevajusti[$i]){
                  {
                  $count2++;
                  }
                  }
                }
              }
              $contador=$count1+$count2;
                  ?>
                <a class="nav-link posicion" data-toggle="dropdown" href="#">
                  <i class="bi bi-bell" style="font-size: 1.5rem; "></i>
                    <span class="num">{{$contador}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width:500%;">
                <?php
                  $idcolegio=Auth::user()->colegio_id;
                  $idpersona= Auth::user()->idpersona;
                  $rol= Auth::user()->role;
                  if($rol=='docente'){?>
                  <strong><span class="dropdown-header"  style="color: #007991;">JUSTIFICACIONES DE INASISTENCIAS</span></strong>
                    <?php
                  $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
                  foreach($infoaño as $activo){
                  $idaño="$activo->id";
                  $descripcionaño="$activo->descripcion";
                  }
                  $nuevajustificacion=Asistencia::where('docente',$idpersona)->where('colegio_id',$idcolegio)->where('año_id',$idaño)->where('justificacion',1)->where('gestionjustificacion',NULL)->orderby('fecha','DESC')->get();
                  if(empty($nuevajustificacion)){?>
                  <span>No hay justificaciones para gestionar</span>
                  <?php
                  }
                  else{
                  ?>
                  <?php 
                  foreach($nuevajustificacion as $nuevajusti){?>
                    <div class="row" style="margin-left:10px;">
                    <a href="{{route('justificacioninasistencias',$nuevajusti->id)}}" class="dropdown-item">
                    <i class="bi bi-journal-text" style="font-size: 1rem;margin-left:-10%">&nbsp &nbsp</i><span>{{$nuevajusti->nombrealumno}}</span>
                    <span class="ml-3 text-muted">{{\Carbon\Carbon::parse($nuevajusti->fecha)->format('d-m-Y')}}</span>
                    </a>
                    </div>
                  <?php 
                  }
                  }
                  }
                  if($rol=='familia'){?>
                  <strong><span class="dropdown-header" style="color: #007991;">JUSTIFICACIONES DE INASISTENCIAS</span></strong>
                    <?php
                  $infoaño=Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
                  foreach($infoaño as $activo){
                  $idaño="$activo->id";
                  $descripcionaño="$activo->descripcion";
                  }
                  $idfamilia=Auth::user()->idpersona;
                  $nombrealumno=Alumno::where('familias_id',$idfamilia)->pluck('nombrecompleto');
                  $contadoralumnos=count($nombrealumno)-1;
                  for($i=0;$i<=$contadoralumnos;$i++){
                  $nuevajustificacion[]=Asistencia::where('nombrealumno',$nombrealumno[$i])->where('estado','Ausente')->where('justificacion',0)->get();
                  }
                  $nuevajustif = preg_replace('/[\[\]\.\;\" "]+/', '', $nuevajustificacion);
                  ?>
                 
                  <?php 
                  if(empty($nuevajustif)){?>
                  <span>No hay justificaciones para gestionar</span>
                  <?php
                  }
                  else{
                  for($i=0;$i<=$contadoralumnos;$i++){
                foreach($nuevajustificacion[$i] as $nuevajusti[$i]){?>
                    <div class="row" style="margin-left:10px;">
                    <a href="{{route('asistenciasalumnos',$nuevajusti[$i]->id)}}" class="dropdown-item">
                    <i class="bi bi-journal-text" style="font-size: 1rem;margin-left:-10%">&nbsp &nbsp</i><span>{{$nuevajusti[$i]->nombrealumno}}</span>
                    <span class="ml-3 text-muted">{{\Carbon\Carbon::parse($nuevajusti[$i]->fecha)->format('d-m-Y')}}</span>
                    </a>
                    </div>
                  <?php 
                  }
                  }
                  }
                }
                  ?>

                <strong><span class="dropdown-header"  style="color: #007991;">EVENTOS</span></strong>
                <?php
                if($count1==0)
                {
                  ?>
                  <span class="dropdown-header" >No tiene próximos eventos.</span>
                  <?php
                }
                else{
                    ?>
                    <small class="ml-3 text-muted">Solo se muestran los próximos tres eventos.</small>
                  <div class="row" style="margin-left:10px;">
                <?php
                  $nuevoseventos=estadoevento::where('id_participante',Auth::user()->id)->get();
                  $rolparticipante=User::where('id',Auth::user()->id)->pluck("role");
                    $rolparticipante = preg_replace('/[\[\]\.\;\" "]+/', '', $rolparticipante);
                    $count1 = 0;
                  foreach($nuevoseventos as $nueveventos){
                    if($count1 == 4){
                        break;
                      }
                  $idevento="$nueveventos->id_evento";
                  $hoy = Carbon::now();
                  $infoevento=Event::where('id',$idevento)->where('fecha','>=',$hoy)->get();
                  foreach($infoevento as $nuevo)
                    { 
                      $month= "$nuevo->fecha";
                      $titulo="$nuevo->titulo";
                      $longitudtitulo=strlen($titulo);
                      $titulo=substr($titulo,0,9);
                    if($rolparticipante=='familia'){
                    if($month>=date("Y-m-d")){ 
                    ?>
                    <a href="{{route('eventosfamilianotif',$nuevo->id)}}" class="dropdown-item">
                    <i class="bi bi-calendar-event" style="font-size: 1rem;margin-left:-10%">&nbsp &nbsp</i><span>{{$titulo}}...</span>
                    <span class="ml-3 text-muted">{{\Carbon\Carbon::parse($month)->diffForHumans()}}</span>
                    </a>
                    <?php }
                  }
                    if($rolparticipante=='docente'){
                    if($month>=date("Y-m-d")){ 
                    ?>
                    <a href="{{route('calendariodocente',$month)}}" class="dropdown-item">
                    <i class="bi bi-calendar-event" style="font-size: 1rem;margin-left:-10%">&nbsp &nbsp</i><span>{{$titulo}}...</span>
                    <span class="ml-3 text-muted">{{\Carbon\Carbon::parse($month)->diffForHumans()}}</span>
                    </a>
                    <?php }
                  }
                    if($rolparticipante=='directivo'){
                    if($month>=date("Y-m-d")){ 
                    ?>
                    <a href="{{route('calendariodirectivo',$month)}}" class="dropdown-item">
                    <i class="bi bi-calendar-event" style="font-size: 1rem;margin-left:-10%">&nbsp &nbsp</i><span>{{$titulo}}..</span>
                    <span class="ml-3 text-muted">{{\Carbon\Carbon::parse($month)->diffForHumans()}}</span>
                    </a>
                    <?php 
                    } 
                    }
                    }
                    $count1++;
                    }
                  ?>
                 </div>
                  <?php 
                  }?>
                  
                  

                
                </div>
              </li>
      </ul>
      <ul class="navbar-nav">
       <li class="nav-item dropdown">
        <li class="nav-item dropdown">
          <a class="nav-link" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-person-circle" style="font-size: 1.5rem; "><!--<strong> <label class="text-primary"> {{auth()->user()->name }} !</label></strong>--></i>
            <p class="d-lg-none d-md-block">

              
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>&nbsp &nbsp{{ __('Mis datos') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right" style="font-size: 1.5rem;"></i>&nbsp &nbsp {{ __('Cerrar sesión') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>