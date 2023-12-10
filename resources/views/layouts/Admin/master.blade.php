<!DOCTYPE html>
<!--
Template Name: NobleUI - Laravel Admin Dashboard Template
Author: NobleUI
Purchase: https://1.envato.market/nobleui_laravel
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html>
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web">

  <title>MedHero</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.png') }}">

  <!-- plugin css -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- end plugin css -->

  @stack('plugin-styles')

  <!-- common css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <!-- end common css -->
  @stack('style')

   <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    {{-- <link href="{{asset('includes/pages/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> --}}
    <link href="{{asset('includes/pages/css/font-awesome.css')}}" rel="stylesheet" />   
    <link rel="stylesheet" href="{{asset('includes/pages/css/owl.carousel.min.css')}}">  
    <link rel="stylesheet" href="{{asset('includes/pages/css/owl.theme.default.min.css')}}">
</head>
<body data-base-url="{{url('/')}}">

  <script src="{{ asset('assets/js/spinner.js') }}"></script>

  <div class="main-wrapper" id="app">
    @include('layouts.Admin.sidebar')
    <div class="page-wrapper">
      @include('layouts.Admin.header')
      <div class="page-content">
        @yield('content')
      </div>
      @include('layouts.Admin.footer')
    </div>
  </div>

    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- end common js -->
  {{-- <script src="{{asset("includes/pages/js/jquery.min.js")}}"></script> --}}
  <script src="{{asset("includes/pages/js/bootstrap.min.js")}}"></script>

    @stack('custom-scripts')

    <script>
        jQuery(document).ready(function(){
          $(".sidebar-toggler").click(function(){
              $(".logo").toggle();
          }) 
        })
    </script>
    <script type="text/javascript">
      var aurl = {!! json_encode(url('/')) !!}
    </script>
    
</body>
</html>