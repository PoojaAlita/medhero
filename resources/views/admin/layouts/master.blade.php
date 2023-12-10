<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title') | MedHero - Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.png') }}">
        <!-- Bootstrap Css -->
        <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- CSRF Token -->
        <meta name="_token" content="{{ csrf_token() }}">
        <!-- Icons Css -->
        <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{asset('admin/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">

        <!-- Custome Style-->
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
        <link href="{{ asset('admin/assets/select2/select2.min.css') }}" rel="stylesheet" />
        <!-- Sweet Alert-->
        <link href="{{asset('admin/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
        @yield('plugin-css')
        @yield('custome-css')
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('admin.layouts.header')
            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.layouts.sidebar')
            
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                @yield('content')
              
                <!-- End Page-content -->
                @include('admin.layouts.footer')
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title px-3 py-4">
                    <a href="javascript:void(0);" class="right-bar-toggle float-end">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                    <h5 class="m-0">Settings</h5>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="{{asset('admin/assets/images/layouts/layout-1.jpg')}}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{asset('admin/assets/images/layouts/layout-2.jpg')}}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="{{asset('admin/assets/css/bootstrap-dark.min.css')}}" 
                            data-appStyle="{{asset('admin/assets/css/app-dark.min.css')}}" />
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{asset('admin/assets/images/layouts/layout-3.jpg')}}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="{{asset('admin/assets/css/app-rtl.min.css')}}" />
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>
                    <div class="d-grid">
                        <a href="https://1.envato.market/grNDB" class="btn btn-primary mt-3" target="_blank"><i class="mdi mdi-cart me-1"></i> Purchase Now</a>
                    </div>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('admin/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('admin/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('admin/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/app.js')}}"></script>
        <script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

       <!-- url -->
      <script type="text/javascript">
       var aurl = {!! json_encode(url('/')) !!}
       /* Ajax Set Up */
       $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
            },
        });
        $('.menu-colaps').click(function() {
        $('.i-logo').toggle();
    });
     </script>
        @yield('plugin-script')
        @yield('costome-script')
        <script src="{{ asset('assets/js/sweet_alert.js') }}"></script>

    </body>

</html>