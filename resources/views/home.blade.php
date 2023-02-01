@extends('layouts.main', ['class' => 'off-canvas-sidebar','activePage' => 'title', 'titlePage' => __('Dashboard Docente')])
<?php
$detect = new Mobile_Detect;
?>
@section('content')
 <div class="content">
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
<?php
if ($detect->isMobile() or $detect->isTablet()) {?>
  <div class="flexbox-container" style="margin-top: 10%;">
  <div><img style="width:340px;margin-left:3%;" src="img/computer.png"class="simple-text logo-normal"></div>
</div>
<?php 
}
else{?>
<div class="flexbox-container">
  <div><h3 style="text-align:center;"><strong>"Sistema Educativo para la Optimización en los procesos de comunicación, gestión académica del estudiante y sus actividades escolares, destinado a establecimientos educativos de nivel primario"</strong> </h3></div>
  <div><img style="width:450px" src="img/computer.png"class="simple-text logo-normal"></div>

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