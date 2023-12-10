@extends('layouts.master')

@section('pageTitle', 'Contact')

@section('content')

<section class="innerpage-banner">
    <div class="container">
        <div class="bi-content">
            <h1>Contact Us</h1>
        </div>
    </div>
</section>

<section class="section-form">
    <div class="container">
        <div class="form-inner">
            <p class="p-contact">Do you have a question, remark, complaint, or suggestion? Please first read the <a href="#">frequently asked questions</a> before contacting us. If your question remains unanswered, use the form below.</p>
            <form class="form-contact">
                <div class="frm-grp">
                    <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="frm-grp">
                    <input type="email" class="form-control" placeholder="Email address">
                </div>
                <div class="frm-grp">
                    <input type="number" class="form-control" placeholder="Phone number">
                </div>
                <div class="frm-grp">
                    <textarea class="form-control" placeholder="Question or remark"></textarea>
                 </div>
            </form>
        </div>
    </div>
</section>

<section class="sec-map">
    <div class="container">
        <div id="map"></div>
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