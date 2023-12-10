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

{{-- @include('layouts.job_modal') --}}

<section class="profile-banner">
    <div class="container">
        <br>
        <div class="box-white">
            <h2 class="h2-profile">Job Post</h2>
            @if (!is_null($jobs))
            @foreach ($jobs as $job)
            
            <div class="detail-exp present">
                {{-- <div class="dt-content">
                    <div class="row job_row">
                        <div class="col-1">
                            <h6>Titel : </h6>
                        </div>
                        <div class="col-11 job_col">
                            {{ $job->title }}
                        </div>
                    </div>
                    <div class="row job_row">
                        <div class="col-1">
                            <h6>Skill : </h6>
                        </div>
                        <div class="col-11 job_col">
                             <p class="p-course">@foreach ($job->job_skill as $skills){{ (!is_null($skills->name.",")) ? $skills->name.",": '' }} @endforeach</p>
                        </div>
                    </div>
                    <div class="row job_row">
                        <div class="col-3">
                            <h6>Language : </h6>
                        </div>
                        <div class="col-11 job_language_col">
                             <p class="p-course">@foreach ($job->language_job as $language){{ (!is_null($language->name.",")) ? $language->name.",": '' }} @endforeach</p>
                        </div>
                    </div>

                    <div class="row job_row">
                        <div class="col-3">
                            <h6>Work Period : </h6>
                        </div>
                        <div class="col-9 job_work_period_row">
                            {{$job->work_period}}
                        </div>
                    </div>
                    <div class="row job_row">
                        <div class="col-3">
                            <h6>Hourly Rate : </h6>
                        </div>
                        <div class="col-9 job_work_period_row">
                            {{$job->hourly_rate}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h6>Experience : </h6>
                        </div>
                        <div class="col-9 job_col job_experience_row">
                            {{$job->experience}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h6>Attach File : </h6>
                        </div>
                        <div class="col-9 job_col job_experience_row">
                            @if(!is_null($job->attach_file))
                            <a href="{{ url('/assets/images/JobImage/'.$job->attach_file) }}" download>{{($job->attach_file)}}</a>
                            @endif
                        </div>
                    </div>
                </div> --}}
                <div class="dt-content ">
                  <div class="row job_row g-0">
                      <div class="col-md-2">
                          <h6>Titel : </h6>
                      </div>
                      <div class="col-md-9 job_col">
                          {{ $job->title }}
                      </div>
                  </div>
                  <div class="row job_row g-0">
                      <div class="col-md-2">
                          <h6>Skill : </h6>
                      </div>
                      <div class="col-md-10 job_col g-0">
                           <p class="p-course">@foreach ($job->job_skill as $skills){{ (!is_null($skills->name.",")) ? $skills->name.",": '' }} @endforeach</p>
                      </div>
                  </div>
                  <div class="row job_row g-0">
                      <div class="col-md-2">
                          <h6>Language : </h6>
                      </div>
                      <div class="col-md-10 job_language_col">
                           <p class="p-course">@foreach ($job->language_job as $language){{ (!is_null($language->name.",")) ? $language->name.",": '' }} @endforeach</p>
                      </div>
                  </div>

                  <div class="row job_row g-0">
                      <div class="col-md-2">
                          <h6>Work Period : </h6>
                      </div>
                      <div class="col-md-9 job_work_period_row">
                          {{$job->work_period}}
                      </div>
                  </div>
                  <div class="row job_row g-0">
                      <div class="col-md-2">
                          <h6>Hourly Rate : </h6>
                      </div>
                      <div class="col-md-9 job_work_period_row">
                          {{$job->hourly_rate}}
                      </div>
                  </div>
                  <div class="row g-0">
                      <div class="col-md-2">
                          <h6>Experience : </h6>
                      </div>
                      <div class="col-md-9 job_col job_experience_row">
                          {{$job->experience}}
                      </div>
                  </div>
                  <div class="row g-0">
                      <div class="col-md-2">
                          <h6>Attach File : </h6>
                      </div>
                      <div class="col-md-9 job_col job_experience_row">
                          @if(!is_null($job->attach_file))
                          <a href="{{ url('/assets/images/JobImage/'.$job->attach_file) }}" download>{{($job->attach_file)}}</a>
                          @endif
                      </div>
                  </div>
              </div>
                <span class="span-edit update_job" data-id="{{ encryptid($job->id) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></span>
            </div>
            @endforeach
            @endif
        </div> 
    </div>
</section>

{{-- Job Post Modal --}}
<div class="modal modal-common addmodal" id="job_modal" tabindex="-1" aria-labelledby="experienceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content modal-g-photo">
        <div class="modal-header">
          <h5 class="modal-title" id="jobModalLabel">Add Job</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body md-detail">
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
                <textarea name="description" id="description" cols="80" rows="2"></textarea>
           </div>

           <div class="frm-grp logo">
            <div class="logo-one"><button><input type="file" id="attach_file" name="attach_file">Attach File</button></div>
          </div>

           <img class="attach_image" width="48" src="">

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn  delete_job" data-id="0">Delete Job</button>
          <button type="button" class="btn btn-blue-modal submit_job">Submit</button>
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
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
  <script src="{{ asset('assets/js/profile.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush