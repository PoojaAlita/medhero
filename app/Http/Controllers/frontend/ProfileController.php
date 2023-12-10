<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Doctor,Connect,Education,Experience,Language,Skill,User,JobPost,JobSkill,JobApplication,JobLanguage,Hospital};
use Illuminate\Support\Facades\{Auth,Crypt,DB,URL};
use Carbon\Carbon;



 class ProfileController extends Controller
{
    /* middeleware for verifying login or not */
    protected $id;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            return $next($request);
        });
    }

    /* Total Doctor Work  listing*/
    public function total_doctor_work_list(){
        $data['doctorImage'] = User::where('status',1)->with('doctor')->get();
        $data['job_apply'] = JobApplication::where('status',1)->where('offer_accept',3)->get();
        return view('layouts.total_doctor_work_listing',compact('data'));
    }

    /* Display Job Dashboard */ 
    public function job_view(){
        $all_skills = Skill::all();
        $all_languages = Language::all();
        return view('layouts.job_modal',compact('all_skills','all_languages'));
    }

     /* Display Job List */ 
     public function job_listing()
     {
         $all_skills = Skill::all();
         $all_languages = Language::all();
         $jobs = JobPost::where('user_id',$this->id)->where('created_at','>',Carbon::now()->subDays(30))->with('job_skill','language_job')->where('status',1)->get();
         return view('layouts.job_edit', compact('jobs','all_skills','all_languages'));
     }

    /*Store Job Data in Database */ 
    public function job_store(Request $request){

        $request->validate(
            [
                'title' => 'required',
                'skills' => 'required',
                'work_period'=>'required',
                'experience'=>'required',
                'hourly_rate'=>'required',
            ]
        );

        try {
       
            $attach = JobPost::select('attach_file')->where('user_id', Auth::user()->id)->first();

          //File Upload
          if ($request->attach_file) {
            if (isset($attach['attach_file']) && $attach['attach_file'] != "" && file_exists(public_path() . '/images/' . $attach['attach_file'])) {
                unlink(public_path() . '/images/' . $attach['attach_file']);
            }
            $fileName = time() . '_' . $request->attach_file->getClientOriginalName();
            $files = $request->attach_file->move(public_path() . '/assets/images/JobImage/', $fileName);
        }elseif (isset($attach) && $attach['attach_file']) {
            $fileName = $attach['attach_file'];
        } 
        else {
            $fileName = "";
        }

        $jobData = JobPost::updateOrCreate(
            ['id'=>decryptid($request['id'])],[
            'user_id'=>Auth::user()->id,
            'title' => $request->title,
            'work_period' =>$request->work_period, 
            'experience' => $request->experience,
            'hourly_rate' => $request->hourly_rate,
            'description' => $request->description,
            'attach_file' =>$fileName,
         ]);

         $id =  $jobData->id;
         $job = JobPost::find($id);
         $skill = $job->job_skill()->sync($request->skills);
         $language = $job->language_job()->sync($request->languages);


         $response = [
            'status' => true,
            'message' => 'Job Data '.(decryptid($request['id'])==0 ? 'Added' : 'Updated').' Successfully',
            'icon' => 'success',
            'redirect_url' => $request['id'] == 0 ? 'profile/'.auth()->user()->remember_token : 'profile/job',
        ];
    } catch (\Throwable $e) {
        dd($e);
        $response = [
            'status' => false,
            'message' => 'Something Went Wrong! Please Try Again.',
            'icon' => 'error',
        ];
    }
    return response($response);
 }

 public function job_update(Request $request)
    {
     try {
            $id = decryptid($request['id']);
            $data['job'] = JobPost::where('id', $id)->first();
            $data['skill'] =JobSkill::where('job_id',$id)->pluck('skill_id');
            $data['language'] =JobLanguage::where('job_id',$id)->pluck('language_id');

                if (!is_null($data)) {
                    $response['data'] = $data;
                    $response['status'] = [
                        'status' => true,
                    ];
                } 
            
         } catch (\Throwable $e) {
             $response = [
                 'status' => false,
                 'message' => 'Something Went Wrong! Please Try Again.',
                 'icon' => 'error',
             ];
         }
         return response($response);
    }

    /* Deleting Job */
    public function job_delete(Request $request)
    {
        try {
        $update['status']=0;
        $job = JobPost::where('id',decryptid($request['id']))->update($update);
            $response = [
                'status' => true,
                'message' => "Job Data Deleted Successfully",
                'icon' => 'success',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
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

   //Listing Data Of Job Apply
    public function job_apply_listing(){
        $data['job_apply']= JobApplication::where('user_id',Auth::user()->id)->with('User','job')->get();
        $data['user'] = User::where('status',1)->where('user_status',0)->get();
        return view('layouts.job_apply_listing',compact('data'));
    }


    // * Author : Rajvi     
    // * Date : 30/04/22
    // * added index,about,experience_listing and experience_store
    
    /* View Of Profile */
    public function index()
    {
        $url_parts = explode('/', URL::current());
        $token = $url_parts[count($url_parts)-1];
        $user = User::with(['education','experience','skill','language','thumb','hospital'])->with('doctor', function($query){
            $query->where('status','=','1');
        })->with('from_connections',function($query){
            $query->where('to_id',$this->id);
        })->with('to_connections',function($query){
            $query->where('from_id',$this->id);
        })->where('remember_token',$token)->first();
        
        $all_skills = Skill::all();
        $all_languages = Language::all();
        if($user){
            $user_id = $user ?$user->id : $this->id;
            $jobs = JobPost::where('user_id',$user_id)->where('created_at','>',Carbon::now()->subDays(30))->with('job_skill','language_job')->where('status',1)->get();
            $past_jobs = JobPost::where('user_id', $user_id)->where('created_at','<',Carbon::now()->subDays(30))->with('job_skill','language_job')->where('status',1)->get();
            $likeData = Hospital::where('status',1)->where('user_id',Auth::user()->id)->first();
            $doctorImage = User::where('status',1)->with('doctor')->get();
            $job_apply = JobApplication::where('status',1)->where('offer_accept',3)->get();
            $reviewData = JobApplication::where('status',1)->where('user_id',$user_id)->with('job')->first();
            // dd($reviewData);
            $countReview = JobApplication::where('status',1)->where('review',1)->count();

            return view('layouts.profile', compact('user', 'all_skills', 'all_languages','jobs','past_jobs','likeData','job_apply','doctorImage','reviewData','countReview'));
        }else{
            return view('welcome');
        }
       
    }

    /* Updating User Details To Database */
    public function user(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'contact_number' => 'required',
                'address' => 'required',
            ]
        );
        $user = User::where('id', $this->id)->first();
        $user->name = $request['name'];
        $user->email = $request['email'];    
        $user->phone_number = $request['contact_number'];     
        $user->address = $request['address'];      
        $user->latitude = $request['latitude'];      
        $user->longitude = $request['longitude'];      
       
        $user->updated_at=now();
     
        if ($user->save()) {
            $response = [
                'status' => true,
                'message' => "User Data Updated Successfully",
                'icon' => 'success',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            
        } else {
            $response = [
                'status' => false,
                'message' => "error in updating",
                'icon' => 'error',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
           
        }
        return response($response);

    }

    /* store about to database */
    public function about(Request $request)
    {
        $request->validate(
            ['about' => 'required']
        );
        try {
        $user = User::where('id', $this->id)->first();
        $user->about = $request['about'];
        $user->updated_at = now();
        $user->save();
            if ($user->save()) {
                $response = [
                    'status' => true,
                    'message' => "About Updated Successfully",
                    'icon' => 'success',
                    'redirect_url' => 'profile/'.auth()->user()->remember_token,
                ];
            } 
        } catch (\Throwable $e) {
             $response = [
                 'status' => false,
                 'message' => 'Something Went Wrong! Please Try Again.',
                 'icon' => 'error',
             ];
         }
        return response($response);
    }

    /* display experience dashboard */ 
    public function experience_listing()
    {
        $experiences = Experience::where('u_id', $this->id)->where('status', 1)->get();
        return view('layouts.experience_edit', compact('experiences'));
    }

    /* store experience to database */ 
    public function experience_store(Request $request)
    {
        $request->validate(
            [
                'position' => 'required',
                'name' => 'required',
                'start_date' => 'required',
            ]
        );
        $id = decryptid($request['id']);
        $experience = ($id == 0) ?  (new Experience()) : (Experience::where('id', $id)->first());
        $experience->u_id = $this->id;
        $experience->position = $request['position'];
        if (!is_null($request['employment_type'])) {
            $experience->employment_type = $request['employment_type'];
        }
        $experience->name = $request['name'];
        if (!is_null($request['logo'])) {
            $logo = $request['logo'];
            $name = $logo->getClientOriginalName();
            $allowedlogoExtension = ['jpg', 'png', 'jpeg'];
            $extension = $logo->getClientOriginalExtension();
            $check = in_array($extension, $allowedlogoExtension);
            if ($check) {
                $image['filePath'] = time() . $name;
                $logo->move(public_path() . '/assets/images/hospital/hospital_logo/', $image['filePath']);
                $experience->logo = $image['filePath'];
            }
        }
        $experience->country = $request['country'];      
        $experience->city = $request['city'];
        $experience->start_date = $request['start_date'];
        $experience->end_date = $request['end_date'];
        $experience->description = $request['description'];
        $result = ($id == 0) ? $experience->save() : $experience->update();
        if ($result) {
            $response = [
                'status' => true,
                'message' => 'experience '.($id==0 ? 'added' : 'updated ').' successfully',
                'icon' => 'success',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        } else {
            $response = [
                'status' => false,
                'message' => "error in updating",
                'icon' => 'error',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        }
    }

    /* fetch experience data from database for editing */ 
    public function experience_data(Request $request)
    {
        $id = decryptid($request['id']);
        $experience = Experience::where('id', $id)->first();
        if (!is_null($experience)) {
            $response['data'] = $experience;
            $response['status'] = [
                'status' => true,
            ];
            echo json_encode($response);
            exit;
        } else {
            $response = [
                'status' => false,
                'message' => "error in fetching",
                'icon' => 'error',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        }
    }

    // * Author : Rajvi 
    // * Date : 30/04/22
    // * end
    
    // * Author : Rajvi 
    // * Date : 2/05/22
    // * added education 

    /* display education dashboard */ 
    public function education_listing()
    {
        $educations = Education::where('u_id', $this->id)->where('status', 1)->get();
        return view('layouts.education_edit', compact('educations'));
    }

    /* store education to database */ 
    public function education_store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'start_date' => 'required',
            ]
        );
        $id = decryptid($request['id']);
        $education = ($id == 0) ? (new Education()) : (Education::where('id', $id)->first());
        $education->u_id = $this->id;
        $education->name = $request['name'];
        $education->degree = $request['degree'];
        if (!is_null($request['school_logo'])) {
            $school_logo = $request['school_logo'];
            $name = $school_logo->getClientOriginalName();
            $allowedschool_logoExtension = ['jpg', 'png', 'jpeg'];
            $extension = $school_logo->getClientOriginalExtension();
            $check = in_array($extension, $allowedschool_logoExtension);
            if ($check) {
                $image['filePath'] = time() . $name;
                $school_logo->move(public_path() . '/assets/images/school/logo/', $image['filePath']);
                $education->logo = $image['filePath'];
            }
        }
        $education->grade = $request['grade'];
        $education->start_date = $request['start_date'];
        $education->end_date = $request['end_date'];
        $education->description = $request['description'];
        $result = ($id == 0) ? $education->save() : $education->update();
        if ($result) {
            $response = [
                'status' => true,
                'message' => 'education '.($id==0 ? 'added' : 'updated').' successfully',
                'icon' => 'success',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        } else {
            $response = [
                'status' => false,
                'message' => "error in updating",
                'icon' => 'error',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        }
    }

    /* fetch education data from database for editing */ 
    public function education_data(Request $request)
    {
        $id = decryptid($request['id']);
        $education = Education::where('id', $id)->first();
        if (!is_null($education)) {
            $response['data'] = $education;
            $response['status'] = [
                'status' => true,
            ];
            echo json_encode($response);
            exit;
        } else {
            $response = [
                'status' => false,
                'message' => "error in fetching",
                'icon' => 'error',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        }
    }

    // * Author : Rajvi 
    // * Date : 2/05/22
    // * end 

    // * Author : Rajvi 
    // * Date : 3/05/22
    // * fetch user data 

    /* fetch user data from database for editing user details */ 
    public function user_data(Request $request)
    {
        $user = User::where('id', $this->id)->with('experience',function ($query) {
            $query->where('flag','=','1')->first();
        })->with('education',function ($query) {
            $query->where('flag','=','1')->first();
        })->first();
        if (!is_null($user)) {
            $response['data'] = $user;
            $response['status'] = [
                'status' => true,
            ];
            echo json_encode($response);
            exit;
        } else {
            $response = [
                'status' => false,
                'message' => "error in fetching",
                'icon' => 'error',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        }
    }

    // * Author : Rajvi 
    // * Date : 3/05/22
    // * end 

    // * Author : Rajvi 
    // * Date : 4/05/22
    // * delete education and experience

    /* deleting experience */
    public function experience_delete(Request $request)
    {
        $id = decryptid($request['id']);
        $experience = Experience::where('id',$id)->where('status',1)->first();
        $experience->status=0;
        $experience->updated_at=now();
        if($experience->save()){
            $response = [
                'status' => true,
                'message' => "experience deleted successfully",
                'icon' => 'success',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        }else {
            $response = [
                'status' => false,
                'message' => "error in deleting",
                'icon' => 'error',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        }
    }

    /* deleting education */
    public function education_delete(Request $request)
    {
        $id = decryptid($request['id']);
        $education = Education::where('id',$id)->where('status',1)->first();
        $education->status='0';
        $education->updated_at=now();
        if($education->save()){
            $response = [
                'status' => true,
                'message' => "education deleted successfully",
                'icon' => 'success',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        }else {
            $response = [
                'status' => false,
                'message' => "error in deleting",
                'icon' => 'error',
                'redirect_url' => 'profile/'.auth()->user()->remember_token,
            ];
            echo json_encode($response);
            exit;
        }
    }
    // * Author : Rajvi 
    // * Date : 4/05/22
    // * delete education and experience

    /*
        * Author : kishan 
        * Date : 29/04/22
        * Added skills and language function
    */

    public function skill(Request $request)
    {
        $request->validate([
            'skills' => 'required'
        ]);
        $user = User::find($request->id);
        $user->skill()->sync($request->skills);

        $response = [
            'status' => true,
            'message' => "skills updated successfully ",
            'icon' => 'success',
            'redirect_url' => 'profile/'.auth()->user()->remember_token,
        ];
        echo json_encode($response);
        exit;
    }

    public function language(Request $request)
    {

        $request->validate([
            'languages' => 'required'
        ]);

        $user = User::find($request->id);
        $user->language()->sync($request->languages);

        $response = [
            'status' => true,
            'message' => "skills updated successfully",
            'icon' => 'success',
            'redirect_url' => 'profile/'.auth()->user()->remember_token,
        ];
        echo json_encode($response);
        exit;
    }

    /* Searching */
    public function search(Request $request)
    {   
        try{
            $data['current_user'] = Auth::user();
            if(!is_null($request->location)){
                $data['user_status'] =  $data['current_user']->user_status== 0  ? '1' : '0';

                $location = explode(' ',$request->location);
              
                $data['users'] = JobPost::where('status',1)->where('created_at','>',Carbon::now()->subDays(30))->with('job_apply', function ($query) {
                    $query->where('doctor_id','=',Auth::user()->id);
                })->with('user')->get();

                $data['usersData'] = User::with('doctor')->where('user_status',$data['user_status'] )->where(function ($query) use ($request) {
                    foreach (explode(' ',$request->location) as $locations) {
                        $query->orWhere('address', 'LIKE', "%$locations%");
                     }
                    })->with('from_connections',function($query){
                        $query->where('to_id',$this->id);
                    })->with('to_connections',function($query){
                        $query->where('from_id',$this->id);
                    })->get();
                            
            }

            if($data['usersData']->isEmpty()){
                $response = [
                    'status' => false,
                    'message' =>  'Location Not Found.',
                    'icon' => 'error',
                ];
             
            }elseif($data['users']->isEmpty() && $data['user_status'] == 1){
                $response = [
                    'status' => false,
                    'message' => 'Job  Is Not Posted.',
                    'icon' => 'error',
                ];
            }
            else{
                $response['data'] = $data;
                $response['status'] = ['status' => true];
            }
        
         
        } catch (\Throwable $e) {
            dd($e);
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong! Please Try Again.',
                'icon' => 'error',
            ];
        }
        return response($response);
    }

    /* connections and cancle connection */
    public function connect(Request $request)
    {
        if(isset($request->arr)){
            if(isset($request->arr[1])){
                $connect = Connect::where('id',$request->arr[1])->first();
                if($connect->from_id!=$this->id){
                    $connect->from_id = $this->id;
                    $connect->to_id = $request->arr[0];
                }
                $connect->status = 0;
            }else{
                $connect = new Connect;
                $connect->from_id = $this->id;
                $connect->to_id = $request->arr[0];
            }
            (isset($request->arr[1])) ? $connect->update() : $connect->save();
        }else{
            $connect = Connect::where('id',$request['connection_id'])->first();

            if(isset($request['accept_id'])){
                $connect->status = 1; 
            }
            elseif(isset($request['reject_id'])){
                $connect->status = 2; 
            }
            elseif(isset($request['block_id'])){
                $connect->connect_status = 2; 
            }
            $connect->update(); 

        }
        $response = [
            'status' => true,
            'flag' => $request['flag']==1
        ];
        echo json_encode($response);
        exit;
    }

    /* Storing Cover And Profile Photo To Database */
    public function cover_store(Request $request)
    {
        if(isset($request->image)){
            $folderPath = public_path('/assets/images/CoverImage/');
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $imageFullPath = $folderPath.$imageName;
            file_put_contents($imageFullPath, $image_base64);
            User::where('id', $this->id)->update(['cover_image' => $imageName]);
        }elseif(isset($request->profile_image)){
            $folderPath = public_path('assets/images/profileImage/');
            $image_parts = explode(";base64,", $request->profile_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $imageFullPath = $folderPath.$imageName;
            file_put_contents($imageFullPath, $image_base64);
            $status = 1;
            Doctor::where('user_id', $this->id)->update(['profile_image' => $imageName,'status'=>$status]);
        }
        
        $response = [
            'status' => true,
            'message' => ($request->image ? 'Cover Image ' : 'Photo ') ." Updated Successfully",
            'icon' => 'success',
            'redirect_url' => 'profile/'.auth()->user()->remember_token,
        ];
        return response($response);
    }

    /*Profile Image Delete */
    public function profile_delete(Request $request){
        try {
            $update['status']=0;
            $abc = Doctor::where('user_id',$request->id)->update($update);
            $response = [
                'status' => true,
                'icon' => 'success',
            ];
        }catch (\Throwable $e) {
            $response = [
                'status' => false,
                'message' => "Something Went Wrong! Please Try Again.",
                'icon' => 'error',
            ];
        }
        return response($response);
    }

    public function like(Request $request){
        try {
          
            $checkLikeData = Hospital::where('status',1)->where('user_id',$request->id)->where('like',1)->first();
            if($checkLikeData){
                $update['like'] = 0;
                $likeData =Hospital::where('user_id',$request->id)->update($update);
            }else{
                $likeData = Hospital::updateOrCreate([
                    'user_id'=>$request->id,
                ],[
                    'like' => 1
                ]);
            }

            $response = [
                'data'=>$likeData,
                'status' => true,
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

    public function review(Request $request){
        try {
          
            $checkReviewData = JobApplication::where('status',1)->where('doctor_id',$request->id)->where('review',1)->first();

            if($checkReviewData){
                $update['review'] = 0;
                $data['reviewData'] = JobApplication::where('doctor_id',$request->id)->update($update);
                $data['review'] = 0;

            }else{
                $update['review'] = 1;
                $data['reviewData'] = JobApplication::where('doctor_id',$request->id)->update($update);
                $data['review'] = 1;
            }

            $response = [
                'data'=>$data,
                'status' => true,
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