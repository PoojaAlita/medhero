<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,Thumb,ContactUs,JobApplication,JobPost,Hospital};
use Illuminate\Support\Facades\{Mail,Auth};
use Dirape\Token\Token;



class HospitalController extends Controller
{
     /*Dashboard Of Hospital*/
     public function index()
     {
         return view('admin.pages.hospital.hospital');
     }

    //Listing Data Of Hospital
    public function listing(){
        $data['hospital']= User::where('status',1)->where('user_status',1)->with('thumb','hospital')->get();
        $result = [];
        foreach ($data['hospital'] as $key=>$hospital) {

                $button = '';
                $cover = '';
                $button .= '<button class="edit_hospital btn btn-sm btn-success m-1"  data-id="'.$hospital['id'].'">
                <i class="mdi mdi-square-edit-outline"></i>
                </button>';

                $button .= '<button class="delete btn btn-sm btn-danger m-1" data-id="'.$hospital['id'].'">
                <i class="mdi mdi-delete"></i>
                </button>';

                $cover .= '<img class="rounded-circle" src="/assets/images/CoverImage/'.$hospital->cover_image.'" height="50px" width="50px" alt="">';

                $result[] = array(
                    "0"=>$key+1,
                    "1"=>ucfirst($hospital->name),
                    "2"=>$hospital->email,
                    "3"=>$hospital->phone_number,
                    "4"=>$hospital->address,
                    "5"=>$hospital->hospital->private_public_hospital == 1 ?'Private' : 'Public',
                    "6"=> $cover,
                    "7"=>$button
                    );
           
        }
        return response()->json(['data'=>$result]);
    }

     //Storing And Updating Data Of Hospital
     public function store(Request $request)
     {
        // dd($request->password);
         $request->validate(
             [
                 'name' => 'required',
                 'email' => 'required',
                 'contact'=>'required',
                 'address'=>'required',
             ]
         );

         try {

            $attach = Thumb::select('thumb_image')->where('user_id',$request->id)->first();

            $thumbImage = [];

            // Multiple Thumb Image Upload
            if ($request->has('thumb')) {
              if (isset($attach['thumb_image']) && $attach['thumb_image'] != "" && file_exists(public_path() . '/images/' . $attach['thumb_image'])) {
                  unlink(public_path() . '/images/' . $attach['thumb_image']);
              }

            foreach ($request->thumb as $fle) {
                        $fileName = time() . '.' . $fle->getClientOriginalName();
                        $files = $fle->move(public_path() . '/assets/images/Thumb/', $fileName);
                        $thumbImage[] = $fileName;
            }
      
          }elseif (isset($attach) && $attach['thumb_image']) {
              $fileName = $attach['thumb_image'];
              $thumbImage[] = $fileName;
          } 
          else {
            $thumbImage[] = "";

          }

          //Cover Image Upload
          $attachs = User::select('cover_image')->where('id', $request->id)->first();

            if ($request->has('cover_image')) {
              if (isset($attachs['cover_image']) && $attachs['cover_image'] != "" && file_exists(public_path() . '/images/' . $attachs['cover_image'])) {
                  unlink(public_path() . '/images/' . $attachs['cover_image']);
              }
              $fileCover = time() . '_' . $request->cover_image->getClientOriginalName();
              $files = $request->cover_image->move(public_path() . '/assets/images/CoverImage/', $fileCover);
          }elseif (isset($attachs) && $attachs['cover_image']) {
              $fileCover = $attachs['cover_image'];
          } 
          else {
            $fileCover = "";
          }
        
            $hospitalData = User::updateOrCreate([
                 'id' => $request->id,
             ],[
                'name' => $request->name,
                'email' => $request->email,
                'password' =>$request->id == 0 ? bcrypt($request->password):$request->password, 
                'phone_number' => $request->contact,
                'address' => $request->address,
                'latitude' =>$request->latitude,
                'longitude' =>$request->longitude,
                'private_public_hospital' => $request->public_private_hospital,
                'cover_image'=>$fileCover,
                'remember_token' => (new Token())->Unique('users', 'remember_token', 60)
             ]);
             
             //Store Thumb Image
             $hospital_id = $hospitalData->id;
             
             $thumb_id = Thumb::where('user_id',$hospital_id)->first('id');
             $thumb_image_data = Thumb::updateOrCreate(
                ['user_id' => $hospital_id],
               [
                    'user_id' =>   $hospital_id,
                    'thumb_image'=>implode('|',$thumbImage),
                ]
             );

             $hospital_data = Hospital::updateOrCreate(
                ['user_id' => $hospital_id],
               [
                    'user_id' =>   $hospital_id,
                    'private_public_hospital' =>$request->public_private_hospital,
                ]
               );


             //Send mail with attach file
          
             if($request->id == 0){
                $user['to'] =$hospitalData->email;
                $data = ['data' => $request]; 

                 Mail::send('admin.pages.hospital.mail',$data, function ($messages) use ($user) {
                    $messages->to($user['to']);
                    $messages->subject('Send Password');
                });
             }

             $response = [
                 'status' => true,
                 'message' => 'Hospital Data '.($request->id ==0 ? 'Added' : 'Updated').' Successfully',
                 'icon' => 'success',
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


     public function edit(Request $request){
        try {
            $data['user']= User::where('id',$request->id)->where('status',1)->with('thumb')->first(['id','name','email','password','phone_number','address','latitude','longitude','cover_image']);
            $data['hospital'] = Hospital::where('user_id',$request->id)->first();
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

    //Remove Data Of Hospital
    public function delete(Request $request)
    {
        try {
            $update['status']=0;
            User::where('id',$request->id)->update($update);
            JobApplication::where('user_id',$request->id)->update($update);
            JobPost::where('user_id',$request->id)->update($update);

            $response = [
                'status' => true,
                'message' => "Hospital Data Deleted Successfully",
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

     /*Check Availability Of Email*/
     public function validate_email(Request $request){
        if(isset($request) && $request->email){
         $user = User::where('id','!=',$request->id)->where('email',$request->email)->first('email');
         return(!is_null($user))? true :false;
         }else{
            return false;
         }
     }

}
