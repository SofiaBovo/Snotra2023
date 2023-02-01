<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('SNOTRA') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset ('img/favicon.png')}}">


    <link rel="icon" type="image/png" href="{{ asset ('img/favicon.png')}}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>


    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
     <script src="https://kit.fontawesome.com/fd58aa9044.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    

    <!-- CSS Files -->
    <link media="only screen and (min-width: 769px)" href="{{ asset('css/material-dashboard.css?v=2.1.1')}}" rel="stylesheet" />
    <link rel="stylesheet" media="only screen and (max-width: 768px)" href="{{ asset('css/estilosmobile.css')}}">
    <script type="module">
      import { initializeApp } from "https://www.gstatic.com/firebasejs/9.2.0/firebase-app.js";
      const firebaseConfig = {
        apiKey: "AIzaSyDdldSMDmYufKOsNUX9zZQED1PVpR84kw8",
        authDomain: "snotra-6c452.firebaseapp.com",
        projectId: "snotra-6c452",
        storageBucket: "snotra-6c452.appspot.com",
        messagingSenderId: "581742987840",
        appId: "1:581742987840:web:99a01d410ce9270d18ada5"
      };
      const app = initializeApp(firebaseConfig);
    </script>

    </head>

    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.page_templates.auth')
        @endauth
        @guest()
            @include('layouts.page_templates.guest')
        @endguest
        @if (auth()->check())
        
       
        @endif
        <!--   Core JS Files   -->

 

        <script src="{{ asset('js/core/jquery.min.js')}}"></script>
        <script src="{{ asset('js/core/popper.min.js')}}"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('js/core/bootstrap-material-design.min.js')}}"></script>

        <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

        <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>


    </body>
</html>