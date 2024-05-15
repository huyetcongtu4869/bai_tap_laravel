<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminRequest;
use App\Mail\SendMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
               
         
                return redirect()->route('home');
            } else {
                Session::flash('error', 'Sai mật khẩu hoặc email');
                return redirect()->route('user.login');
            }
        }
        return view('auth.admin.login');
    }
    public function register(Request $request) {
        if ($request->isMethod('POST')) {
            $name=$request->name;
            $email=$request->email;
            Mail::to($email)->send(new SendMail($name,$email));
            $user = Admin::create(request([ 'email', 'password','name']));
            Auth::guard('admin')->login($user);
            return redirect()->route('home');
        }
        return view('auth.admin.register');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
