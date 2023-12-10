<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>@yield('title') | MedHero - Admin </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
         <!-- CSRF Token -->
        <meta name="_token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.png') }}">
        <!-- Bootstrap Css -->
        <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{asset('admin/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">
        <!-- Custome Css -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
        @yield('custome-style')
    </head>

<body>

    <div class="home-btn d-none d-sm-block">
        <a href="{{route('welcome')}}" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    @yield('content')
    <!-- JAVASCRIPT -->
    <script src="{{asset('admin/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/app.js')}}"></script>
     <!-- url -->
     <script type="text/javascript">
        var aurl = {!! json_encode(url('/')) !!}
    </script>
    @yield('custome-script')
</body>

</html>