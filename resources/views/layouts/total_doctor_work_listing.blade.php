@extends('layouts.master')
@push('plugin-styles')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" /> 
@endpush
@section('pageTitle', 'Profile |Total Doctor Work Listing')

@section('content')
<div class="container">
<div class="row gx-10 overflow-hidden">
@foreach ( $data['doctorImage'] as $profile_image)
    @foreach ( $data['job_apply'] as $job)
    @if ($profile_image->id == $job->doctor_id)
    <div class="col-md-6 card card-image p-3 mt-3">
        <a class="name_link" href="{{url('profile',['token' => $profile_image->remember_token])}}"><img class="rounded-circle" src="{{isset($profile_image->doctor->profile_image) ? asset('/assets/images/profileImage/'.$profile_image->doctor->profile_image) : asset('assets/images/default.png')}}" height="50px" width="50px" alt="">
            <h5 class="pl-3 pt-1 user_name">{{($profile_image->name)}}</h5>
        </a>
            <p class="pl-3 ">{{($profile_image->address)}}</p>
    </div>
@endif
@endforeach
@endforeach
</div>
</div>


@endsection
@push('custom-scripts')
  <script src="{{ asset('assets/js/job_application.js') }}"></script>
  <script src="{{ asset('assets/js/sweet_alert.js') }}"></script>
@endpush
