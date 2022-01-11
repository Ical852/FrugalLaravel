<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    public function index() {
        return view('auth/register');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'username' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'user';
        $validatedData['status'] = 'available';
        $validatedData['image'] = 'profile-images/user.png';

        $user_token = [
            'user_email' => $validatedData['email'],
            'user_token' => base64_encode(random_bytes(32)),
            'token_generated' => base64_encode(random_bytes(64))
        ];

        Mail::to($validatedData['email'])->send(new AuthMail($user_token['token_generated']));

        User::create($validatedData);
        Token::create($user_token);

        return redirect('/auth')->with('success', 'Account Has Been Created, Check Your Email For Verivication');
    }

    public function verification(Request $request) {
        $vcode = str_replace(' ', '+', $request->vcode);
        $token_g = Token::firstWhere('token_generated', $vcode);

        if(!$token_g) {
            return redirect('/')->with('failed', 'Verification Failed!, Invalid token!');
        } else {
            $email = $token_g->user_email;
            User::where('email', $email)->update(['email_verified_at' => now()]);
            Token::where('token_generated', $vcode)->delete();

            return redirect('/auth')->with('verified', 'Your Account Has Been Verified, You Can Login Now');
        }
    }

}
