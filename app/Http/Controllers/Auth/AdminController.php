<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AdminLoginRequest;

class AdminController extends Controller
{
    public function login()
    {       
        return view('auth.admin.login');
    }

    public function authenticate(AdminLoginRequest $request)
    {
        $remember_me = $request->remember_me ? 1 : 0;

        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password' => $request->password], $remember_me))
        {
            return redirect()->intended('admin/dashboard');
        }
        else{
            Session::flash('flash_error', 'Email/Password Incorrect!');
            return back();
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin');
    }
}
