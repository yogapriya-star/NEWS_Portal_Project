<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use App\Mail\Websitemail;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function forget_password()
    {
        return view('admin.forget_password');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential =[
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('admin')->attempt($credential)) {
            return redirect()->route('admin_home');
        } else {
            return redirect()->route('admin_login')->with('error', 'Information is not correct!');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $adminData = Admin::where('email', $request->email)->first();
        if (!$adminData) {
            return redirect()->back()->with('error', 'Email address not found!');
        }
        $token = hash('sha256', time());
        $adminData->update();

        $resetLink = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = 'Reset Password';
        $message = 'Please click on the following link: <br>';
        $message .= '<a href=" '.$resetLink.' "> Click here </a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('admin_login')->with('Success', 'Please check your email and follow the steps there');


    }

    public function reset_password($token, $email)
    {
        $adminData = Admin::where('token', $token)->where('email', $email)->first();
        if (!$adminData) {
            return redirect()->route('admin_login');
        }
        return view('admin.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request){
        $request->validate([
            'password' => 'required',
            'retype_password'=>'required|same:password'
        ]);

        $adminData = Admin::where('token', $request->token)->where('email', $request->email)->first();
        $adminData->password = Hash::make($request->password);
        $adminData->token='';
        $adminData->update();

        return redirect()->route('admin_login')->with('success', 'Password is reset successfully');
    }


}
