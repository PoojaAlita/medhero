@extends('layouts.master')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" />
{{--

    *Author : rajvi 
    *Date : 02/05/22
    *Added select 2 model css for textbox
--}}
<link href="{{ asset('css/model.css') }}" rel="stylesheet" />
{{--  
    *Author : rajvi 
    *Date : 02/05/22
    *end
--}} 
@endpush
@section('pageTitle', 'Profile | Experience')

@section('content')

@include('layouts.modals')

<section class="profile-banner">
    <div class="container">
        <br>
        <div class="box-white">
            <h2 class="h2-profile">Experience</h2>
            @foreach ($experiences as $experience)
            @php
            $start_date= strtotime($experience->start_date);
            $start_year = date('Y',$start_date);
            $start_month = date('m',$start_date);
            $end_date = strtotime((!is_null($experience->end_date)) ? $experience->end_date : now());
            $end_year = date('Y',$end_date);
            $end_month = date('m',$end_date);
            $diff = (($end_year - $start_year) * 12) + ($end_month - $start_month);
            $diff_year = intdiv($diff,12);
            $diff_month = $diff%12;
            $year=($diff_year==1) ? 'year' : 'years';
            $month=($diff_month==1) ? 'month' : 'months';
            $diff_experience= $diff_year.' '.$year.' '.$diff_month.' '.$month;
            @endphp
            <div class="detail-exp present">
                <div class="logo-one">
                    @if(!is_null($experience->logo))
                    <img width="48" src="{{ url('/assets/images/hospital/hospital_logo/'.$experience->logo) }}">
                    @endif
                </div>
                
                <div class="dt-content">
                    <h6>{{ $experience->position }}</h6>
                    <p class="name-main">{{ $experience->name }}</p>
                    <p class="designation">{{ $experience->employment_type }}</p>
                    <p class="exp-year">{{ $experience->start_date }} - {{ (!is_null($experience->end_date)) ? $experience->end_date : 'Present'  }} · {{ $diff_experience }}</p>
                    <p class="exp-contry ">{{ (!empty($experience->city)) ? $experience->city.',' : ' ' }} {{ $experience->country }}</p>
                </div>
                <span class="span-edit update_experience" data-id="{{ encryptid($experience->id) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></span>
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
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush