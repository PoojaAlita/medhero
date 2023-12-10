@extends('layouts.master')
@section('pageTitle', 'Job Application')
@section('content')
  <div class="row">
    <div class="loader-background" id="loader_bg" style="display:none">
      <div class="spinner-border"  id="loader"   role="status"></div>
   </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-7">
              <h6 class="card-title">Job Application Form</h6>
            </div>
            <div class="col-5">
              <a class="card-title" href="{{url('profile', $data['hospitalData']['remember_token'])}}">{{$data['hospitalData']['name']}}
              </a>
            </div>
          </div>
  
          <form class="forms-sample" id="job_apllication">
            @csrf
            <input type="hidden" name="id" value="0" id="id"/>    
            
            <div class="mb-3">
              <input type="hidden" name="doctor_id" value="{{Auth::user()->id}}">   
              <label for="exampleInputHospitalName1" class="form-label">Hospital Name</label>
              <input type="text" class="form-control"  id="exampleInputHospitalName1" autocomplete="off" value="{{$data['hospitalData']->name}}" disabled>
              <input type="hidden" name="user_id" value="{{$data['hospitalData']->id}}" value="{{Auth::user()->id}}">    
            </div>
            
            <div class="mb-3">
              <label for="exampleInputJobDescription" class="form-label">Title</label>
              <input type="text" class="form-control" id="exampleInputjobDescription" value="{{$data['jobDetails']->title}}" disabled>
              <input type="hidden" name="job_post_id" value="{{$data['jobDetails']->id}}">    
            </div>
            <div class="mb-3">
                <label for="exampleInputJobRate" class="form-label">Rate</label>
                <input type="text" class="form-control" id="exampleInputJobRate" value="{{$data['jobDetails']->hourly_rate}}" disabled>
            </div>
            <div class="mb-3">
              <label for="exampleInputJobRate" class="form-label">Desscrption</label>
              <textarea name="" id="" cols="73" rows="3" disabled>{{$data['jobDetails']->description}}</textarea>
            </div>

            <div class="mb-3">
              <label for="exampleInputOffer" class="form-label">Your Offer</label>
              <input type="text" class="form-control" id="exampleInputOffer" name="offer" value="" placeholder="Enter Your Offer">
            </div>
            <button type="submit" id="submit_job_application" class="btn btn-primary me-2">Apply</button>
          </form>
  
        </div>
      </div>
    </div>
  </div>
@endsection

@push('custom-scripts')
  <script src="{{ asset('assets/js/job_application.js') }}"></script>
  <script src="{{ asset('assets/js/sweet_alert.js') }}"></script>
@endpush
