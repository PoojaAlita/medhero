@extends('layouts.master')
@push('plugin-styles')
<link href="{{ asset('admin/assets/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@section('pageTitle', 'Job Application')
@section('content')
<div class="loader-background" id="loader_bg" style="display: none">
  <div class="spinner-border"  id="loader"   role="status"></div>
</div>
 <div class="job-card">
  <div class="card w-75">
    <h5 class="card-header">{{$data['job_application']->job->title}}</h5>
    <div class="card-body">
      <h5 class="card-title">{{ucfirst($data['job_application']->User->name)}}</h5>
        <h6 class="text-muted">Hourly Rate : {{$data['job_application']->job->hourly_rate}}</h6>
      <p class="card-text">{{$data['job_application']->job->description}}</p>
      <h6> Offer : {{$data['job_application']->offer}}</h6>
     
      @if ($data['job_application']->reject == 0)
        <button class="delete btn btn-sm btn-danger m-1" data-id="{{$data['job_application']->id}}">Withdraw
        </button>
        <button class="btn btn-sm m-1 {{$data['job_application']->offer_accept == 1 ? ' btn-success accept': ($data['job_application']->offer_accept == 2 ? 'btn-success edit_job_apply' : 'btn-default')}}" data-id="{{$data['job_application']->id}}">{{$data['job_application']->offer_accept == 1 ? 'Accept' : ($data['job_application']->offer_accept == 2 ?'Edit':'')}}
        </button>
      @else
      <div class="reject-offer">
        <div class="row">
          <div class="col-md-2">
              Offer Status : 
          </div>
          <div class="col-md-10">
            <h6 class="text-reject text-red-600	">{{$data['job_application']->reject == 1 ? 'Reject' : ''}}</h6>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div> 
 </div>
  
<!-- Job Apply Modal -->
<div class="modal fade select  bd-example-modal-md" id="job_apply_modal" tabindex="-1" aria-labelledby="title_job_apply_modal" aria-hidden="true">
  <div class="loader-background" id="loader_bg" style="display:none">
    <div class="spinner-border"  id="loader"   role="status"></div>
 </div>  
  <div class="modal-dialog modal-md modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title_job_apply_modal">Edit Job Apply </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
            <form class="forms-sample" id="job_apllication">
                @csrf
                <input type="hidden" name="doctor_id"  id="doctor_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="hospital_id"  id="hospital_id">
                <input type="hidden" name="job_id" id="job_id">
                <input type="hidden" name="id" value="0" id="id"/>    
                <div class="mb-3">
                  <label for="exampleInputHospitalName1" class="form-label">Hospital Name</label>
                  <input type="text" class="form-control"  id="exampleInputHospitalName1" autocomplete="off" value="" disabled>
                  <input type="hidden" id="user_id" name="user_id" value="">    
                </div>
                <div class="mb-3">
                  <label for="exampleInputjobTitle" class="form-label">Title</label>
                  <input type="text" class="form-control" id="exampleInputjobTitle" value="" disabled>
                  <input type="hidden" id="job_post_id" name="job_post_id" value="">    
                </div>
                <div class="mb-3">
                    <label for="exampleInputJobRate" class="form-label">Rate</label>
                    <input type="text" class="form-control" id="exampleInputJobRate" value="" disabled>
                </div>
                <div class="mb-3">
                  <label for="exampleInputDescription" class="form-label">Description</label>
                  <textarea name="" id="exampleInputDescription" cols="50" rows="3" disabled></textarea>
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
@push('plugin-scripts')
<script src="{{ asset('assets/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/assets/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush
@push('custom-scripts')
  <script src="{{ asset('assets/js/job_application.js') }}"></script>
  <script src="{{ asset('assets/js/sweet_alert.js') }}"></script>
@endpush

