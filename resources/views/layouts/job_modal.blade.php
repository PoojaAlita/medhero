@extends('layouts.master')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" /> 
@endpush
@section('pageTitle', 'Profile | Job Post')
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
              <h6 class="card-title">Job Post</h6>
            </div>
          </div>
  
           <p class="p-require">* Indicates required</p>
          <form class="frm-details" id="job_post_form">
            @csrf
            <div class="mb-3">
              <input type="hidden" class="form-control job_post_modal_id" id="job_post_modal_id" name="id" value="{{ encryptid('0') }}">
            </div>
            <div class="frm-grp">
                <label>Title<span style="color:red">*</label>
                <input class="input-cstm title" type="text" name="title" placeholder="Please Enter Title" value=""/>
            </div>

            <div class="frm-grp">
              <label>Skills<span style="color:red">*</span></label>
             <select class=" form-select js-example-basic-multiple select_skills" name="skills[]" multiple="multiple">
              @if($all_skills->isEmpty())
                <option selected disabled value="0">First Enter Skills</option>
              @else
                @foreach($all_skills as $skills)
                <option  value="{{$skills->id}}">{{$skills->name}}</option>
                @endforeach
              @endif
            </select>
          </div>

          <div class="frm-grp">
            <label>Languages<span style="color:red">*</span></label>
            <select class=" form-select js-example-basic-multiple select_language" name="languages[]" multiple="multiple">
              @if($all_languages->isEmpty())
                <option selected disabled value="0">First Enter Language</option>
              @else
                @foreach($all_languages as $language)
                <option  value="{{$language->id}}">{{$language->name}}</option>
                @endforeach
              @endif
            </select>
          </div>
           
            <div class="frm-grp">
                <label>Work Period<span style="color:red">*</label>
                <input class="input-cstm work_period" name="work_period" type="text" placeholder="Please Enter Work Period"/>
            </div>

            <div class="frm-grp">
              <label>Experience<span sty  le="color:red">*</span></label>
             <select class=" form-select js-example-basic-multiple select_experience" name="experience">
              <option selected disabled value="0">Select Experience</option>
              <option value="Entery">Entery</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Expert">Expert</option>
            </select>
            </div>
            
            <div class="frm-grp">
              <label>Hourly Rate<span style="color:red">*</label>
              <input class="input-cstm hourly_rate" name="hourly_rate" type="text" placeholder="Please Enter Hourly Rate"/>
           </div>

           <div class="frm-grp">
            <label>Description<span style="color:red">*</label>
              <textarea name="description" id="description" cols="73" rows="2"></textarea>
         </div>

         <div class="frm-grp logo">
          <div class="logo-one"><button><input type="file" id="attach_file" name="attach_file">Attach File</button></div>
        </div>

         <img class="attach_image" width="48" src="">

         <button type="button" class="btn  delete_job" data-id="0" style="display:none">Delete Job</button>
         <button type="button" class="btn btn-blue-modal submit_job">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
 
  
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
@endpush