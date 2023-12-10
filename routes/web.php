<?php

use App\Http\Controllers\Auth\{AuthenticatedSessionController,RegisteredUserController};
use App\Http\Controllers\frontend\{ProfileController,JobApplicationController,CalendarController};
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\{HospitalController,DoctorController,InquiryController,ChangePasswordController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get(
    'cache-clear',
    function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');
        Artisan::call('config:cache');
        return 'cleared';
    }
);

/* Admin Route */
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');
require __DIR__.'/adminauth.php';

/*Hospital & Doctor Routes*/
Route::group(['prefix' => 'admin','middleware' => 'auth:admin'], function () {
    /*Inquiry Route*/    
    Route::get('/inquiry', [InquiryController::class, 'index'])->name('inquiry.dashboard');
    Route::post('/inquiry/listing', [InquiryController::class, 'listing']);
    /*Hospital Route*/
    Route::get('/hospital', [HospitalController::class, 'index'])->name('hospital.dashboard');
    Route::post('/hospital/store', [HospitalController::class, 'store']);
    Route::post('/hospital/listing', [HospitalController::class, 'listing']);
    Route::post('/hospital/edit', [HospitalController::class, 'edit']);
    Route::post('/hospital/delete', [HospitalController::class, 'delete']);
    Route::post('validate-email',[HospitalController::class,'validate_email']);   

    /*Doctor Route*/
    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor.dashboard');
    Route::post('/doctor/listing', [DoctorController::class, 'listing']);
    Route::get('/doctor/approval',[DoctorController::class, 'approval']);
    Route::post('/doctor/reject',[DoctorController::class, 'reject']);

});

 /* Change Password Routes */
 Route::group(['prefix' => 'Change-Password','middleware' => 'auth'], function(){ 
    Route::get('/',[ChangePasswordController::class,'index'])->name('changePassword.dashboard');
    Route::post('/store',[ChangePasswordController::class,'store'])->name('changePassword.store');
    });
 /*Check Availability Of Email Route*/   
 Route::post('validate-email',[RegisteredUserController::class,'validate_email']);  
 
 /*Job Application Route*/
 Route::group(['prefix' => 'Job-Application','middleware' => 'auth'],function(){
    Route::get('index/{id}{job_id}',[JobApplicationController::class,'index'])->name('jobApplication.dashboard');
    Route::post('/store',[JobApplicationController::class,'store'])->name('jobApplication.store');
    Route::post('/edit',[JobApplicationController::class,'edit'])->name('jobApplication.edit');
    Route::post('/delete',[JobApplicationController::class,'delete']);
    Route::post('/offer',[JobApplicationController::class,'offer']);
    Route::post('/accept-offer',[JobApplicationController::class,'accept_offer']);
    Route::post('/reject-offer',[JobApplicationController::class,'reject_offer']);
 });


/* profile routes */
Route::group(['prefix' => 'profile','middleware' => 'auth'], function () {
    /*
        * Author : Rajvi 
        * Date : 29/04/22
        * Added experience route
    */
    // profile dashboard
    Route::post('/user', [ProfileController::class, 'user']);
    Route::post('/user/data', [ProfileController::class, 'user_data']);
    // about routes
    Route::post('/about', [ProfileController::class, 'about']);
    // experience routes
    Route::get('/experience', [ProfileController::class, 'experience_listing'])->name('experience.dashboard');
    Route::post('/experience', [ProfileController::class, 'experience_store']);
    Route::post('/experience/data', [ProfileController::class, 'experience_data']);
    /*
        * Author : Rajvi 
        * Date : 29/04/22
        * End
    */
   
    // * Author : Rajvi 
    // * Date : 2/05/22
    // * added education 
    // education routes
    Route::get('/education', [ProfileController::class, 'education_listing'])->name('education.dashboard');
    Route::post('/education', [ProfileController::class, 'education_store']);
    Route::post('/education/data', [ProfileController::class, 'education_data']);
    // * Author : Rajvi 
    // * Date : 2/05/22
    // * end

     /*Job Post Route*/
     Route::get('/job', [ProfileController::class, 'job_listing'])->name('job.listing');
     Route::get('/job/view',[ProfileController::class, 'job_view'])->name('job.dashboard');
     Route::post('/job/store', [ProfileController::class, 'job_store']);
     Route::post('/job/update', [ProfileController::class, 'job_update']);
     Route::post('/job/delete', [ProfileController::class, 'job_delete']);
     Route::get('/job/apply/listing', [ProfileController::class, 'job_apply_listing'])->name('job.apply.listing');

     Route::post('like', [ProfileController::class, 'like'])->name('like');
     Route::post('review', [ProfileController::class, 'review'])->name('review');

     /*Total Doctor Work Listing Route */
     Route::get('total-doctor-work-list', [ProfileController::class, 'total_doctor_work_list'])->name('total.doctor.work.list');


    // * Author : Rajvi 
    // * Date : 4/05/22
    // * delete education and experience

    // delete education and experience routes
    Route::post('/experience/delete', [ProfileController::class, 'experience_delete']);
    Route::post('/education/delete', [ProfileController::class, 'education_delete']);
   

    // * Author : Rajvi 
    // * Date : 4/05/22
    // * end

    // * Author : Rajvi 
    // * Date : 29/06/22
    // * cover photo added

    // storing cover photo
    Route::post('/cover/store', [ProfileController::class, 'cover_store']);
    Route::post('/profile/delete', [ProfileController::class, 'profile_delete']);


    // * Author : Rajvi 
    // * Date : 29/06/22
    // * end
   

    /*
        * Author : kishan 
        * Date : 29/04/22
        * Added routes for skills and language
    */
    Route::post('/skills', [ProfileController::class, 'skill']);
    Route::post('/languages', [ProfileController::class, 'language']);
    /*
        * Author : kishan 
        * Date : 29/04/22
        * end
    */
    Route::get('/{token}', [ProfileController::class, 'index'])->name('profile.dashboard');
   });



/* Searching Routes */
Route::post('/search', [ProfileController::class, 'search']);
/* connect routes */
Route::post('/connect', [ProfileController::class, 'connect']);

/* chat routes */
Route::get('/chat', [MessageController::class,'index'])->name('chat');
Route::post('/chatToOne', [MessageController::class,'chatToOne']);
Route::post('send-message', [MessageController::class,'sendMessage'])
    ->name('message.send-message');
Route::get('/chat/{id}', [MessageController::class,'conversation'])->name('message.conversation');

/* getting users */
Route::post('/getUser', [MessageController::class,'getUser']);

/* calendar routes */
Route::get('full-calender', [CalendarController::class, 'index'])->name('calendar');
Route::post('full-calender/action', [CalendarController::class, 'action']);
Route::post('full-calender/action/delete', [CalendarController::class, 'delete']);
Route::post('full-calender/data', [CalendarController::class, 'data']);
Route::post('full-calender/check_event', [CalendarController::class, 'check_event']);

/* google login routes */
    Route::get('google',function(){

    return view('googleAuth');
    
    });
    
    Route::get('/auth/google', [AuthenticatedSessionController::class, 'redirectToGoogle'])->name('google');
    Route::get('/auth/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback']);

Route::get('/', function () {
        return view('welcome');
})->name('welcome');

Route::get('about', function () {
    return view('layouts.about');
})->name('about');

Route::get('contact', function () {
    return view('layouts.contact');
})->name('contact');

Route::get('pricing', function () {
    return view('layouts.pricing');
})->name('pricing');

Route::get('faq', function () {
    return view('layouts.faq');
})->name('faq');

Route::get('privacy-policy', function () {
    return view('layouts.privacy-policy');
})->name('privacy-policy');

Route::get('terms-condition', function () {
    return view('layouts.terms-condition');
})->name('terms-condition');

Route::get('/dashboard', function () {
    return view('layouts.Admin.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/* Route For Redirecting While 404 */
Route::any('{url}', function () {
    return redirect('/');
})->where('url', '.*');

