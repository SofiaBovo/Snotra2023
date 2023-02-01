 <script src="https://kit.fontawesome.com/fd58aa9044.js" crossorigin="anonymous"></script>
<?php
$detect = new Mobile_Detect;
if ($detect->isMobile() or $detect->isTablet()) {?>
<link rel="stylesheet" href="{{ asset ('css/responsive-nav.css')}}">
<script src="{{ asset ('js/responsive-nav.js')}}"></script>
<?php
  if (Auth::user()->role =='directivo') { ?>
        <a href="#" class="nav-toggle" aria-hiden="false">
        Menu
        </a>
    <div id="nav" class="nav-collapse"  style="transition: max-height 290ms ease 0s;">
    <div class="sidebar"data-color="azure" data-background-color="white">
  <div class="sidebar-wrapper">
    <ul class="nav menu">
      <li class="nav-item">
      <a class="nav-link" href="{{ route('profile.edit') }}">
      <div class="items-dashboard">
      <i class="fa-solid fa-circle-user" style="color: #5B86E5"></i>
      <span class="sidebar-normal" style="font-size: 105%;">Mis datos</span>
      </div>
      </a>
      </li>
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="collapse" href="#micolegio" aria-expanded="false" aria-haspopup="true">
          <div class="items-dashboard">
           <i class="fa-solid fa-school" style="color: #5B86E5"></i>
          <span class="sidebar-normal" style="font-size: 105%;">Mi Colegio</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="dropdown-menu" id="micolegio">
          <a  href="{{route('formulario')}}">
            <div class="items-dashboard">
            <i class="fa-solid fa-circle-info" style="font-size: 1rem;color: #5B86E5;"></i>
            <span class="sidebar-normal">Información de Colegio</span>
            </div>
          </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('configuraciones')}}">
          <div class="items-dashboard" >
          <i class="fa-solid fa-gears" style="font-size: 1rem; color: #5B86E5;"></i>
          <span class="sidebar-normal">Configuraciones</span>
          </div>
        </a>
        </div>
        </li>
    </ul>
            <li>
              <a class="nav-link" href="{{url('admin/docentes')}}">
                <div class="items-dashboard">
                <i class="fa-solid fa-user-pen"></i>
                <span class="sidebar-normal" style="font-size: 105%; color: #5B86E5;">Registro de Docentes</span>
                </div>
              </a>
            </li>
          <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="collapse" href="#alumnos" aria-expanded="false" aria-haspopup="true">
          <div class="items-dashboard">
          <i class="fa-solid fa-user-graduate"></i>
          <span class="sidebar-normal" style="font-size: 105%;">Registro de Alumnos</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="dropdown-menu" id="alumnos">
          <a class="nav-link" href="{{url('admin/alumnos')}}">
                <div class="items-dashboard">
                 <i class="fa-solid fa-people-roof"></i>
                <span class="sidebar-normal" style="font-size: 105%;">Carga de Familias</span>
                </div>
          </a>
         <div class="dropdown-divider"></div>
          <a class="nav-link" href="{{url('admin/alumnos')}}">
                <div class="items-dashboard">
                 <i class="fa-solid fa-user-graduate"></i>
                <span class="sidebar-normal" style="font-size: 105%;">Carga de Alumnos</span>
                </div>
          </a>
        </div>
        </li>
    </ul>
          <li >
              
            </li>
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="collapse" href="#añoescolar" aria-expanded="false" aria-haspopup="true">
          <div class="items-dashboard">
          <i class="fa-solid fa-calendar-days"></i>
          <span class="sidebar-normal" style="font-size: 105%;">Año Escolar</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="dropdown-menu" id="añoescolar">
          <a  href="{{route('añoescolar')}}">
            <div class="items-dashboard">
            <i class="fa-solid fa-calendar-plus" style="font-size: 1rem;"></i>
            <span class="sidebar-normal">Creación de Año</span>
            </div>
          </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('armadogrado')}}">
          <div class="items-dashboard">
          <i class="fa-sharp fa-solid fa-people-line" style="font-size: 1rem;"></i>
          <span class="sidebar-normal">Armado de Grados</span>
          </div>
        </a>
        </div>
        </li>
    </ul>
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="collapse" href="#infoacademica" aria-expanded="false" aria-haspopup="true">
          <div class="items-dashboard">
          <i class="fa-solid fa-graduation-cap"></i>
          <span class="sidebar-normal" style="font-size: 105%;">Información Académica</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="dropdown-menu" id="infoacademica">
          <a  href="{{url('informacionacademica')}}">
            <div class="items-dashboard">
            <i class="fa-solid fa-clock-rotate-left" style="font-size: 1rem;"></i>
            <span class="sidebar-normal">Historial Académico</span>
            </div>
          </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('libretas')}}">
          <div class="items-dashboard">
          <i class="fa-solid fa-file-arrow-down" style="font-size: 1rem;"></i>
          <span class="sidebar-normal">Impresión de Informes</span>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('buscadorpase')}}">
          <div class="items-dashboard">
          <i class="fa-solid fa-right-long" style="font-size: 1rem;"></i>
          <span class="sidebar-normal">Pase de Grado</span>
          </div>
        </a>
        </div>
        </li>
    </ul>
          <li>
              <a class="nav-link" href="{{route('calendario')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-calendar-day"></i>
                <span class="sidebar-normal" style="font-size: 105%;">Eventos</span>
                </div>
              </a>
            </li>
          <li>
              <a class="nav-link" href="{{route('chatify')}}">
                <div class="items-dashboard">
                <i class="fa-solid fa-comment-dots"></i>
                <span class="sidebar-normal" style="font-size: 105%;">Central de Mensajes</span>
                </div>
              </a>
            </li>
            <li>
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <div class="items-dashboard">
              <i class="fa-solid fa-right-from-bracket"></i> 
              <span class="sidebar-normal" style="font-size: 105%;">Cerrar Sesión</span>
              </div>
            </a>
            </li>
    </ul>
  </div>
</div>
</div>
  <script>
var navigation = responsiveNav("#nav");
</script>
<?php 
}
 if (Auth::user()->role =='docente') { ?>
    <a href="#" class="nav-toggle" aria-hiden="false">
    Menu
    </a>
    <div id="nav" class="nav-collapse"  style="transition: max-height 290ms ease 0s;">
    <div class="sidebar"data-color="azure" data-background-color="white">
  <div class="sidebar-wrapper">
    <ul class="nav menu">
      <li class="nav-item">
      <a class="nav-link" href="{{ route('profile.edit') }}">
      <div class="items-dashboard">
      <i class="fa-solid fa-circle-user"></i>
      <span class="sidebar-normal" style="font-size: 105%;">Mis datos</span>
      </div>
      </a>
      </li>
      <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="collapse" href="#registronotas" aria-expanded="false" aria-haspopup="true">
          <div class="items-dashboard">
          <i class="fa-solid fa-award"></i>
          <span class="sidebar-normal" style="font-size: 105%;">Registro de Valoraciones</span>
            <b class="caret"></b>
          </div>
        </a>
        <div class="dropdown-menu" id="registronotas">
              <a class="nav-link" href="{{route('criteriosevaluacion')}}">
               <div class="items-dashboard"> 
                <i class="fa-solid fa-list-check"></i>
                <span class="sidebar-normal">{{ __('Criterios de Evaluación') }}</span>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="nav-link" href="{{route('buscadornotas')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-pen-to-square"></i>
                <span class="sidebar-normal"> {{ __('Valoraciones por Etapa') }} </span>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="nav-link" href="{{route('buscadornotasfinales')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-pen-to-square"></i>
                <span class="sidebar-normal"> {{ __('Valoraciones Finales') }} </span>
                </div>
              </a>
          </div>
        </li>
    </ul>
      <?php
      $idpersona= Auth::user()->idpersona;
      $tipodocente=App\Models\Docente::where('id',$idpersona)->get();
      foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
      }
      if($tipodoc=='Grado'){?>
         <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="collapse" href="#asistencias" aria-expanded="false">
          <div class="items-dashboard">
          <i class="fa-solid fa-clipboard-list"></i>
          <span class="sidebar-normal" style="font-size: 105%;">Asistencias</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="dropdown-menu" id="asistencias">
              <a class="nav-link" href="{{route('asistencias')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-clipboard-list"></i>
                <span class="sidebar-normal"> {{ __('Registro de Asistencias') }} </span>
                </div>
              </a>
              <div class="dropdown-divider"></div>
               <a class="nav-link" href="{{route('justificacioninasistencias')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-list-check"></i>
                <span class="sidebar-normal"> {{ __('Gestión de Justificaciones') }} </span>
                </div>
              </a>
          </div>
        </li>
    </ul>
       
      <?php 
      }
      if($tipodoc!='Grado'){?>
       <li class="nav-item">
        <div class="collapse show">
          <ul class="nav">
      <li class="nav-item{{ $activePage == 'cargasistencia' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('asistencias.especiales')}}">
        <div class="items-dashboard">
        <i class="fa-solid fa-clipboard-list"></i>
        <span class="sidebar-normal"> {{ __('Registro de Asistencias') }} </span>
        </div>
        </a>
      </li>
    </ul>
  </div>
      <?php
}
?>
    </li>
    <li class="nav-item">
        <div class="collapse show">
          <ul class="nav">
      <li class="nav-item{{ $activePage == 'eventos' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('calendario')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-calendar-day"></i>
                <span class="sidebar-normal" style="font-size: 105%;"> {{ __('Eventos') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </li>
    <li class="nav-item">
        <div class="collapse show" >
          <ul class="nav">
          <li class="nav-item{{ $activePage == 'chatdocente' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('chatify')}}">
                <div class="items-dashboard">
                <i class="fa-solid fa-comment-dots"></i>
                <span class="sidebar-normal" style="font-size: 105%">{{ __('Central de Mensajes') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <div class="items-dashboard">
              <i class="fa-solid fa-right-from-bracket"></i>
              <span class="sidebar-normal" style="font-size: 105%;">Cerrar Sesión</span>
              </div>
            </a>
            </li>
  </ul>
  </div>
</div>
</div>
  <script>
var navigation = responsiveNav("#nav");
</script>
<?php 
}
if (Auth::user()->role =='familia') { ?>
        <a href="#" class="nav-toggle" aria-hiden="false">
        Menu
        </a>
    <div id="nav" class="nav-collapse"  style="transition: max-height 290ms ease 0s;">
    <div class="sidebar"data-color="azure" data-background-color="white">
  <div class="sidebar-wrapper">
    <ul class="nav menu">
      <li class="nav-item">
      <a class="nav-link" href="{{ route('profile.edit') }}">
      <div class="items-dashboard">
      <i class="fa-solid fa-circle-user"></i>
      <span class="sidebar-normal" style="font-size: 105%;">Mis datos</span>
      </div>
      </a>
      </li>
      <li class="nav-item{{ $activePage == 'infoalumnos' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('infoalumnos')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-graduation-cap"></i>
                <span class="sidebar-normal"> {{ __('Información Académica') }} </span>
                </div>
              </a>
      </li>
      <li class="nav-item{{ $activePage == 'asistenciasfamilia' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('asistenciasalumnos')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-clipboard-list"></i>
                <span class="sidebar-normal"> {{ __('Asistencias') }} </span>
                </div>
              </a>
            </li>
      <li class="nav-item{{ $activePage == 'eventos' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('eventosfamilia')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-calendar-day"></i>
                <span class="sidebar-normal"> {{ __('Eventos') }} </span>
                </div>
              </a>
            </li>
      
      <li class="nav-item">
        <div class="collapse show" >
          <ul class="nav">
          <li class="nav-item{{ $activePage == 'chatfamilia' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('chatify')}}">
                <div class="items-dashboard">
                <i class="fa-solid fa-comment-dots"></i>
                <span class="sidebar-normal">{{ __('Central de Mensajes') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <div class="items-dashboard">
              <i class="fa-solid fa-right-from-bracket"></i>
              <span class="sidebar-normal" style="font-size: 105%;">Cerrar Sesión</span>
              </div>
            </a>
            </li>
    </ul>
  </div>
</div>
</div>
  <script>
var navigation = responsiveNav("#nav");
</script>
<?php 
}

}

else{?>
<div class="sidebar" data-color="azure" data-background-color="white">
  <div class="logo">
    <img style="width:50%;margin-right: 15%;margin-left:20%;" src="{{ asset ('img/logo.png')}}">
  </div>
  <?php
  if (Auth::user()->role =='directivo') { ?>
  <div class="sidebar-wrapper">
    <ul class="nav menu">
     <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link clo" href="{{route('directivo')}}">
          <i class="bi bi-list"></i>
           <strong><p>{{ __('MENU DIRECTIVOS') }}</p></strong> 
        </a>
      </li>
    
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#micolegio" aria-expanded="false">
          <div class="items-dashboard">
          <i class="fa-solid fa-school"></i>
          <span class="sidebar-normal">Mi Colegio</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="micolegio">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'formulario' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('formulario')}}">
                <div class="items-dashboard" >
                <i class="fa-solid fa-circle-info"></i>
                <span class="sidebar-normal">{{ __('Informacion de Colegio') }}</span>
                </div>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'configuraciones' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('configuraciones')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-gears"></i>
                <span class="sidebar-normal"> {{ __('Configuraciones Básicas') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </li>
            <li class="nav-item{{ $activePage == 'docente' ? ' active' : '' }}">
              <a class="nav-link" href="{{url('admin/docentes')}}">
                <div class="items-dashboard">
                <i class="fa-solid fa-user-pen"></i>
                <span class="sidebar-normal">{{ __('Registro de Docentes') }} </span>
                </div>
              </a>
            </li>
          <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="collapse" href="#alumnos" aria-expanded="false" aria-haspopup="true">
          <div class="items-dashboard">
          <i class="fa-solid fa-user-graduate"></i>
          <span class="sidebar-normal">{{ __('Registro de Alumnos') }}</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="alumnos">
          <ul class="nav">
          <li class="nav-item{{ $activePage == 'familia' ? ' active' : '' }}">
          <a class="nav-link" href="{{url('admin/familias')}}">
            <div class="items-dashboard">
            <i class="fa-solid fa-people-roof"></i>
            <span class="sidebar-normal">{{ __('Carga de Familias') }}</span>
            </div>
          </a>
          </li>
          <li class="nav-item{{ $activePage == 'alumno' ? ' active' : '' }}">
          <a class="nav-link" href="{{url('admin/alumnos')}}">
                <div class="items-dashboard">
                 <i class="fa-solid fa-user-graduate"></i>
                <span class="sidebar-normal">{{ __('Carga de Alumnos') }}</span>
                </div>
          </a>
        </li>
       </ul>
     </div>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#añoescolar" aria-expanded="false">
          <div class="items-dashboard">
          <i class="fa-solid fa-calendar-days"></i>
          <span class="sidebar-normal">Año Escolar</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="añoescolar">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'añoescolar' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('añoescolar')}}">
               <div class="items-dashboard"> 
                <i class="fa-solid fa-calendar-plus"></i>
                <span class="sidebar-normal">{{ __('Creación de Año Escolar') }}</span>
                </div>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'armadogrado' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('armadogrado')}}">
                <div class="items-dashboard">
               <i class="fa-sharp fa-solid fa-people-line"></i>
                <span class="sidebar-normal"> {{ __('Armado de Grados') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#infoacademica" aria-expanded="false">
          <div class="items-dashboard">
          <i class="fa-solid fa-graduation-cap"></i>
          <span class="sidebar-normal">Información académica</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="infoacademica">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'informacionacademica' ? ' active' : '' }}">
              <a class="nav-link" href="{{url('informacionacademica')}}">
                <div class="items-dashboard">
                 <i class="fa-solid fa-clock-rotate-left"></i>
                <span class="sidebar-normal">{{ __('Historial Académico') }} </span>
                </div>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'libretas' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('libretas')}}">
                <div class="items-dashboard">
              <i class="fa-solid fa-file-arrow-down"></i>
                <span class="sidebar-normal"> {{ __('Impresión de Informes') }} </span>
                </div>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'pasegrado' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('buscadorpase')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-right-long"></i>
                <span class="sidebar-normal"> {{ __('Pase de Grado') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </li>
          <li class="nav-item{{ $activePage == 'eventos' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('calendario')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-calendar-day"></i>
                <span class="sidebar-normal"> {{ __('Eventos') }} </span>
                </div>
              </a>
            </li>
          <li class="nav-item{{ $activePage == 'chatdirectivo' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('chatify')}}">
                <div class="items-dashboard">
                <i class="fa-solid fa-comment-dots"></i>
                <span class="sidebar-normal">{{ __('Central de Mensajes') }} </span>
                </div>
              </a>
            </li>
    </ul>
  </div>
<?php 
}
  if (Auth::user()->role =='docente') { ?>
  <div class="sidebar-wrapper">
    <ul class="nav">
     <li class="nav-item{{ $activePage == 'dashboarddocente' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('docente')}}">
          <i class="bi bi-list"></i>
           <strong><p>{{ __('MENU DOCENTES') }}</p></strong> 
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#registronotas" aria-expanded="false">
          <div class="items-dashboard">
          <i class="fa-solid fa-award"></i>
          <span class="sidebar-normal">Registro de Valoraciones</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="registronotas">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'criteriosevaluacion' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('criteriosevaluacion')}}">
               <div class="items-dashboard"> 
                <i class="fa-solid fa-list-check"></i>
                <span class="sidebar-normal">{{ __('Criterios de Evaluación') }}</span>
                </div>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'carganotas' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('buscadornotas')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-pen-to-square"></i>
                <span class="sidebar-normal"> {{ __('Valoraciones por Etapa') }} </span>
                </div>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'notasfinales' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('buscadornotasfinales')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-pen-to-square"></i>
                <span class="sidebar-normal"> {{ __('Valoraciones Finales') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      <?php
      $idpersona= Auth::user()->idpersona;
      $tipodocente=App\Models\Docente::where('id',$idpersona)->get();
      foreach($tipodocente as $tipo){
        $tipodoc="$tipo->especialidad";
      }
      ?>
      <?php 
      if($tipodoc=='Grado'){?>
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#asistencias" aria-expanded="false">
          <div class="items-dashboard">
          <i class="fa-solid fa-clipboard-list"></i>
          <span class="sidebar-normal">Asistencias</span>
            <b class="caret"></b>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="asistencias">
          <ul class="nav">
             <li class="nav-item{{ $activePage == 'cargasistenciagrado' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('asistencias')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-clipboard-list"></i>
                <span class="sidebar-normal"> {{ __('Registro de Asistencias') }} </span>
                </div>
              </a>
            </li>
             <li class="nav-item{{ $activePage == 'justificacioninasistencias' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('justificacioninasistencias')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-list-check"></i>
                <span class="sidebar-normal"> {{ __('Gestión de Justificaciones') }} </span>
                </div>
              </a>
            </li>
           
          </ul>
        </div>
      </li>
       
      <?php 
      }
      if($tipodoc!='Grado'){?>
       <li class="nav-item">
        <div class="collapse show">
          <ul class="nav">
      <li class="nav-item{{ $activePage == 'cargasistencia' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('asistencias.especiales')}}">
        <div class="items-dashboard">
        <i class="fa-solid fa-clipboard-list"></i>
        <span class="sidebar-normal"> {{ __('Registro de Asistencias') }} </span>
        </div>
        </a>
      </li>
    </ul>
  </div>
      <?php
}
?>
    </li>
    <li class="nav-item">
        <div class="collapse show">
          <ul class="nav">
      <li class="nav-item{{ $activePage == 'eventos' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('calendario')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-calendar-day"></i>
                <span class="sidebar-normal"> {{ __('Eventos') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </li>
    <li class="nav-item">
        <div class="collapse show" >
          <ul class="nav">
          <li class="nav-item{{ $activePage == 'chatdocente' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('chatify')}}">
                <div class="items-dashboard">
                <i class="fa-solid fa-comment-dots"></i>
                <span class="sidebar-normal">{{ __('Central de Mensajes') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </li>
  </ul>
  </div>

<?php
}

  if (Auth::user()->role =='familia') { ?>
  <div class="sidebar-wrapper">
    <ul class="nav">
     <li class="nav-item{{ $activePage == 'dashboardfamilia' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('familia')}}">
          <i class="bi bi-list"></i>
           <strong><p>{{ __('MENU FAMILIA') }}</p></strong> 
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'infoalumnos' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('infoalumnos')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-graduation-cap"></i>
                <span class="sidebar-normal"> {{ __('Información Académica') }} </span>
                </div>
              </a>
      </li>
      <li class="nav-item{{ $activePage == 'asistenciasfamilia' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('asistenciasalumnos')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-clipboard-list"></i>
                <span class="sidebar-normal"> {{ __('Asistencias') }} </span>
                </div>
              </a>
            </li>
      <li class="nav-item{{ $activePage == 'eventos' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('eventosfamilia')}}">
                <div class="items-dashboard">
               <i class="fa-solid fa-calendar-day"></i>
                <span class="sidebar-normal"> {{ __('Eventos') }} </span>
                </div>
              </a>
            </li>
      
      <li class="nav-item">
        <div class="collapse show" >
          <ul class="nav">
          <li class="nav-item{{ $activePage == 'chatfamilia' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('chatify')}}">
                <div class="items-dashboard">
                <i class="fa-solid fa-comment-dots"></i>
                <span class="sidebar-normal">{{ __('Central de Mensajes') }} </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
</div>
<?php
}
?>
</div>
<?php  
}
?>
