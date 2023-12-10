@extends('layouts.master')

@section('pageTitle', 'Home')
@section('content')

<section class="banner-cstm">
    <div class="container">
        <div class="banner-full flex">
            <div class="banner-l">
                <h1>Hospital. Doctor. Jobs.Connect.</h1>
                <p>A medical doctor CV? A junior doctor CV?
                    A surgeon or physician resume? Be it any
                    type of doctor resume. Try Medhero</p>
                <div class="btn-banner"><a href="#" class="btn-white">get started now</a></div>    
            </div>
            <div class="banner-r">
                <div class="banner-img">
                    <img src="{{asset('images/banner-img.png')}}" alt="banner-img" class="img-banner"/>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sec-searchbar">
    <div class="container">
        <div class="searchbar {{ (auth()->user()) ? (auth()->user()->user_status==0) ? 'doctor_searchbar' : 'hospital_searchbar' : '' }} flex">
            <div class="div-scbar flex">    
                <form action="#" class="form-inline" method="POST" id="search_form">
                    <div class="input-s">
                        <label>Location</label> 
                        <input type="text" id="address" name="location" class="input-sr {{ (auth()->user()) ? (auth()->user()->user_status==0) ? 'doctor_searchbar' : 'hospital_searchbar' : '' }}" placeholder="Where would you like to work?" autocomplete="on">
                        <input type="hidden" value=""  name="latitude" id="lat"  placeholder="Latitude">
                        <input type="hidden" value="" name="longitude" id="lng" placeholder="Longitude">
                    </div>
                    <div class="input-s i-date">
                        <label>Start Date</label>
                        <input type="text" id="" name="start_date" class="input-sr {{ (auth()->user()) ? (auth()->user()->user_status==0) ? 'doctor_searchbar' : 'hospital_searchbar' : '' }}" placeholder="Add Date">
                    </div>
                    <div class="input-s i-date">
                        <label>End Date</label>
                        <input type="text" id="" name="end_date" class="input-sr {{ (auth()->user()) ? (auth()->user()->user_status==0) ? 'doctor_searchbar' : 'hospital_searchbar' : '' }}" placeholder="Add Date">
                    </div>
                    <div class="input-s">
                        <label>Type Of Work</label>
                        <input type="text" id="" name="type_work" class="input-sr {{ (auth()->user()) ? (auth()->user()->user_status==0) ? 'doctor_searchbar' : 'hospital_searchbar' : '' }}" placeholder="Work">
                    </div>
                </form>
            </div>
            <div class="btn-sr">
                <button class="search_button" ><svg enable-background="new 0 0 32 32" id="Glyph" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M27.414,24.586l-5.077-5.077C23.386,17.928,24,16.035,24,14c0-5.514-4.486-10-10-10S4,8.486,4,14  s4.486,10,10,10c2.035,0,3.928-0.614,5.509-1.663l5.077,5.077c0.78,0.781,2.048,0.781,2.828,0  C28.195,26.633,28.195,25.367,27.414,24.586z M7,14c0-3.86,3.14-7,7-7s7,3.14,7,7s-3.14,7-7,7S7,17.86,7,14z" id="XMLID_223_"/></svg></button>
            </div>
        </div>
        <div class="row search_main">
            <div class="col-md-6 search_result">
                
            </div>
             {{--Googel map html--}}   
            <div class=" col-md-6 google-map-show mt-3" style="display: none ">
                <div class="googel-map mb-5">
                   <div id="map">
                   </div>
                </div>
            </div>
        </div>
       
    
    </div>
</section>

<section class="sec-steps">
    <div class="container">
        <div class="row row-steps">
            <div class="col-md-4">
                <div class="box-step">
                    <div class="img-box"><span class="svg-stoke"><img src="{{ asset('images/profile.png') }}"/></span></div>
                    <h3>Profile</h3>
                    <p>Create your profile as a Hospital or as a Doctor and start searching.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-step">
                    <div class="img-box"><span><img src="{{ asset('images/match.png') }}" /></span></div>
                    <h3>Find Your Match</h3>
                    <p>Browse our extesnsion list to find the best match for you.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-step">
                    <div class="img-box"><span><img src="{{ asset('images/doc.png') }}" /></span></div>
                    <h3>Work Together</h3>
                    <p>Once matched Hospitals & Doctor, start work Together </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sec-box-one">
    <div class="container">
        <div class="bs-hero flex">
            <div class="bs-l">
                <div class="bs-inner">
                <h2 class="global-head s-head">Why Buisness<span>Truns in to MEDHERO</span></h2>
                <ul class="ul-dc">
                    <li>
                        <span><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 14 14" role="img"><path fill-rule="evenodd" d="M9.933 8.63c.011-1.221-.748-1.903-2.476-2.332V4.03c.53.11 1.057.374 1.574.748l.627-1.023a4.357 4.357 0 00-2.157-.87v-.692h-.967v.67c-1.43.112-2.399.948-2.399 2.168v.023c0 1.276.771 1.89 2.443 2.32v2.333c-.759-.121-1.386-.473-2.036-1.012l-.704 1a5.148 5.148 0 002.696 1.145v1.144h.967v-1.122c1.453-.131 2.432-.957 2.432-2.211V8.63zM14 7A7 7 0 110 7a7 7 0 0114 0zm-6.543.585v2.167c.76-.077 1.19-.451 1.19-1.023v-.022c0-.517-.265-.848-1.19-1.122zm-.879-3.62v2.112c-.936-.285-1.156-.604-1.156-1.11v-.012c-.01-.516.407-.913 1.156-.99z"></path></svg></span>
                        <h4>Vetted Doctor</h4>
                        <p>Check any pro’s work samples, client reviews, and identity verification.</p>
                    </li>
                    <li>
                        <span><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 14 14" role="img"><path fill-rule="evenodd" d="M9.933 8.63c.011-1.221-.748-1.903-2.476-2.332V4.03c.53.11 1.057.374 1.574.748l.627-1.023a4.357 4.357 0 00-2.157-.87v-.692h-.967v.67c-1.43.112-2.399.948-2.399 2.168v.023c0 1.276.771 1.89 2.443 2.32v2.333c-.759-.121-1.386-.473-2.036-1.012l-.704 1a5.148 5.148 0 002.696 1.145v1.144h.967v-1.122c1.453-.131 2.432-.957 2.432-2.211V8.63zM14 7A7 7 0 110 7a7 7 0 0114 0zm-6.543.585v2.167c.76-.077 1.19-.451 1.19-1.023v-.022c0-.517-.265-.848-1.19-1.122zm-.879-3.62v2.112c-.936-.285-1.156-.604-1.156-1.11v-.012c-.01-.516.407-.913 1.156-.99z"></path></svg></span>
                        <h4>No Cost Until you are hire</h4>
                        <p>Interview potential fits for your job, negotiate rates, and only pay for work you approve.</p>
                    </li>
                    <li>
                        <span><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 14 14" role="img"><path fill-rule="evenodd" d="M14 7A7 7 0 110 7a7 7 0 0114 0zm-7.23 4.275l4.889-7.11-1.65-1.133-3.676 5.35L3.75 6.346l-1.238 1.57 4.257 3.359z"></path></svg></span>
                        <h4>Vetted Doctor</h4>
                        <p>Focus on your work knowing we help protect your data and privacy. We’re here with 24/7 support if you need it.</p>
                    </li>
                </ul>
                </div>
            </div>
            <div class="bs-r">
                <div class="work-gen">
                    <div class="work-gen-inner">
                        <h4>Australia's first self-service medical recruitment portal.</h4>
                        <p><span class="span-w"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title/><g data-name="Layer 2" id="Layer_2"><path d="M16,29A13,13,0,1,1,29,16,13,13,0,0,1,16,29ZM16,5A11,11,0,1,0,27,16,11,11,0,0,0,16,5Z"/><path d="M21.5,22.5a1,1,0,0,1-.71-.29l-5.5-5.5A1,1,0,0,1,15,16V8a1,1,0,0,1,2,0v7.59l5.21,5.2a1,1,0,0,1,0,1.42A1,1,0,0,1,21.5,22.5Z"/></g><g id="frame"><rect class="cls-1" height="32" width="32"/></g></svg></span>Connecting Hospital and Doctors by 24/7</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-network">
    <div class="container">
        <h2 class="global-head">Join Our Extesnsion network of medical professinoals</h2>
        <div class="testmonial-wrapper">
            <ul class="tabs tab_panel_new">
                <li class="active" rel="tab1">Samantha</li>
                <li rel="tab2">Emily</li>
                <li rel="tab3">Brendon</li>
              </ul>
              <div class="tab_container tab_content_new">
                <h3 class="tab_drawer_heading" rel="tab1">php</h3>
                <div id="tab1" class="tab_content" style="">
                    <div class="profile-info-cstm flex">
                        <div class="picf-l">
                            <div class="img-picf"><img src="{{ asset('images/doc-one.png') }}"/></div>
                        </div>
                        <div class="picf-r">
                            <div class="picf-content">
                                <h4>Samantha</h4>
                                <p>specialist: surgeon,M.D</p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                                <div class="rev-c">
                                    <h6>WHAT THE REVIEW SAY</h6>
                                    <P>Very nice and caring in trying circumantences.</P>
                                </div>
                                <div class="rev-c">
                                    <h6>Reviews</h6>
                                    <span class="span-star">
                                        <b><i class="fa fa-star"></i></b>
                                        <b><i class="fa fa-star"></i></b>
                                        <b><i class="fa fa-star"></i></b>
                                        <b><i class="fa fa-star"></i></b>
                                        <b><i class="fa fa-star"></i></b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <h3 class="tab_drawer_heading" rel="tab2">Emily</h3>
              <div id="tab2" class="tab_content" style="display: none;">
                <div class="profile-info-cstm flex">
                    <div class="picf-l">
                        <div class="img-picf"><img src="{{ asset('images/doc1.png') }}"/></div>
                    </div>
                    <div class="picf-r">
                        <div class="picf-content">
                            <h4>Emily</h4>
                            <p>specialist: surgeon,M.D</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            <div class="rev-c">
                                <h6>WHAT THE REVIEW SAY</h6>
                                <P>Very nice and caring in trying circumantences.</P>
                            </div>
                            <div class="rev-c">
                                <h6>Reviews</h6>
                                <span class="span-star">
                                    <b><i class="fa fa-star"></i></b>
                                    <b><i class="fa fa-star"></i></b>
                                    <b><i class="fa fa-star"></i></b>
                                    <b><i class="fa fa-star"></i></b>
                                    <b><i class="fa fa-star"></i></b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <h3 class="tab_drawer_heading" rel="tab3">Brendon</h3>
              <div id="tab3" class="tab_content " style="display: none;">
                <div class="profile-info-cstm flex">
                    <div class="picf-l">
                        <div class="img-picf"><img src="{{ asset('images/doc2.png') }}"/></div>
                    </div>
                    <div class="picf-r">
                        <div class="picf-content">
                            <h4>Brendon</h4>
                            <p>specialist: surgeon,M.D</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            <div class="rev-c">
                                <h6>WHAT THE REVIEW SAY</h6>
                                <P>Very nice and caring in trying circumantences.</P>
                            </div>
                            <div class="rev-c">
                                <h6>Reviews</h6>
                                <span class="span-star">
                                    <b><i class="fa fa-star"></i></b>
                                    <b><i class="fa fa-star"></i></b>
                                    <b><i class="fa fa-star"></i></b>
                                    <b><i class="fa fa-star"></i></b>
                                    <b><i class="fa fa-star"></i></b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial jobs-tet">
    <div class="container">
        <h2 class="global-head">Jobs to start with</h2>
        <div class="testimonial-slider">
            <div class="owl-carousel owl-theme" id="owl-testimonial">
                <div class="item">
                    <div class="hsp-inner">
                        <div class="img-hsp"><img src="{{ asset('images/j1.png') }}"/></div>
                        <h4>Medical Assoication of Australia</h4>
                        <p> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the</p>
                        <div class="read-more"><a href="#">Read More</a></div>
                    </div>
                </div>
                <div class="item">
                    <div class="hsp-inner">
                        <div class="img-hsp"><img src="{{ asset('images/j2.png') }}"/></div>
                        <h4>Medical Assoication of Australia</h4>
                        <p> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the</p>
                        <div class="read-more"><a href="#">Read More</a></div>
                    </div>
                </div>
                <div class="item">
                    <div class="hsp-inner">
                        <div class="img-hsp"><img src="{{ asset('images/j3.png') }}"/></div>
                        <h4>Medical Assoication of Australia</h4>
                        <p> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the</p>
                        <div class="read-more"><a href="#">Read More</a></div>
                    </div>
                </div>
                <div class="item">
                    <div class="hsp-inner">
                        <div class="img-hsp"><img src="{{ asset('images/j2.png') }}"/></div>
                        <h4>Medical Assoication of Australia</h4>
                        <p> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the</p>
                        <div class="read-more"><a href="#">Read More</a></div>
                    </div>
                </div>
                <div class="item">
                    <div class="hsp-inner">
                        <div class="img-hsp"><img src="{{ asset('images/j1.png') }}"/></div>
                        <h4>Medical Assoication of Australia</h4>
                        <p> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the</p>
                        <div class="read-more"><a href="#">Read More</a></div>
                    </div>
                </div>
                <div class="item">
                    <div class="hsp-inner">
                        <div class="img-hsp"><img src="{{ asset('images/j3.png') }}"/></div>
                        <h4>Medical Assoication of Australia</h4>
                        <p> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the</p>
                        <div class="read-more"><a href="#">Read More</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sec-numbers">
    <div class="container">
        <ul class="ul-num">
            <li>
                <span>120+<b>Hospitals</b></span>
            </li>
            <li>
                <span>1000+<b>Doctors</b></span>
            </li>
            <li>
                <span>800+<b>Placements</b></span>
            </li>
            <li>
                <span>1200+<b>Jobs</b></span>
            </li>
        </ul>
    </div>
</section>

@endsection
@push('plugin-scripts')

{{-- Googel Map Code --}}

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyByMhYirwn_EOt2HPNbeWtVE-BVEypa6kI"></script>
@endpush
@push('custom-scripts')
  <script src="{{ asset('assets/js/location_serach.js') }}"></script>
  <script src="{{ asset('assets/js/profile.js') }}"></script>
@endpush