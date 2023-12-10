@extends('layouts.master')

@section('pageTitle', 'FAQ')

@section('content')

<section class="innerpage-banner">
     <div class="container">
        <div class="bi-content">
            <h1>Frequently asked questions</h1>
        </div>
    </div>
</section>

<section class="faq-wrapper">
    <div class="container">
        
    <div class="accordian-wrapper">
        <div class="accordian-content">
            <div class="question">How do I login?</div>
            <div class="answercont">
                <div class="answer">
                    <p>By logging in via the top right corner on the website, you will get access to your account. In case you have forgotten your password, you can request a new one <a href="#">here</a>.</p>
                </div>
            </div>
        </div>
        <div class="accordian-content">
            <div class="question">How do I create an account?</div>
            <div class="answercont">
                <div class="answer">
                    <p>In order for you to use all the features, you will be asked to create an account by filling in your email address. After that it is possible to create a password. You can then use these details to log into your account. If you have forgotten your password, you can request a new one <a href="#">here</a>.</p>
                </div>
            </div>
        </div>
        <div class="accordian-content">
            <div class="question">What are the costs?</div>
            <div class="answercont">
                <div class="answer">
                    <p>On <a href="#">this</a> you can find information on the costs.</p>
                    <p>After completing the payment, your resume, cover letter and/or the other services will immediately be delivered to you digitally. This means your right to revoke is not applicable here.</p>
                    <p>After completing the payment, your resume, cover letter and/or the other services will immediately be delivered to you digitally. This means your right to revoke is not applicable here.</p>
                    <p>In addition, you are signing up for a subscription which allows you access to your account and the unlimited use of all features such as the creating and modifying of your resumes, the generating of cover letters, searching for and viewing of relevant vacancies and keeping track of your applications. The first 14 days are free of charge, after that, a monthly invoice will be sent to you. Your right to revoke does apply to the subscription. Because the subscription is free of charge for the first 14 days, you will not receive a refund after using your right to revoke on the subscription. You can cancel your subscription at any time in your account. In addition, you can let us know that you would like to use your right to revoke the subscription within 14 days of signing up. You may use the standard revoke form, but this is not mandatory.</p>
                </div>
            </div>
        </div>
        <div class="accordian-content">
            <div class="question">How do I import a resume?</div>
            <div class="answercont">
                <div class="answer">
                    <p>You can import an existing resume by using the 'Import' button in the top right corner of the editor. Select a resume (PDF or Word) and the file will automatically be copied into the fields. Filled out fields will automatically be overwritten with the content of the imported document. The fields must be checked afterwards for completeness and correctness.</p>
                </div>
            </div>
        </div>
        <div class="accordian-content">
            <div class="question">Where can I view my receipt?</div>
            <div class="answercont">
                <div class="answer">
                    <p>Login and click on your profile icon to go to 'Settings'. Click on 'Payment History' to view your payment receipts. The receipt also serves as your invoice.</p>
                </div>
            </div>
        </div>
        <div class="accordian-content">
            <div class="question">How do I delete my data?</div>
            <div class="answercont">
                <div class="answer">
                    <p>Login and click on the profile icon to go to 'Settings'. Click on 'Delete account' to permanently delete your account.</p>
                    <p>If you have not activated an account and only entered your details, these will automatically be deleted within 30 days.&nbsp;</p>
                </div>
            </div>
        </div>
        <div class="accordian-content">
            <div class="question">How do I cancel my subscription?</div>
            <div class="answercont">
                <div class="answer">
                    <p>Log in and click on your profile icon and go to 'Settings'. Use the 'Cancellation' button to cancel your subscription. You will automatically receive a confirmation by email.</p>
                </div>
            </div>
        </div>
        <div class="accordian-content">
            <div class="question">How can I add or remove a photo?</div>
            <div class="answercont">
                <div class="answer">
                    <p>You can upload a photo in the designated block in the top left corner of the editor. You can drag the photo, zoom in or out and rotate it to the desired position. Adding a photo is not mandatory and you can always change or delete it afterwards.</p>
                </div>
            </div>
        </div>
        <div class="accordian-content">
            <div class="question">How can I download my resume or cover letter?</div>
            <div class="answercont">
                <div class="answer">
                    <p>Click on ‘download’ in the editor or in your account under the tab ‘Resumes’ or ‘Cover letters’. In case you do not yet have a paid account, or you have not yet logged in, you will need to first follow all the steps on the screen. You will then be able to download the document as a pdf. At this time, Word is not available.</p>
                </div>
            </div>
        </div>
        <div class="accordian-content">
            <div class="question">How do I change to another language?</div>
            <div class="answercont">
                <div class="answer">
                    <p>The language option in the top right corner allows you to set the editor to another language. The text in the document will then automatically be translated into the newly selected language. The text you fill in in the boxes will need to be translated by you.</p>
                </div>
            </div>
        </div>
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