@extends('layouts.master')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" /> 
@endpush
@section('pageTitle', 'Profile | Education')

@section('content')

@include('layouts.modals')

<section class="profile-banner">
    <div class="container">
        <br>
        <div class="box-white">
            <h2 class="h2-profile">Education</h2>
            @foreach ($educations as $education)
            <div class="detail-exp present">
                <div class="logo-one">
                    @if(!is_null($education->logo))
                    <img width="48" src="{{ url('/assets/images/school/logo/'.$education->logo) }}">
                    @endif
                </div>
                <div class="dt-content">
                    <h6>{{ $education->name }}</h6>
                    <p class="p-course">{{ (!is_null($education->degree)) ? $education->degree : '' }}</p>
                    <p class="year-p">{{ date('Y',strtotime($education->start_date)) }} - {{ date('Y',strtotime($education->end_date)) }}</p>
                </div>
                <span class="span-edit update_education" data-id="{{ encryptid($education->id) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></span>
            </div>
            @endforeach
        </div> 
    </div>
</section>

 
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush
@push('custom-scripts')
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
  <script src="{{ asset('assets/js/profile.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush