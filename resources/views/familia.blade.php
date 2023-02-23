@extends('layouts.main', ['activePage' => 'dashboardfamilia', 'titlePage' => __('Dashboard Familia')])

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
        <div class="card" >
        <?php
        }
        ?>
    <div class="card-header card-header-info">
        <h4 class="card-title text-center">¡Hola <strong class="text-default"> {{auth()->user()->name }}! </strong> &#128075;</h4> 



    </div>
    <div class="card-body">
        <h3 class="text-center" style = "font-family:candara;">¡¡Bienvenido a <strong> SNOTRA&#129299;</strong>!!</h3>
        <h4 class="text-center" style = "font-family:candara;">La plataforma educativa que te ayuda a gestionar la actividad académica de manera fácil, simple y eficiente.</h4>
    </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection