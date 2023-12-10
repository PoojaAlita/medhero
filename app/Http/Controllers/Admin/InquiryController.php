<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ContactUs};


class InquiryController extends Controller
{
     /*Dashboard Of Inquiry*/
     public function index()
     {
         return view('admin.pages.inquiry.inquiry');
     }

    //Listing Data Of Inquiry
    public function listing(){
        $data['inquiry']= ContactUs::get(['id','name','email','phone_number','address','latitude','longitude','private_public_hospital']);
        $result = [];
        foreach ($data['inquiry'] as $key=>$hospital) {

            $result[] = array(
                "0"=>$key+1,
                "1"=>ucfirst($hospital->name),
                "2"=>$hospital->email,
                "3"=>$hospital->phone_number,
                "4"=>$hospital->address,
                "5"=>$hospital->private_public_hospital == 1 ?'Private' : 'Public',
                );
        }
        return response()->json(['data'=>$result]);
    }
}
