@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

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
        <div class="card" style="margin-top:-10%;margin-left:-4%;margin-right:0.1%;width:105%;">
        <?php
        }
        else{?>
        <div class="card">
        <?php
        }
        ?>
    <div class="card-header card-header-info">
        <?php 
        if ($detect->isMobile() or $detect->isTablet()) {?>
         <MARQUEE DIRECTION=RIGHT>  <h4 class="card-title text-center">¡Hola <strong class="text-default"> {{auth()->user()->name }}! </strong> &#128075;</h4></MARQUEE>
        <?php
        }
        else{?>
         <h4 class="card-title text-center">¡Hola <strong class="text-default"> {{auth()->user()->name }}! </strong> &#128075;</h4>
        <?php
        }
        ?>
     
      
    </div>
    <div class="card-body">
        <h3 class="text-center" style = "font-family:inherit;">¡Bienvenido a <strong> SNOTRA</strong>! &#128512;</h3>
        <h5 class="text-center" style = "font-family:inherit;">La plataforma educativa que te ayuda a gestionar la actividad académica de manera fácil, simple y eficiente.</h5>
    </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection


