<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Str;
use Mail;
use App\Http\Requests\ResetPassword;
use App\Mail\forgotPasswordMail;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        return view('auth.login');  
    }

    public function login_post(Request $request)
    {
        //dd($request->all());

        if(Auth::attempt(['email'=> $request->email, 'password' => $request->password],true)){
            if(Auth::User()->is_role == '1')
            {
                return redirect()->intended('admin/dashboard');
            }else{
                return redirect()->back()->with('error', 'please enter the Correct creditionals');
            }
        }else{
            return redirect()->back()->with('error', 'please enter the Correct creditionals');
        }
    }

    public function forgot()
    {
        return view('auth.forgot');  
    }

    public function forgot_post(Request $request){
        //dd($request->all());

        $count = User::where('email', '=', $request->email)->count();
        if($count > 0)
        {
            $user = User::where('email', '=', $request->email)->first();
            $user->remember_token = Str::random(50);
            $user->save();

            Mail::to($user->email)->send(new forgotPasswordMail($user));

            return redirect()->back()->with('success', 'password has been reset.please check your Spam or Junk email folder.');

        }else{
            return redirect()->back()->withInput()->with('error', 'Email not found in the system.');
        }
    }

    public function getReset($token)
    {

        if(Auth::check()){
            return redirect('admin/dashboard');
        }

        $user = User::where('remember_token', '=', $token);
        if($user->count() == 0){
            abort(403);
        }
        $user = $user->first();
        $data['token'] = $token;
        return view('auth.reset', $data);
    }

    public function postReset($token, ResetPassword $request)
    {
         $user = User::where('remember_token', '=', $token);
         if($user->count() == 0){
            abort(403);
        }

        $user = $user->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();

        return redirect('/')->with('success','password has been reset !');


    }

    public function logout(){
        Auth::logout();
        return redirect(url('/'));
    }

}
