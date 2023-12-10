<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Dirape\Token\Token;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\Str;






class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */

  
    public function create()
    {
        return view('Auth.login');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect('/');
            }else{
                $newUser = new User();
                $newUser->first_name = explode(" ",$user->name)[0];
                $newUser->last_name = explode(" ",$user->name)[1];
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->remember_token = (new Token())->Unique('users', 'remember_token', 60);
                
                if($newUser->save()){
                    event(new Registered($user));

                    Auth::login($newUser);
    
                    return view('doctorORhospital');
                }
                
                // Auth::login($newUser);
                // return redirect('/');

            }

        } catch (Exception $e) {
            dd($e);
            return redirect('auth/google');
        }
    }
    public function user_data_store(Request $request)
    {
        $request->validate([
            'mobile_number' => ['required', 'min:10', 'max:10'],
            'user_status' => ['required'],
        ]);

        $user_status= ($request->user_status=='doctor') ? '0' : '1';
        $user = User::find(Auth::user()->id)->update([
            'mobile_number' => $request->mobile_number,
            'user_status' => $user_status,
            'timezone' => $request->timezone,
        ]);

        if($user_status==0){
            Session::put('count', '1');

            return redirect()->route('complete_profile');
        }else{
            Session::put('count_', '1');

            return redirect()->route('complete.profile.hospital');
        }
    }
    

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $checkUser = User::where('email',$request->email)->first();
        if(!is_null($checkUser)){
            if(($checkUser->user_status== 1 && $checkUser->approval ==1 && $checkUser->status==1)|| ($checkUser->user_status==0 && $checkUser->approval ==2 && $checkUser->status==1)){
                $request->authenticate();
                $checkUser->update(['timezone' => $request->timezone]);
                $request->session()->regenerate();

                if ($checkUser->flag == 1 && $checkUser->approval ==1) {
                    $checkUser->flag = 0;
                    $checkUser->save();
                    return redirect()->route('changePassword.dashboard');
                    
                }else{
                    return redirect()->route('welcome');
                }
              
            }else{
                return redirect()->route('welcome');
            }
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
            Auth::guard('web')->logout();
    
            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
      
                return redirect('/');          
    }

   
}
