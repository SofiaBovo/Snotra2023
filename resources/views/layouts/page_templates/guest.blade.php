@include('layouts.navbars.navs.guest')
<div class="wrapper wrapper-full-page">
  <div class="page-header login-page header-filter"  style="background-image: url('{{ asset('img/fondo.jpg')}}'); background-size: cover; background-position: top center;align-items: center;">
    @yield('content')
    @include('layouts.footers.guest')
  </div>
</div>
