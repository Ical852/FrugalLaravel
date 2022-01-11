<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index () {
        return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required',  'email:dns'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            if(!Auth::user()->email_verified_at) {
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return back()->with('loginError', 'Verify your email!');
            } else if(Auth::user()->status == 'banned') {
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return back()->with('loginError', 'You are not allowed!');
            }

            $user = Auth::user()->role;

            if($user == 'admin') {
                return redirect('/administrator');
            } else if($user == 'vendor') {
                return redirect('/vendorpage');
            } else if($user == 'user') {
                return redirect('/user');
            }
        }

        return back()->with('loginError', 'Login failed!');

    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/auth');
    }
}
