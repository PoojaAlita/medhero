@extends('layouts.master')

@section('pageTitle', 'About')

@section('content')
<section class="innerpage-banner">
    <div class="container">
        <div class="bi-content">
            <h1>About Us</h1>
        </div>
    </div>
</section>

<section class="sec-why">
    <div class="container">
        <div class="why-inner flex">
            <div class="why-l">
                <div class="img-w"><img src="{{asset('images/infographic.svg')}}" alt="img-medical" /></div>
            </div>
            <div class="why-r">
                <h4 class="h4-small">About Company</h4>
                <h2 class="global-head s-head">Our mission is to help job seekers grow careers.<span>We love helping people stand out in their job search and get hired faster.</span></h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing harum elit Maxime mollitia molestiae quas vel commodi repudiandae an consequuntur voluptatum laborum quisquam.</p>
            </div>
        </div>
    </div>
</section>

<section class="section-detail">
    <div class="container">
        <div class="detail-inner">
            <h4 class="h4-small">Few details</h4>
            <h2 class="global-head s-head">At medhero, we believe that building a job-worthy resume should be a fast and simple process. In fact, we've always been about building systems that are quick and easy-to-use, yet consistently get good results.
            </h2>
            <p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum test</p>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <h2 class="global-head">Design Your Doctor Resume  Online for Free Now</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum.</p>
        <div class="btn-cta"><a href="#" class="btn-dark-blue">get started now</a></div>
    </div>
</section>

@endsection