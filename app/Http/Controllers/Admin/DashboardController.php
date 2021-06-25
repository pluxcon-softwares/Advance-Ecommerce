<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


use App\Models\Admin;

class DashboardController extends Controller
{
    public function __construct(){}

    public function dashboard()
    {
        Session::put('page', 'Dashboard');
        return view('admin.dashboard');
    }

    public function updateAdminPasswordForm()
    {
        Session::put('page', 'Settings');
        return view('admin.update-admin-password');
    }

    public function updateAdminPassword(Request $request)
    {
        $rules = [
            'new_password'  =>  'required|confirmed',
            'current_password' => 'required'
        ];
        $messages = [
            'current_password.required' => 'Current admin password is required',
            'new_password.required' =>  'New admin password required',
            'new_password.confirmed'=> 'New and confirm admin password does not match'
        ];
        $request->validate($rules, $messages);

        if( Hash::check($request['current_password'], Auth::guard('admin')->user()->password) )
        {
            Admin::where('email', Auth::guard('admin')->user()->email)
            ->update(['password' => Hash::make($request['new_password'])]);
            Session::flash('flash_success', 'Admin password updated succesfully!');
            return redirect()->back();
        }
        else{
            Session::flash('flash_error', 'Error updating admin password!');
        }
    }

    public function checkCurrentPassword(Request $request)
    {
        if(Hash::check($request['current_password'], Auth::guard('admin')->user()->password))
        {
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function updateAdminDetails(Request $request)
    {
        Session::put('page', 'Settings');

        if($request->isMethod('post'))
        {
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'numeric|sometimes',
                'image' =>  'image|mimes:jpg,jpeg,png,gif|max:2048|sometimes'
            ];
            $messages = [];
            $request->validate($rules, $messages);

            if($request->hasFile('image'))
            {
                if(Storage::exists('public/profile/'.Auth::guard('admin')->user()->image))
                {
                    Storage::delete('public/profile/'.Auth::guard('admin')->user()->image);
                }
                $file = $request->file('image');
                $filename = $request->file('image')->getClientOriginalName();
                Image::make($file)->resize(100, 100)
                ->save(storage_path('app/public/profile/'.$filename));
            }
            else{
                $filename = $request['current_image'] ? $request['current_image'] : "";
            }

            Admin::where('email', Auth::guard('admin')->user()->email)
            ->update([
                'name' => $request['name'],
                'mobile' => $request['mobile'],
                'image' => $filename
            ]);

            Session::flash('flash_success', 'Admin details updated successfully!');
            return redirect()->back();
        }

        return view('admin.update-admin-details');
    }
}
