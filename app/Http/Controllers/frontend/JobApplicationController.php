<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{JobApplication,User,JobPost,Admin};
use Illuminate\Support\Facades\{Mail,Auth};


class JobApplicationController extends Controller
{
     /*Dashboard Of Job Application*/
     public function index($id,$job_id)
     {
    
        $data['hospitalData'] = User::where('status',1)->where('id',$id)->first();
        $data['jobDetails'] = JobPost::where('status',1)->where('id',$job_id)->first(['id','title','hourly_rate','description']);
        $data['job_application']= JobApplication::with('User','job')->where('doctor_id',Auth::user()->id)->where('status',1)->where('job_id',$job_id)->first();
        if($data['job_application'] && $data['job_application']->flag == 1 && $data['job_application']->job_id == $data['jobDetails']->id){
                return view('layouts.job_application_listing',compact('data'));
            }else{
                return view('layouts.job_application',compact('data'));
            }
   
     }

     //Storing And Updating Data Of row
     public function store(Request $request)
     {
         try {
                $jobApply = jobApplication::where('job_id',$request->job_post_id)->where('doctor_id',Auth::user()->id)->first();

                if($jobApply && $jobApply->status == 0 && $jobApply->job_id == $request->job_post_id){
                    $JobApplicationData = jobApplication::where('doctor_id',$request->doctor_id)->where('job_id',$request->job_post_id)->update([
                        'user_id' => $request->user_id,
                        'doctor_id' => $request->doctor_id,
                        'job_id' => $request->job_post_id,
                        'offer' =>$request->offer, 
                        'status'=>1,
                    ]);
                }else{
                    $JobApplicationData = JobApplication::updateOrCreate([
                        'id'=>$request->id,
                    ],
                        [
                        'user_id' => $request->user_id,
                        'doctor_id' => $request->doctor_id,
                        'job_id' => $request->job_post_id,
                        'offer' =>$request->offer, 
                     ]);
                } 
      
              //Send mail with attach file
                $data['hospital'] = User::where('id',$request->user_id)->first();
                $email = $data['hospital']->email;
                $data['jobDetails'] = JobPost::where('status',1)->where('id',$request->job_post_id)->first(['id','title','hourly_rate','description']);
                $data['user'] =Auth::user();
                $data = ['data' => $data]; 
               
             $user['to'] =$email;
              Mail::send('layouts.job_mail',['data' => $data], function ($messages) use ($user) {
                 $messages->to($user['to']);
                 $messages->subject('Application for Job Apply');
             });
           
             if($jobApply && $jobApply->flag == 1){
                if($request->hospital_id){
                    $redirectUrl = $JobApplicationData ? 'Job-Application/index/'.$request->hospital_id.$request->job_id:'/'; 
                }else{
                    $redirectUrl = $JobApplicationData ? '/' : '';    
                }
             }else{
                $redirectUrlJob = $JobApplicationData->flag == 1 ? 'Job-Application/index/'.$request->hospital_id.$request->job_id:'/'; 
             }
             $response = [
                 'status' => true,
                 'message' => 'Job Apply '.($request->id == 0 ? 'Added' : 'Updated').' Successfully',
                 'icon' => 'success',
                 'redirect_url' => $jobApply && $jobApply->flag == 1 ? $redirectUrl : $redirectUrlJob,

             ];
         } catch (\Throwable $e) {
             $response = [
                 'status' => false,
                 'message' => 'Something Went Wrong! Please Try Again.',
                 'icon' => 'error',
             ];
         }
         return response($response);
     }


     public function edit(Request $request){
        try {
             
            $data= JobApplication::with('User','job')->where('id',$request->id)->where('status',1)->first();
            
            if(!is_null($data) ){
                $response = [
                    'data'=>$data,
                    'status'=>true,
                ];
            }
        }catch (\Throwable $e) {
            $response = [
                'status' => false,
                'message' => "Something Went Wrong! Please Try Again.",
                'icon' => 'error',
            ];
        }
        return response($response);

     }


    //Remove Data Of Job Apply
    public function delete(Request $request)
    {
        try {
             $update['status']=0;

            JobApplication::where('id',$request->id)->update($update);
            $data['job_apply'] = JobApplication::where('id',$request->id)->with('User')->first();
            //Send mail with attach file
            $email = $data['job_apply']->User->email;
            $user['to'] =$email;
             Mail::send('layouts.withdraw_mail',['data' => $data], function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Withdraw Job Apply');
            });
            $response = [
                'status' => true,
                'message' => "Job Apply Data Withdraw Successfully",
                'icon' => 'success',
                'redirect_url' =>'/'
            ];
        }catch (\Throwable $e) {
            dd($e);
            $response = [
                'status' => false,
                'message' => "Something Went Wrong! Please Try Again.",
                'icon' => 'error',
            ];
        }
        return response($response); 
    }

    /*Send Offer Form Mail*/
    public function offer(Request $request){
    try {  
      $data['job_apply_data'] = JobApplication::where('id',$request->id)->first();
      $data['user'] = User::where('id',$data['job_apply_data']->doctor_id)->first();
      $data['job_post'] = JobPost::where('id',$data['job_apply_data']->job_id)->first();
      $email = $data['user']->email; 
      $offer_accept = $data['job_apply_data']['offer_accept'];


       //Send mail with attach file
       $data['name']= Auth::user()->name;
       $data = ['data' => $data]; 
       $user['to'] =$email;

       $send_mail = Mail::send('layouts.offer_mail',['data' => $data], function ($messages) use ($user) {
          $messages->to($user['to']);
          $messages->subject('Send Job Offer');
      });

      if($send_mail && $offer_accept && $offer_accept == 2){
        $update['offer_accept'] = 1;
        $update['reject'] = 0;

        JobApplication::where('id',$request->id)->update($update);
      }

      $response = [
        'status' => true,
        'message' => 'Job Offer Mail '.($offer_accept == 2 ? '' : 'Already').' Send Successfully',
        'icon' => 'success',
    ];
    }catch (\Throwable $e) {
        dd($e);
        $response = [
            'status' => false,
            'message' => "Something Went Wrong! Please Try Again.",
            'icon' => 'error',
        ];
    }
    return response($response);
    }

    /*Accept Send Offer*/ 
    public function accept_offer(Request $request){
        try {  
            $data['job_apply_data'] = JobApplication::where('id',$request->id)->first();
            $data['user'] = User::where('id',$data['job_apply_data']->user_id)->first();
            $data['doctor'] = Auth::user();
             $email = $data['user']->email; 
             $user['to'] =$email;
      
             $send_mail = Mail::send('layouts.accept_mail',['data' => $data], function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Send Mail For Accept Job Offer');
            });
      
            if($send_mail){
                $update['offer_accept'] = 3;
                JobApplication::where('id',$request->id)->update($update);
              }
      
            $response = [
              'status' => true,
              'message' => "Job Offer Accepted Mail Send Successfully",
              'icon' => 'success',
          ];
          }catch (\Throwable $e) {
              dd($e);
              $response = [
                  'status' => false,
                  'message' => "Something Went Wrong! Please Try Again.",
                  'icon' => 'error',
              ];
          }
          return response($response);
    }

    /*Reject Offer*/
    public function reject_offer(Request $request){
        try {  
            $data['job_apply_data'] = JobApplication::where('id',$request->id)->first();
            $data['user'] = User::where('id',$data['job_apply_data']->doctor_id)->first();
            $data['job_post'] = JobPost::where('id',$data['job_apply_data']->job_id)->first();
            $email = $data['user']->email; 
            $data['name'] = Auth::user()->name;
             //Send mail with attach file
             $name = Auth::user()->name;
             $data = ['data' => $data]; 
             $user['to'] =$email;
      
             $send_mail = Mail::send('layouts.reject_offer_mail',['data' => $data], function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Send Job Offer');
            });
      
            if($send_mail){
              $update['reject'] = 1;
              JobApplication::where('id',$request->id)->update($update);
            }
      
            $response = [
              'status' => true,
              'message' => "Job Offer Reject Successfully",
              'icon' => 'success'
          ];
          }catch (\Throwable $e) {
              dd($e);
              $response = [
                  'status' => false,
                  'message' => "Something Went Wrong! Please Try Again.",
                  'icon' => 'error',
              ];
          }
          return response($response);
    }
    
}
