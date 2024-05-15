<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminRequest;
use App\Http\Requests\Auth\UserRequest;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('home');
            } else {
                Session::flash('error', 'Sai mật khẩu hoặc email');
                return redirect()->route('user.login');
            }
        }
        return view('auth.user.login');
    }
    public function register(UserRequest $request) {
        if ($request->isMethod('POST')) {
            $name=$request->name;
            $email=$request->email;
            Mail::to($email)->send(new SendMail($name,$email));
            $user = User::create(request([ 'email', 'password','name']));
           Auth::login($user);
            return redirect()->route('home');
        }
        return view('auth.user.register');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/user/login');
    }
}
