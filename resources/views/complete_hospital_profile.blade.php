@extends('layouts.master')
@php
    $user = Auth::user();
@endphp
@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/plugins/cropperjs/cropper.min.css') }}" />
<link href="{{ asset('css/model.css') }}" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('css/step_form.css')}}" rel="stylesheet" /> 

@endpush
@section('pageTitle', 'Complete Hospital Profile')
@section('content')


<div class="tab-wrapper">
    <div class="tab tab_1" id="tab_1" style="display:block">
        <div class="container">
            <div class="form-sign-wrapper">
                <h1>General Details</h1>
                <div class="row-one">
                    <p class="p-require">* Indicates required</p>
                    <form class="frm-details" id="hospital_form">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" class="form-control"  name="form_id" value="general_form">
                            </div>
                            <div class="frm-grp">
                                <label for="exampleInputName">Hospital Name</label>
                                <input type="text" class="input-cstm" name="hospital_name" placeholder="hospital Name" value={{old('hospital_name')}}>
                                <div class="text-danger">
                                  @error('hospital_name')
                                    {{$message}}
                                  @enderror
                                </div>
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
                                <label>Headline*</label>
                                <input class="input-cstm" name="headline" type="text" placeholder="" value="{{ $user->headline }}" />
                                @if($errors->has('headline'))
                                        <span class="backend_errro">headline is required</span>
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
                                    <select class="js-example-basic-single form-select country" data-width="100%" id="hospital_country" name="country">
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
                                <label>About Your Hospital*</label>
                                <textarea class="input-cstm" type="text" placeholder="About" name="about" rows="6" style="width:100%">{{$user->about}}</textarea></p>
                                @if($errors->has('about'))
                                        <span class="backend_errro">About is riquired</span>
                                    @endif
                            </div>
                        </form>
                        <div class="prev-next-btn">
                            <button type="button" class="btn btn-primary" id="hospital_submit">Next</button>
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

@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/image_preview.js') }}"></script>
@endpush