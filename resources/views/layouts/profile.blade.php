@php
    $myInfo = Auth::user();
@endphp
@extends('layouts.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/plugins/cropperjs/cropper.css') }}"/>
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/images-grid.css') }}" rel="stylesheet" />

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

@endpush

@section('pageTitle', 'Profile')


@section('content')
<input type="hidden" id="login_id" value="{{ Auth::user()->id }}">
@include('layouts.skill_language_modal')
@include('layouts.modals')
@include('layouts.user_modal')

<section class="profile-banner">
    <div class="container">
        @if ($user && $user->user_status == 1)
        <input type="hidden" class="cover_image_size"  value="{{Auth::user()->user_status}}">
        <div class="row g-0">
            <div class="col-md-6 hospital_cover_image">
                <div class="hospital-profile-top-banner">
                    <img class="cover-image-size" 
                    src="{{isset($user->cover_image) ? asset('/assets/images/CoverImage/'.$user->cover_image) : asset('assets/images/default.png')}}">
                    @if ($user && Auth::user()->id==$user->id)
                    <span class="span-add-img edit_cover"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" class="mercado-match" width="16" height="16" focusable="false"> <path d="M10 9a2 2 0 11-2-2 2 2 0 012 2zm5-2.5V14H1V6.5A2.5 2.5 0 013.5 4h.75L5 2h6l.75 2h.75A2.5 2.5 0 0115 6.5zM11 9a3 3 0 10-3 3 3 3 0 003-3z"></path> </svg></span>
                    @endif
                </div>
            </div>
            <div class="col-md-6 thumb_image">
                @foreach ($user->thumb as $item)
                    <div id="gallery1"></div>
                <input type="hidden" id="user" value="{{$item->thumb_image}}">
                @endforeach
            </div>
        </div>
        @else
        <div class="profile-top-banner" style="background: url({{ $user ? url('/assets/images/CoverImage/'.$user->cover_image) : url('/assets/images/default_images/dummy_cover.jpg') }}); background-repeat: no-repeat ">
            @if ($user && Auth::user()->id==$user->id)
            <span class="span-add-img edit_cover"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" class="mercado-match" width="16" height="16" focusable="false"> <path d="M10 9a2 2 0 11-2-2 2 2 0 012 2zm5-2.5V14H1V6.5A2.5 2.5 0 013.5 4h.75L5 2h6l.75 2h.75A2.5 2.5 0 0115 6.5zM11 9a3 3 0 10-3 3 3 3 0 003-3z"></path> </svg></span>
            @endif
        </div> 
        @endif

        @if ($user && $user->user_status == 0)
        <div class="profile-wrapper">
            <div class="profile-l">
                <div class="profile-photo">
                        <img width="200" 
                        src="{{isset($user->doctor->profile_image) ? asset('assets/images/profileImage/'.$user->doctor->profile_image) : asset('assets/images/default.png')}}"
                        height="200" alt="{{$user ? $user->name :''}}" id="ember305" class="ember-view edit_profile profile-photo-edit__preview">
                </div>
                @if ($user)
                @if(Auth::user()->id!=$user->id)
                    @if(!$user->from_connections->isEmpty())
                        @if ($user->from_connections[0]['status']==1)
                            <div class="pf-connect-btn">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item remove" data-flag="1" data-connection_id="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}">Remove Following</a>
                                        <a class="dropdown-item block" data-flag="1" data-connection_id="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}">Block</a>
                                    </div>
                                </div>
                                <button class="btn btn-connect message" data-id="{{ $user->id }}">Message</button>
                            </div>
                        @elseif ($user->from_connections[0]['status']==2)
                            <div class="btn btn-primary connect" data-flag="1" data-connection_id ="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Connect</span></div>
                        @else
                            <div class="accept_remove_btn">
                                <div class="btn accept accept_btn" data-flag="1" data-connection_id="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Accept</span></div>
                                <div class="btn remove" data-flag="1" data-connection_id="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Reject</span></div>
                            </div>
                           
                        @endif
                    @elseif(!$user->to_connections->isEmpty())
                        @if ($user->to_connections[0]['status']==1)
                            <div class="pf-connect-btn">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item remove" data-flag="1" data-connection_id="{{ $user->to_connections[0]['id'] }}" data-id="{{ $user->id }}">Remove Following</a>
                                        <a class="dropdown-item block" data-flag="1" data-connection_id="{{ $user->to_connections[0]['id'] }}" data-id="{{ $user->id }}">Block</a>
                                    </div>
                                </div>
                                <button class="btn btn-connect message" data-id="{{ $user->id }}">Message</button>
                            </div>                                                       
                        @elseif ($user->to_connections[0]['status']==2)
                            <div class="btn btn-primary connect" data-flag="1" data-connection_id="{{ $user->to_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Connect</span></div>
                        @else
                            <div class="btn remove" data-flag="1" data-connection_id="{{ $user->to_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Requested</span></div>
                        @endif
                    @else
                        <div class="btn btn-connect connect" data-flag="1" data-id="{{ $user->id }}"><span class="text-center">Connect</span></div>
                    @endif
                  
                @endif
                @endif
            </div>
            <div class="profile-r">
                @if ($user)
                @if(Auth::user()->id==$user->id)
                <div class="right-one-pro">
                    <span class="calender"><a href="{{ route('calendar') }}"><svg id="Layer_1" style="enable-background:new 0 0 64 64;" version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css"> .st0{fill:#7C8393;} </style><g><g id="Icon-Calendar" transform="translate(30.000000, 478.000000)"><path class="st0" d="M19.6-424h-35.2c-2.4,0-4.4-2-4.4-4.4v-32.3c0-2.4,1.6-4.4,3.7-4.4h2.2v2.9h-2.2     c-0.3,0-0.7,0.6-0.7,1.5v32.3c0,0.8,0.7,1.5,1.5,1.5h35.2c0.8,0,1.5-0.7,1.5-1.5v-32.3c0-0.9-0.5-1.5-0.7-1.5h-2.2v-2.9h2.2     c2,0,3.7,2,3.7,4.4v32.3C24-426,22-424,19.6-424" id="Fill-133"/><path class="st0" d="M-9.7-459.2c-0.8,0-1.5-0.7-1.5-1.5v-5.9c0-0.8,0.7-1.5,1.5-1.5s1.5,0.7,1.5,1.5v5.9     C-8.3-459.9-8.9-459.2-9.7-459.2" id="Fill-134"/><path class="st0" d="M13.7-459.2c-0.8,0-1.5-0.7-1.5-1.5v-5.9c0-0.8,0.7-1.5,1.5-1.5s1.5,0.7,1.5,1.5v5.9     C15.2-459.9,14.5-459.2,13.7-459.2" id="Fill-135"/><polygon class="st0" id="Fill-136" points="-5.3,-465.1 9.3,-465.1 9.3,-462.1 -5.3,-462.1    "/><polygon class="st0" id="Fill-137" points="-17.1,-456.3 21.1,-456.3 21.1,-453.3 -17.1,-453.3    "/><polygon class="st0" id="Fill-138" points="15.2,-450.4 18.1,-450.4 18.1,-447.5 15.2,-447.5    "/><polygon class="st0" id="Fill-139" points="9.3,-450.4 12.3,-450.4 12.3,-447.5 9.3,-447.5    "/><polygon class="st0" id="Fill-140" points="3.5,-450.4 6.4,-450.4 6.4,-447.5 3.5,-447.5    "/><polygon class="st0" id="Fill-141" points="-2.4,-450.4 0.5,-450.4 0.5,-447.5 -2.4,-447.5    "/><polygon class="st0" id="Fill-142" points="-8.3,-450.4 -5.3,-450.4 -5.3,-447.5 -8.3,-447.5    "/><polygon class="st0" id="Fill-143" points="15.2,-444.5 18.1,-444.5 18.1,-441.6 15.2,-441.6    "/><polygon class="st0" id="Fill-144" points="9.3,-444.5 12.3,-444.5 12.3,-441.6 9.3,-441.6    "/><polygon class="st0" id="Fill-145" points="3.5,-444.5 6.4,-444.5 6.4,-441.6 3.5,-441.6    "/><polygon class="st0" id="Fill-146" points="-2.4,-444.5 0.5,-444.5 0.5,-441.6 -2.4,-441.6    "/><polygon class="st0" id="Fill-147" points="-8.3,-444.5 -5.3,-444.5 -5.3,-441.6 -8.3,-441.6    "/><polygon class="st0" id="Fill-148" points="-14.1,-444.5 -11.2,-444.5 -11.2,-441.6 -14.1,-441.6    "/><polygon class="st0" id="Fill-149" points="15.2,-438.7 18.1,-438.7 18.1,-435.7 15.2,-435.7    "/><polygon class="st0" id="Fill-150" points="9.3,-438.7 12.3,-438.7 12.3,-435.7 9.3,-435.7    "/><polygon class="st0" id="Fill-151" points="3.5,-438.7 6.4,-438.7 6.4,-435.7 3.5,-435.7    "/><polygon class="st0" id="Fill-152" points="-2.4,-438.7 0.5,-438.7 0.5,-435.7 -2.4,-435.7    "/><polygon class="st0" id="Fill-153" points="-8.3,-438.7 -5.3,-438.7 -5.3,-435.7 -8.3,-435.7    "/><polygon class="st0" id="Fill-154" points="-14.1,-438.7 -11.2,-438.7 -11.2,-435.7 -14.1,-435.7    "/><polygon class="st0" id="Fill-155" points="9.3,-432.8 12.3,-432.8 12.3,-429.9 9.3,-429.9    "/><polygon class="st0" id="Fill-156" points="3.5,-432.8 6.4,-432.8 6.4,-429.9 3.5,-429.9    "/><polygon class="st0" id="Fill-157" points="-2.4,-432.8 0.5,-432.8 0.5,-429.9 -2.4,-429.9    "/><polygon class="st0" id="Fill-158" points="-8.3,-432.8 -5.3,-432.8 -5.3,-429.9 -8.3,-429.9    "/><polygon class="st0" id="Fill-159" points="-14.1,-432.8 -11.2,-432.8 -11.2,-429.9 -14.1,-429.9    "/></g></g></svg></a></span>
                    <span class="edit edit_user"><i class="fa fa-pen"></i></span>
                </div>
                @endif
                @endif
                <ul class="company-name">
                   <li>
                      @if ($user)
                        @php
                        $experience = $user->experience->where('flag',1)->first();
                        @endphp
                        @if(!is_null($experience))
                        @if(!is_null($experience['logo']))
                        <img src="{{ asset('assets/images/hospital/hospital_logo/'.$experience['logo']) }}" />
                        @endif
                        <p>{{ $experience['name'] }}</p>
                        @endif
                      @endif
                       
                    </li>
                    <li>
                        @if ($user)
                          @php
                          $education = $user->education->where('flag',1)->first();
                          @endphp
                          @if(!is_null($education))
                          @if(!is_null($education['logo']))
                          <img src="{{ asset('assets/images/school/logo/'.$education['logo']) }}" />
                          @endif
                          <p>{{ $education['name'] }}</p>
                          @endif
                        @endif
                      
                    </li>
                </ul>
            </div>
        </div> 
        @endif
        @if ($user && $user->user_status == 0)
        <div class="box-white">
            <h2 class="h2-profile">About
                @if ($user)
                    @if(Auth::check() && Auth::user()->id == $user->id)
                    <span class="span-edit edit_description"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></span>
                    @endif
                @endif
            </h2>
            <p class="p-profile-about">{{ $user ? $user->about : '' }}</p>
        </div>
        
        @endif
        @if ($user && $user->user_status == 1)
       
        <div class="hospital-white">
            <h2 class="hospital_name font-semibold">{{$user->name}}  ( {{$user->hospital->private_public_hospital == 1 ? 'Private Hospital' : 'Public Hospital'}} )</h2>
            <p class="hospital-address">{{$user->address}}</p>
                <div class="avatar-group">
                    <div class="avatar">
                        @foreach ($doctorImage as $profile_image)
                            @foreach ($job_apply as $key=>$job)
                            @if ($profile_image->id == $job->doctor_id)
                             @if (++$key <= 4)
                             <img class="cover-image-size" src="{{isset($profile_image->doctor->profile_image) ? asset('/assets/images/profileImage/'.$profile_image->doctor->profile_image) : asset('assets/images/default.png')}}">
                             @endif
                            @endif
                            @endforeach
                        @endforeach
            </div>
            <a href="{{route('total.doctor.work.list')}}">
             <p>{{count($job_apply)}} peopel work here</p>
            </a>
        </div>
        <div class="col-md-2 review_icon">
            <div class="review-star">
                @if (Auth::user()->user_status == 1)
                <i class="fa fa-star star {{Auth::user()->user_status == 1 ? 'active_review' : ''}}"></i> <h6 class="review_font d-inline-block">5.0</h6><p class="count_review d-inline-block"> ( {{$countReview}} review ) </p> 
                @else
              
                @if ($reviewData && $reviewData->job->created_at->addDays(2) > now())
                <i class="fa fa-star star {{$reviewData && Auth::user()->id == $reviewData->doctor_id && $reviewData->review == 1 ? 'active_review' : ''}}" id="star" data-id="{{Auth::user()->id}}"></i> <h6 class="review_font d-inline-block">5.0</h6> <p class="review_count d-inline-block"> ( {{$countReview}} review ) </p> 
                @endif
                @endif
               
               
            </div>
        </div>
        {{-- </div> --}}
            <div class="row hospital-menu g-0">
                <div class="col-sm-1 jobmenubutton">
                    <a href="#" class="menu-hospital about newsbutton">About</a>
                </div>    
                <div class="col-md-1 hospital-current-job-menu jobmenubutton">
                    <a href="#" class="menu-hospital current-job newsbutton">Current Jobs</a>
                </div>
                <div class="col-md-8 hospital-past-job-menu jobmenubutton">
                    <a href="#" class="menu-hospital menu-past-hospital newsbutton">Past Jobs</a>
                </div>
                <div class="col-md-1">
                        @if(!$user->from_connections->isEmpty())
                            @if ($user->from_connections[0]['status']==1)
                                <div class="pf-connect-btn">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item remove  remove-color" data-flag="1" data-connection_id="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}">Remove Following</a>
                                            <a class="dropdown-item block" data-flag="1" data-connection_id="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}">Block</a>
                                        </div>
                                    </div>
                                    <button class="btn btn-connect message" data-id="{{ $user->id }}">Message</button>
                                </div>
                            @elseif ($user->from_connections[0]['status']==2)
                                <div class="btn btn-primary connect" data-flag="1" data-connection_id="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Connect</span></div>
                            @else
                                <div class="btn accept btn_accept_d" data-flag="1" data-connection_id="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Accept</span></div>
                                <div class="btn remove  btn_remove_d remove-color" data-flag="1" data-connection_id="{{ $user->from_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Reject</span></div>
                            @endif
                        @elseif(!$user->to_connections->isEmpty())
                            @if ($user->to_connections[0]['status']==1)
                                <div class="pf-connect-btn">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item remove  remove-color" data-flag="1" data-connection_id="{{ $user->to_connections[0]['id'] }}" data-id="{{ $user->id }}">Remove Following</a>
                                            <a class="dropdown-item block" data-flag="1" data-connection_id="{{ $user->to_connections[0]['id'] }}" data-id="{{ $user->id }}">Block</a>
                                        </div>
                                    </div>
                                    <button class="btn btn-connect message" data-id="{{ $user->id }}">Message</button>
                                </div>                                                       
                            @elseif ($user->to_connections[0]['status']==2)
                                <div class="btn btn-primary connect" data-flag="1" data-connection_id="{{ $user->to_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Connect</span></div>
                            @else
                                <div class="btn remove" data-flag="1" data-connection_id="{{ $user->to_connections[0]['id'] }}" data-id="{{ $user->id }}"><span class="text-center">Requested</span></div>
                            @endif
                        @else

                            <div class="btn btn-primary connect" data-flag="1" data-id="{{ $user->id }}"><span class="text-center">Connect</span></div>
                        @endif
                </div>
                     <div class="col-md-1 like_icon">
                        <div class="like-heart">
                            <i class="fa fa-star heart {{$likeData && Auth::user()->id == $likeData->user_id && $likeData->like == 1 ? 'active_like' : ''}}" id="heart" data-id="{{Auth::user()->id}}"></i>
                        </div>
                    </div>
            </div>
        </div>
        @endif


        {{-- 
        * Author : Rajvi 
        * Date : 30/04/22
        * add listing of experience 
        --}}
        @if ($user)
        @if($user->user_status==0)
        <div class="box-white">
            <h2 class="h2-profile">Experience
                @if(Auth::user()->id==$user->id)
                    <div class="icon-edu">
                        <span class="span-edit add_experience"><svg height="512px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z"/></svg></span>
                        <span class="span-edit edit_experience"><a href="{{ route('experience.dashboard') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></a></span>
                    </div>
                @endif
            </h2>
            @foreach ($user->experience as $experience)
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
            </div>
            @endforeach
        </div>
        {{-- 
        * Author : Rajvi 
        * Date : 30/04/22
        * end 
        --}}

        {{-- 
        * Author : Rajvi 
        * Date : 2/05/22
        * added education 
        --}}
        <div class="box-white">
            <h2 class="h2-profile">Education 
                @if(Auth::user()->id==$user->id)
                    <div class="icon-edu">
                        <span class="span-edit add_education"><svg height="512px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z"/></svg></span>
                        <span class="span-edit edit_education"><a href="{{ route('education.dashboard') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></a></span>
                    </div>
                @endif
            </h2>
            @foreach ($user->education as $education)
            <div class="detail-exp present">
                <div class="logo-one">
                    @if(!is_null($education->logo))
                    <img width="48" src="{{ url('/assets/images/school/logo/'.$education->logo) }}">
                    @endif
                </div>
                <div class="dt-content">
                    <h6>{{ $education->name }}</h6>
                    <p class="p-course">{{ (!is_null($education->degree)) ? $education->degree : '' }}</p>
                    <p class="year-p">{{ $education->start_date }} - {{ $education->end_date }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @endif

        {{-- 
        * Author : Rajvi 
        * Date : 2/05/22
        * end 
        --}}

        {{--
            * Author : kishan 
            * Date : 29/04/22
            * Dyanmic value for skills and language module
        --}}
        @if ($user && $user->user_status == 0)
        <div class="box-white">
            <h2 class="h2-profile">Skills 
                @if ($user)
                 @if(Auth::user()->id==$user->id)
                  <span class="span-edit edit_skills"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></span>
                 @endif
                @endif
            </h2>
            <div class="ed-inner">
                @if ($user)
                    @if(!$user->skill->isEmpty())
                    <ul class="ul-skills"> 
                        @foreach($user->skill as $skill)                   
                            <li>{{$skill->name}}</li>
                        @endforeach
                    </ul>
                    <div class="show-all"><a href="#">Show all Skills <i class="fa fa-arrow-alt-right"></i></a></div>
                    @endif
                @endif
                
            </div>
        </div>

        <div class="box-white">
            <h2 class="h2-profile">Languages
                @if ($user)
                    @if(Auth::user()->id==$user->id)
                    <span class="span-edit edit_language"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></span>
                    @endif
                @endif
            </h2>
            
            <div class="ed-inner">
                @if ($user)
                    @if(!$user->language->isEmpty())
                    <ul class="ul-skills">
                        @foreach($user->language as $language)
                          <li>{{$language->name}}</li>
                        @endforeach
                    </ul>
                    <div class="show-all"><a href="#">Show all languages <i class="fa fa-arrow-alt-right"></i></a></div>
                    @endif
                @endif
            </div>
        </div>
        @else
        <div class="box-white hospital-about">
            <h2 class="h2-profile">About
                @if ($user)
                    @if(Auth::check() && Auth::user()->id == $user->id)
                    <span class="span-edit edit_description"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></span>
                    @endif
                @endif
            </h2>
            <p class="p-profile-about">{{ $user ? $user->about : '' }}</p>
        </div>
        
        <div class="box-white hospital-current-job" style="display: none">
            @if(Auth::check() && $user && Auth::user()->id==$user->id)
         
            <h2 class="h2-profile">
                @if(Auth::check() && $user && Auth::user()->id==$user->id)
                    <div class="icon-edu">
                        <span class="span-edit add"><a href="{{ route('job.dashboard') }}"><svg height="512px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z"/></svg></a></span>
                        <span class="span-edit edit_job"><a href="{{ route('job.listing') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false"> <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path> </svg></a></span>
                        <span class="job_apply_listing" id="job_apply_listing"><a href="{{ route('job.apply.listing') }}">
                        <svg height="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" width="20px" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                            	<g>
                            		<g>
                            			<path d="M80.844,0c-30.878,0-56,25.122-56,56s25.122,56,56,56s56-25.122,56-56S111.722,0,80.844,0z M80.844,90.667
                            				c-19.116,0-34.667-15.551-34.667-34.667s15.551-34.667,34.667-34.667S115.51,36.884,115.51,56S99.959,90.667,80.844,90.667z"/>
                            			<path d="M476.49,13.333H177.823c-5.89,0-10.667,4.777-10.667,10.667v64c0,5.89,4.776,10.667,10.667,10.667H476.49
                            				c5.89,0,10.667-4.777,10.667-10.667V24C487.156,18.11,482.38,13.333,476.49,13.333z M465.823,77.333H188.49h0V34.667h277.333
                            				V77.333z"/>
                            			<path d="M80.844,133.333c-30.878,0-56,25.122-56,56c0,30.878,25.122,56,56,56s56-25.122,56-56
                            				C136.844,158.456,111.722,133.333,80.844,133.333z M80.844,224c-19.116,0-34.667-15.551-34.667-34.667
                            				c0-19.116,15.551-34.667,34.667-34.667s34.667,15.551,34.667,34.667C115.51,208.449,99.959,224,80.844,224z"/>
                            			<path d="M476.49,146.667H177.823c-5.89,0-10.667,4.776-10.667,10.667v64c0,5.89,4.776,10.667,10.667,10.667H476.49
                            				c5.89,0,10.667-4.776,10.667-10.667v-64C487.156,151.443,482.38,146.667,476.49,146.667z M465.823,210.667H188.49h0V168h277.333
                            				V210.667z"/>
                            			<path d="M80.844,266.667c-30.878,0-56,25.122-56,56s25.122,56,56,56s56-25.122,56-56S111.722,266.667,80.844,266.667z
                            				 M80.844,357.333c-19.116,0-34.667-15.551-34.667-34.667S61.728,288,80.844,288s34.667,15.551,34.667,34.667
                            				S99.959,357.333,80.844,357.333z"/>
                            			<path d="M476.49,280H177.823c-5.89,0-10.667,4.777-10.667,10.667v64c0,5.89,4.776,10.667,10.667,10.667H476.49
                            				c5.89,0,10.667-4.777,10.667-10.667v-64C487.156,284.777,482.38,280,476.49,280z M465.823,344H188.49h0v-42.667h277.333V344z"/>
                            			<path d="M80.844,400c-30.878,0-56,25.122-56,56s25.122,56,56,56s56-25.122,56-56S111.722,400,80.844,400z M80.844,490.667
                            				c-19.116,0-34.667-15.551-34.667-34.667s15.551-34.667,34.667-34.667S115.51,436.884,115.51,456S99.959,490.667,80.844,490.667z"
                            				/>
                            			<path d="M80.844,445.333c-5.884,0-10.667,4.783-10.667,10.667s4.783,10.667,10.667,10.667S91.51,461.884,91.51,456
                            				S86.727,445.333,80.844,445.333z"/>
                            			<path d="M476.49,413.333H177.823c-5.89,0-10.667,4.776-10.667,10.667v64c0,5.89,4.776,10.667,10.667,10.667H476.49
                            				c5.89,0,10.667-4.777,10.667-10.667v-64C487.156,418.11,482.38,413.333,476.49,413.333z M465.823,477.333H188.49h0v-42.667
                            				h277.333V477.333z"/>
                            		</g>
                            	</g>
                            </g>
                      </svg></a>
                      </span>
                    </div>
                @endif
            </h2>
            @endif
            @if (!is_null($jobs))
            @foreach ($jobs as $job)
            <div class="detail-exp present">
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
            </div>
            @endforeach
            @endif
        </div>
        <div class="box-white hospital-past-job" style="display: none">
            @if (!is_null($past_jobs))
            @foreach ($past_jobs as $job)
            <div class="detail-exp present">
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
            </div>
            @endforeach
            @endif
        </div>
        @endif
        
    </div>
</section>


<div class="message-online">
    <a href="#"><svg viewBox="0 0 28 28" alt="" class="a8c37x1j ms05siws l3qrxjdp b7h9ocf4 rs22bh7c" fill="currentColor" height="20" width="20"><path d="M14 2.042c6.76 0 12 4.952 12 11.64S20.76 25.322 14 25.322a13.091 13.091 0 0 1-3.474-.461.956 .956 0 0 0-.641.047L7.5 25.959a.961.961 0 0 1-1.348-.849l-.065-2.134a.957.957 0 0 0-.322-.684A11.389 11.389 0 0 1 2 13.682C2 6.994 7.24 2.042 14 2.042ZM6.794 17.086a.57.57 0 0 0 .827.758l3.786-2.874a.722.722 0 0 1 .868 0l2.8 2.1a1.8 1.8 0 0 0 2.6-.481l3.525-5.592a.57.57 0 0 0-.827-.758l-3.786 2.874a.722.722 0 0 1-.868 0l-2.8-2.1a1.8 1.8 0 0 0-2.6.481Z"></path></svg></a>
</div>


<section class="cta-section">
    <div class="container">
        <h2 class="global-head">Design Your Doctor Resume Online for Free Now</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime molestiae quas vel sint commodi
            repudiandae consequuntur voluptatum laborum.</p>
        <div class="btn-cta"><a href="#" class="btn-dark-blue">get started now</a></div>
    </div>
</section>

 
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/cropperjs/cropper.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyByMhYirwn_EOt2HPNbeWtVE-BVEypa6kI"></script>
    
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/masonry.pkgd.js') }}"></script>
<script src="{{ asset('assets/js/images-grid.js') }}"></script>
<script>

var img = $('#user').val();
if(img){
var items = img.split('|');
}
var images = [];

$.each(items, function(key, value) {
    images.push(aurl+'/assets/images/Thumb/'+value);
});


$('#gallery1').imagesGrid({
    images: images,
    align: true
});
</script>

    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/location_serach.js') }}"></script>
    <script src="{{ asset('assets/plugins/socket.io/socket.io.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/plugins/qs.min.js') }}" integrity="sha512-juaCj8zi594KHQqb92foyp87mCSriYjw3BcTHaXsAn4pEB1YWh+z+XQScMxIxzsjfM4BeVFV3Ij113lIjWiC2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
    {{-- <script type="text/javascript">
        var ip = "{{ $_SERVER['HTTP_X_FORWARDED'] }}";
        alert(ip);
    </script> --}}
    <script>
    $(function (){
        const chatMessages = document.querySelector('.chat-body'); 
        // Scroll down
        chatMessages.scrollTop = chatMessages.scrollHeight;
        let $messageWrapper = $('.messages');
        if ($(".chat-body").length) {
            const sidebarBodyScroll = new PerfectScrollbar(
                ".chat-body"
        );
        }
            $('.status').addClass('user-icon-'+"{{$user ? $user->id : '' }}");
        
        let userID = $('#login_id').val();
        let socket_port = '8005';
        let ip_address = aurl.split("/")[2].toString().split(":")[0]
        let socket = io(ip_address + ':' + socket_port);
        let $chatInput = $(".message_type");
        socket.on('connect', function() {
            socket.emit('user_connected',userID);
        });
        let friendId = "{{$user ? $user->id :'' }}";

        socket.on('updateUserStatus', (data) => {
            let $userStatusIcon = $('.status');
            $userStatusIcon.removeClass('online');
            $userStatusIcon.attr('title', 'Away');
            $.each(data, function (key, val) {
                if (val !== null && val !== 0) {
                    let $userIcon = $(".user-icon-"+key);
                    $userIcon.addClass('online');
                    $userIcon.attr('title','Online');
                }
            });
        });

        $(".message_type").keypress(function (e) {
            let message = $('#chatForm').val();
            if (e.which === 13 && !e.shiftKey) {
                $('#chatForm').val('');
                sendMessage(message);
                return false;
            }
        });

        $('.send_message').on('click',function(event){
            let message = $('#chatForm').val();
            $('#chatForm').val('');
            sendMessage(message);
            return false;

        })
        socket.on("private-channel:App\\Events\\PrivateMessageEvent", function (message){
            if(friendId==message.sender_id){
                appendMessageToReceiver(message);
            }
        });
        function sendMessage(message) {
            
            let url = "{{ route('message.send-message') }}";
            let form = $(this);
            let formData = new FormData();
            let token = "{{ csrf_token() }}";

            formData.append('message', message);
            formData.append('_token', token);
            formData.append('receiver_id', friendId);
            formData.append('socket_id', socket.id);
            appendMessageToSender(message);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function (response) {
                    if (response.success) {
                    }
                }
            });
        }

        function formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }

        function appendMessageToSender(message) {
            let name = '{{ $myInfo->first_name }}';
            let image = '{{ $myInfo->profile }}';
            let userInfo = '<li class="message-item me">\n' +
                        '<img src="'+image+'" class="img-xs rounded-circle" alt="avatar">\n' +
                        '<div class="content">\n' +
                            '<div class="message">\n' +
                            '<div class="bubble"><p>'+message+'</p></div>\n' +
                            '<span>'+formatAMPM(new Date)+'</span>\n' +
                            '</div>\n' +
                        '</div>\n' +
                        '</li>';
            $messageWrapper.append(userInfo);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
        socket.on("private-channel:App\\Events\\PrivateMessageEvent", function (message){
            if(friendId==message.sender_id){
                appendMessageToReceiver(message);
            }else if(userID==message.sender_id){
                appendMessageToSender(message.content);
            }
        });
        function appendMessageToReceiver(message) {
            let name = '{{ $user ? $user->name : ''}}';
            let image = '{{$user ? $user->image : ''}}';
            let url_ = image=='' ? '{{ url("assets/images/default.png") }}' : '{{ url("assets/images/admin_users/admin_users_profile_photo/") }}/'+image;
            let userInfo = '<li class="message-item friend">\n' +
                        '<img src="'+url_+'" class="img-xs rounded-circle" alt="avatar">\n' +
                        '<div class="content">\n' +
                            '<div class="message">\n' +
                            '<div class="bubble"><p>'+message.content+'</p></div>\n' +
                            '<span>'+formatAMPM(new Date)+'</span>\n' +
                            '</div>\n' +
                        '</div>\n' +
                        '</li>';
            $messageWrapper.append(userInfo);
        }
            
    });
    </script>
    
    {{-- Active tab--}}
    <script>
        $(document).on('click', '.newsbutton', function() {
          $( ".jobmenubutton .menu-hospital" ).each(function( index ) {
            $(this).removeClass('active');
          });
            $(this).toggleClass("active");
        });
    </script>

    
@endpush
