<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User};
use Illuminate\Support\Facades\Mail;


class DoctorController extends Controller
{
    /*Dashboard Of Doctor*/
    public function index()
    {
        return view('admin.pages.doctor.doctor');
    }

    //Listing Data Of Doctor
    public function listing(){
        $data['doctor']= User::where('status',1)->where('user_status',0)->get(['id','name','email','phone_number','address','latitude','longitude','approval',]);
        $result = [];
        foreach ($data['doctor'] as $key=>$doctor) {
            $button = '';
            if($doctor->approval == 1){
                $button .= '<button class="btn btn-sm btn-success  m-1 padding"  data-id="'.$doctor['id'].'">Active</button>';
            }
            $button .= '<button class="reject btn btn-sm btn-danger m-1" data-id="'.$doctor['id'].'">Reject
            </button>';
            
            $result[] = array(
                "0"=>$key+1,
                "1"=>ucfirst($doctor->name),
                "2"=>$doctor->email,
                "3"=>$doctor->phone_number,
                "4"=>$doctor->address,
                "5"=>$doctor->latitude,
                "6"=>$doctor->longitude,
                "7"=>$button
                );
        }
        return response()->json(['data'=>$result]);
    }

    //Edit Approval Of Doctor
    public function approval(Request $request){
        try {
            $update['approval']=2;
            $user = new User;
            $approveData = $user->where('id',$request->id)->where('approval',1)->update($update);
            if($approveData){
                $approveMailData = $user->where('id',$request->id)->first('email');

                //Send mail with attach file
                $name = ['name' => "MedHero"];
                $user['to'] =$approveMailData->email;
                Mail::send('mail', $name, function ($messages) use ($user) {
                    $messages->to($user['to']);
                    $messages->subject('Hello Doctor');
                });
            }
            $response = [
                'status' => true,
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

    //Reject Of Doctor
    public function reject(Request $request){
        try {
            $update['status']= 0;
            $data = User::where('id',$request->id)->update($update);
            $response = [
                'status' => true,
                'status' => true,
                'message' => 'Reject Data Successfully',
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
}
