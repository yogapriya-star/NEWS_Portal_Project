<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function profile_submit(Request $request)
    {

        $adminData = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if ($request->new_password!=null || $request->retype_password!=null) {

            $request->validate([
                'new_password' => 'required',
                'retype_password' => 'required|same:new_password'
            ]);
            $adminData->password = Hash::make($request->new_password);
        }

        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);
            $image_path = public_path('uploads/'.$adminData->photo);
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $file = $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $request->file('photo')->move(public_path('uploads/'),$filename);
            $adminData->photo = $filename;
        }

        $adminData->name = $request->name;
        $adminData->email = $request->email;
        $adminData->update();

        return redirect()->back()->with('success', 'Profile information is saved successfully');

    }
}
