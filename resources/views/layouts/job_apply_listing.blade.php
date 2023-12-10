@extends('layouts.master')
@push('plugin-styles')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" /> 
@endpush
@section('pageTitle', 'Profile | Job Applly Listing')

@section('content')
@if ($data['job_apply'])
@foreach ($data['job_apply'] as $key=>$job)
<div class="job-card">  
  <div class="loader-background" id="loader_bg" style="display:none">
    <div class="spinner-border"  id="loader"   role="status"></div>
 </div>
  <div class="card w-75">
    <h5 class="card-header">{{$job->job->title}}</h5>
    <div class="card-body">
      <h5 class="card-title">
        @foreach ($data['user'] as $users)
        <a href="{{url('profile',['token' => $users->remember_token])}}" data-id="{{$job->doctor_id}}">{{$users->id == $job->doctor_id ? ucfirst($users->name) : ''}}</a></h5>
        @endforeach
        <h5 class="card-title">{{ucfirst($job->job->title)}}</h5>
        <h6 class="text-muted">Hourly Rate : {{$job->job->hourly_rate}}</h6>
      <p class="card-text">{{$job->job->description}}</p>
      <h6> Offer : {{$job->offer}}</h6>
      @if ($job->reject == 0)
      <div class="row g-0">
        <div class="col-md-3">
          <h6>Status :</h6>
        </div>
        <div class="col-md-3">
          <h6 class="active_status {{$job && $job->status == 0 ? 'text-red-700':'text-slate-800'}}"> {{$job && $job->status == 1 ? 'Active' : 'Withdraw'}}</h6>
        </div>
      </div>
      @endif

      @if ($job->status == 1)
        <div class="row g-0">
          <div class="col-md-5">
            <h6>Accepted Status : </h6>
          </div>
          <div class="col-md-2">
            <h6 class="accept_status {{($job->offer_accept == 2 || $job->offer_accept == 1) && $job->reject == 0 ? 'text-green-400' : ($job->offer_accept == 3 && $job->reject == 0 ? 'text-green-600' :($job->reject == 1 ? 'text-red-700' :''))}}"> {{($job->offer_accept == 2 || $job->offer_accept == 1) && $job->reject == 0 ? 'Pending' : ($job->offer_accept == 3 && $job->reject == 0 ? 'Accepted' :($job->reject == 1 ? 'Reject' :''))}} </h6>
          </div>
        </div>
        @if ($job->reject == 0 && ($job->offer_accept == 2 || $job->offer_accept == 1))
          <button class="btn btn-sm btn-primary m-1 offer" data-id="{{$job->id}}">{{$job->offer_accept == 3 ? 'Accepted' : 'Offer'}}
          <button class="btn btn-sm btn-danger m-1 reject" data-id="{{$job->id}}"> Reject</button>
        @endif
      @endif
    </div>
  </div> 
 </div>
 @endforeach
@endif
@endsection
@push('custom-scripts')
  <script src="{{ asset('assets/js/job_application.js') }}"></script>
  <script src="{{ asset('assets/js/sweet_alert.js') }}"></script>
@endpush
