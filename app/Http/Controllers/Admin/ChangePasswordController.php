<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    public function index(Request $request){

        return view('Auth.change_password');

    }
    public function store(Request $request) {

        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_new_password' => 'required',
        ]);

          if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your old password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('old_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        if(strcmp($request->get('new_password'), $request->get('confirm_new_password'))){
            //Current password and new password are same
            return redirect()->back()->with("error","Confirm  password same as your New password. Please enter same password.");
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->route('welcome');

    }
}
