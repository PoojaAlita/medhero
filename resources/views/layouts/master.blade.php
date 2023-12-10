<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <title>@yield('pageTitle')</title>
    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.png') }}">

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- end common css -->

    <!-- plugin css -->
    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <!-- end plugin css -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
	{{-- <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet"> --}}
	<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet" />  
	<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">  
	<link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    @stack('plugin-styles')
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />  
    @stack('style')
</head>

<body>

    @include('layouts.header')
        @yield('content')
    @include('layouts.footer')

</body>
<!-- base js -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('assets/js/additional-methods.min.js')}}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- end base js -->
<script type="text/javascript">
    var aurl = {!! json_encode(url('/')) !!} 
     /* Ajax Set Up */
     $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
            },
        });
</script>
@stack('custom-scripts')
<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

<!-- common js -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- end common js -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.js')}}"></script>
<!-- common js -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- end common js -->

<script>
    $(window).scroll(function () {
        var sc = $(window).scrollTop()
        if (sc > 200) {
            $("header").addClass("header-fixed")
        } else {
            $("header").removeClass("header-fixed")
        }
    });
    jQuery(".mobile-menu-btn").click(function(){
        jQuery('body').addClass('overlay_is_open');
    });
    jQuery(".menu-close").click(function(){
        jQuery('body').removeClass('overlay_is_open');
    });
        
    $('#owl-testimonial').owlCarousel({
        loop:true,
        margin:20,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            991:{
                items:3
            },
            1200:{
                items:4 
            }
        }
    })

    $(document).ready(function(){
    
        $('ul.tabs li').click(function(){
            var tab_id = $(this).attr('data-tab');
    
            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');
    
            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        });
        $(".drop a").click(function(){
            $(".ul-submenu").slideToggle();
        });

    })
    
    $(".tab_content").hide();
        $(".tab_content:first").show();
    $("ul.tabs li").click(function() {
        $(".tab_content").hide();
        var activeTab = $(this).attr("rel"); 
        $("#"+activeTab).fadeIn();		
        $("ul.tabs li").removeClass("active");
        $(this).addClass("active");
        $(".tab_drawer_heading").removeClass("d_active");
        $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
    });
    $(".tab_drawer_heading").click(function() {
        $(".tab_content").hide();
        var d_activeTab = $(this).attr("rel"); 
        $("#"+d_activeTab).fadeIn();
        $(".tab_drawer_heading").removeClass("d_active");
        $(this).addClass("d_active");
        $("ul.tabs li").removeClass("active");
        $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });
    $('ul.tabs li').last().addClass("tab_last");
    
</script>

</html>