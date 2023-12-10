{{--
    *Author : kishan 
    *Date : 3/05/22
    *Created complete profile view page
--}}
@extends('layouts.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/plugins/cropperjs/cropper.min.css') }}" />
{{--

    *Author : kishan 
    *Date : 29/04/22
    *Added skill model css for textbox
--}}
<link href="{{ asset('css/model.css') }}" rel="stylesheet" />
{{--  
    *Author : kishan 
    *Date : 29/04/22
    *end
--}} 
{{-- Step form css --}}
<link href="{{asset('css/step_form.css')}}" rel="stylesheet" /> 

@endpush
@section('pageTitle', 'Complete Frofile')
@section('content')


<div class="tab-wrapper">
    <div class="tab tab_1" id="tab_1" style="display:block">
        <div class="container">
            <div class="form-sign-wrapper">
                <h1>General Details</h1>
                <div class="row-one">
                    <p class="p-require">* Indicates required</p>
                    <form class="frm-details" id="general_form">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" class="form-control"  name="form_id" value="general_form">
                            </div>
                            <div class="frm-grp">
                                <label>Profile Picture</label>
                                <input class="form-control fd" name="profile"  id="profile" type="file" value="{{$user->profile}}"/>
                                <div id="preview"><img id="preview_profile" src="" ></div>
                            </div>

                            <div class="frm-grp">
                                <label>Cover Picture</label>
                                <input class="form-control fd" name="cover" id="cover" type="file"/> 
                                <div id="preview"><img id="preview_cover" src="" ></div> 
                                @if(!is_null($user->profile_cover))
                                <div class="cv-pic"><img id="preview_profile" src="{{asset('assets/images/users/users_cover/'.$user->profile_cover)}}" ></div>
                                @endif 
                            </div>

                            <div class="frm-grp">
                                <label>Medical Registered number*</label>
                                <input class="input-cstm" name="medical_no" type="text" placeholder="" value="{{ $user->medical_no}}" />
                                @if($errors->has('medical_no'))
                                        <span class="backend_errro">medical_no is required</span>
                                @endif
                            </div>
                            <div class="frm-grp">
                                <label>Speciality*</label>
                                <input class="input-cstm" name="grade_primary" type="text" placeholder="" value="{{ $user->grade_primary }}" />
                                @if($errors->has('grade_primary'))
                                        <span class="backend_errro">Speciality is required</span>
                                @endif
                            </div>
                            <div class="frm-grp">
                                <label>Speciality Secondary</label>
                                <input class="input-cstm grade_secondary" name="grade_secondary" type="text" placeholder="" value="{{ $user->grade_secondary }}" />
                            </div>

                            <div class="frm-grp country_div">
                                    <label>Country/Region</label>
                                    <select class="js-example-basic-single form-select country" data-width="100%" id="" name="country">
                                    @if(!is_null($user->country))
                                        <option value="0"selected >{{$user->country}}</option>
                                    @else
                                        <option value="0"selected disabled hidden>select country</option>
                                    @endif
                                    @foreach (country() as $code=>$country)
                                        <option value="{{ $country['name'] }}">{{ $country['code'] }}-{{ $country['name'] }}</option>
                                    @endforeach
                                    </select>
                                    @if($errors->has('country'))
                                        <span class="backend_errro">Country is riquired</span>
                                    @endif
                                </div>
                            <div class="frm-grp">
                                <label>City</label>
                                <input class="input-cstm city" name="city" type="text" placeholder="City" value="{{$user->city}}"/>
                            </div>

                            <div class="frm-grp">
                                <label>About*</label>
                                <textarea class="input-cstm" type="text" placeholder="About" name="about" rows="6" style="width:100%">{{$user->about}}</textarea></p>
                                @if($errors->has('about'))
                                        <span class="backend_errro">About is riquired</span>
                                    @endif
                            </div>

                        </form>
                    <div class="prev-next-btn">
                    
                        <button type="button" class="btn btn-secondary pre_tab1" id="prevBtn">Previous</button>
                        <button type="button" class="btn btn-info skip_gen"  id="skipBtn" >Skip</button>
                        <button type="button" class="btn btn-primary next_tab1" id="nextBtn">Next</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab tab_2" id="tab_2" style="display:none">
        <div class="container">
            <div class="form-sign-wrapper">
                <h1>Experience Details</h1>
                <div class="row-one">
                    <p class="p-require">* Indicates required</p>
                    <form class="frm-details" id="step_experience_form">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control"  name="form_id" value="step_experience_form">
                    </div>
                
                    <div class="frm-grp">
                        <label>Title*</label>
                        <input class="input-cstm position" type="text" name="position" placeholder="Title" value=""/>
                    </div>
                    <div class="frm-grp">
                        <label>Employment Type</label>
                        <select class="input-cstm employment_type" name="employment_type" id="employment_type">
                            <option selected hidden class="input-cstm">Please Select</option>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Internship">Internship</option>
                            <option value="Trainee">Trainee</option>
                        </select>
                        @if($errors->has('employment_type'))
                        <span class="backend_errro">Employment type is riquired</span>
                        @endif
                    </div>

            
                    <div class="frm-grp logo">
                        <label>Hospital Logo</label>
                        <div class="logo-one"><button><input type="file" id="logo" name="logo" class="logo_input" accept="image/png, image/jpeg">Add Company Logo</button></div>
                        <div id="h_logo_preview"><img id="preview_h_logo" src=""></div>
                    </div>
                    <div class="frm-grp">
                        <label>Hospital*</label>
                        <input class="input-cstm hospital_name" name="name" type="text" placeholder=""/>
                        @if($errors->has('name'))
                        <span class="backend_errro">Hospital name is riquired</span>
                        @endif
                    </div>

                    <h4>Location</h4>
                    <div class="frm-grp">
                        <label>Country/Region</label>
                        <select class="js-example-basic-single form-select country" data-width="100%" id="country" name="e_country">
                            <option value="0"selected disabled hidden>select country</option>
                            @foreach (country() as $code=>$country)
                            <option value="{{ $country['name'] }}">{{ $country['code'] }}-{{ $country['name'] }}</option>
                            @endforeach

                        </select>
                        @if($errors->has('e_country'))
                        <span class="backend_errro">Country is riquired</span>
                        @endif
                    </div>
                    <div class="frm-grp">
                        <label>City</label>
                        <input class="input-cstm city_exp" name="city" type="text" placeholder=""/>
                    </div>
                    <div class="frm-grp form-check">
                        <input class="form-check-input current" type="checkbox" name="current" value=""/>
                        <label class="form-check-label">I am currently working in this role</label>
                    </div>
                    <div class="row">
                        <div class="date datepicker frm-grp col-md-6 datePickerExample start_date_div">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input autocomplete="off" type="text" class="input-cstm input-group-addon start_date" id="start_date" name="start_date" value="">
                        @if($errors->has('e_country'))
                        <span class="backend_errro">Start Date riquired</span>
                        @endif
                        </div>
                        <div class="date datepicker frm-grp col-md-6 datePickerExample end_date_div">
                        <label for="end_date" class="form-label">End Date</label>
                        <input autocomplete="off" type="text" class="input-cstm input-group-addon end_date" id="end_date" name="end_date" value="">
                        </div>
                    </div>
                    <div class="frm-grp">
                        <label>Description</label>
                        <textarea class="input-cstm description" type="text" placeholder="Description" name="description" ></textarea>
                    </div>
                    </form>
                    <div class="prev-next-btn">
                    
                        <button type="button" class="btn btn-secondary pre_tab2" id="prevBtn">Previous</button>
                        <button type="button" class="btn btn-info skip_exp"  id="skipBtn">Skip</button>
                        <button type="button" class="btn btn-primary next_tab2" id="nextBtn" >Next</button>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab tab_3" id="tab_3" style="display:none">
        <div class="container">
            <div class="form-sign-wrapper">
                <h1>Education Details</h1>
                <div class="row-one">
                    <p class="p-require">* Indicates required</p>
                    <form class="frm-details" id="step_education_form">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control"  name="form_id" value="step_education_form">
                        </div>
                        <div class="frm-grp">
                            <label>School*</label>
                            <input class="input-cstm name" type="text" name="name" placeholder="School" value=""/>
                            @if($errors->has('name'))
                                <span class="backend_errro">School name is riquired</span>
                            @endif
                        </div>
                        <div class="frm-grp logo">
                        <label>School Logo</label>
                        <div class="logo-one"><button><input type="file" id="school_logo" name="school_logo" class="school_logo_input" accept="image/png, image/jpeg">Add School Logo</button></div>
                        <div id="e_logo_preview"><img id="preview_e_logo" src=""></div>
                        </div>
                        <div class="frm-grp">
                        <label>Degree*</label>
                        <input class="input-cstm degree" name="degree" type="text" placeholder=""/>
                        @if($errors->has('degree'))
                            <span class="backend_errro">Degree is riquired</span>
                        @endif
                        </div>
                        <div class="row">
                        <div class="date datepicker frm-grp col-md-6 datePickerExample start_date_div">
                            <label for="start_date" class="form-label">Start Date*</label>
                            <input autocomplete="off" type="text" class="input-cstm input-group-addon start_date" id="start_date" name="start_date" value="">
                        </div>
                        <div class="date datepicker frm-grp col-md-6  education_end_date_div">
                            <label for="end_date" class="form-label">End Date*</label>
                            <input autocomplete="off" type="text" class="input-cstm input-group-addon education_end_date " id="end_date" name="end_date" value="">
                        </div>
                        </div>
                        <div class="frm-grp">
                        <label>Grade</label>
                        <input class="input-cstm grade" name="grade" type="text" placeholder=""/>
                        </div>
                        <div class="frm-grp">
                        <label>Description</label>
                        <textarea class="input-cstm description" type="text" placeholder="Description" name="description" ></textarea>
                        </div>
                    </form>
                    <div class="prev-next-btn">
                        <button type="button" class="btn btn-secondary pre_tab3" id="prevBtn" >Previous</button>
                        <button type="button" class="btn btn-info skip_edu"  id="skipBtn" >Skip</button>
                        <button type="button" class="btn btn-primary next_tab3" id="nextBtn" >Next</button>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab tab_4" id="tab_4" style="display:none">
        <div class="container">
            <div class="form-sign-wrapper">
            <h1>Comman Details</h1>
                <div class="modal-body">
                    <p class="p-require"><span style="color:red">*</span> Indicates required</p>
                    <form class="frm-details" id="step_skill_form">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control"  name="form_id" value="step_skill_form">
                    </div>
                    <div class="frm-grp">
                        <label>Skills<span style="color:red">*</span></label>
                        <select class="js-example-basic-multiple select_skill" name="skills[]" multiple="multiple">
                        @if($user->skill->isEmpty())
                            @foreach($all_skills as $skills)
                                <option value="{{$skills->id}}">{{$skills->name}}</option>
                            @endforeach
                        @endif
                            @foreach($user->skill as $skill)  
                            @foreach($all_skills as $skills)
                                <option @if($skills->id == $skill->id) selected @endif  value="{{$skills->id}}" >@if($skills->id != $skill->id) {{$skills->name}}@else {{$skills->name}}  @endif</option>
                            @endforeach
                            @endforeach
                    
                        </select>
                        @if($errors->has('skills'))
                            <span class="backend_errro">Skills is riquired</span>
                        @endif
                    </div>

                    <div class="frm-grp">
                        <label>Languages<span style="color:red">*</span></label>
                        <select class="js-example-basic-multiple select_language" name="languages[]" multiple="multiple">
                            @if($user->language->isEmpty())
                                @foreach($all_languages as $languages)
                                <option value="{{$languages->id}}">{{$languages->name}}</option>
                                @endforeach
                            @endif
                            @foreach($user->language as $language)  
                            @foreach($all_languages as $languages)
                                <option @if($languages->id == $language->id) selected @endif  value="{{$languages->id}}">@if($languages->id != $language->id) {{$languages->name}}@else {{$languages->name}}  @endif </option>
                            @endforeach
                            @endforeach
                        </select>
                        @if($errors->has('languages'))
                            <span class="backend_errro">Languages is riquired</span>
                        @endif
                    </div>
                    </form>
                    <div class="prev-next-btn">
                        <button type="button" class="btn btn-secondary pre_tab4" id="prevBtn" >Previous</button>
                        <button type="button" class="btn btn-info skip_lang_skill"  id="skipBtn">Skip & Submit</button>
                        <button type="button" class="btn btn-primary next_tab4" id="nextBtn" >Submit</button>
                    
                    </div>
                </div>
                </div>
            </div>
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
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('assets/js/additional-methods.min.js')}}"></script>
  <script src="{{ asset('assets/js/profile.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset('assets/js/step_form.js') }}"></script>
<script src="{{ asset('assets/js/image_preview.js') }}"></script>
@endpush
{{--
   * Author : kishan 
   * Date : 3/05/22
   * End
--}}