@extends('admin.layouts.master2')
@section('title',"Login")
@section('content')
<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="bg-primary">
                        <div class="text-primary text-center p-4">
                            <h5 class="text-white font-size-20">Welcome Back !</h5>
                            <p class="text-white-50">Sign in to continue to MedHero.</p>
                            <a href="index.html" class="logo logo-admin">
                                <img src="{{asset('images/favicon-32x32.png')}}" height="24" alt="logo">
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="p-3">
                            <form class="mt-4 admin_login_form" method="POST" action="{{ route('admin.login') }}">
                                @csrf        
                                <div class="mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="email" placeholder="Enter username">
                                    <div class="text-danger">
                                        @error('email')
                                          {{$message}}
                                        @enderror
                                      </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">Password</label>
                                    <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                                    <div class="text-danger">
                                        @error('password')
                                          {{$message}}
                                        @enderror
                                      </div>
                                </div>

                                <div class="mb-3">
                                    {{-- <div class="row"> --}}
                                        <div class="text-center">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custome-script')
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/login_validation.js')}}"></script>
@endsection
