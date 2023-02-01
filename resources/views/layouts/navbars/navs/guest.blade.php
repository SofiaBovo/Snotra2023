<!-- Navbar -->
<?php
$detect = new Mobile_Detect;
?>
<?php
if ($detect->isMobile() or $detect->isTablet()) {?>
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
<div style="text-align:center;width:100%;">
<div class="logo" style="display:inline-block;">
    <img style="width:50%;margin-right: 15%;margin-left:15%;" src="{{ asset ('img/logo.png')}}"class="simple-text logo-normal">
<div style="margin-top:8%;margin-left: 0%;display:inline-block;">
<a href="{{ route('register') }}" style="font-size: 20px;padding:5rem 1rem;">
  <i class="material-icons">person_add</i> {{ __('REGISTRARME') }}
</a>
<a href="{{ route('login') }}" style="font-size: 20px;padding:5rem 1rem;" >
  <i class="material-icons">login</i> {{ __('LOGIN') }}
</a>
</div>
</div>
</nav>
<?php 
}
else{?>
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="logo">
    <img style="width:250px" src="{{ asset ('img/logo.png')}}" class="simple-text logo-normal">
  </div>
  <div class="container">
    <div class="navbar-wrapper">
    <a class="navbar-brand" href="{{ route('home') }}"></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('REGISTRARME') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">login</i> {{ __('LOGIN') }}
          </a>
        </li>
       <!-- <li class="nav-item ">
          <a href="*" class="nav-link">
            <i class="material-icons">face</i> {{ __('Profile') }}
          </a>
        </li>-->
      </ul>
    </div>
  </div>
</nav>
<?php 
}
?>
<!-- End Navbar -->