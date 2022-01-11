<?php

namespace App\Http\Controllers;

use App\Mail\ResetMail;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function index() {
        return view('auth/forgot');
    }

    public function send(Request $request) {
        $mail = $request->email;
        $user = User::firstWhere('email', $mail);

        if(!$user) {
            return redirect('/forgot')->with('failed', 'User Email Not Found!');
        }

        $user_token = [
            'user_email' => $user->email,
            'user_token' => base64_encode(random_bytes(32)),
            'token_generated' => base64_encode(random_bytes(64))
        ];

        Mail::to($user->email)->send(new ResetMail($user_token['token_generated']));

        Token::create($user_token);

        return redirect('/forgot')->with('success', 'Link Has Been Sent, Check Your Email to Reset Your Password');

    }

    public function reset(Request $request) {
        $rcode = str_replace(' ', '+', $request->rcode);
        $token_g = Token::firstWhere('token_generated', $rcode);

        if(!$request->rcode or !$token_g) {
            return back();
        }

        return $this->renew($rcode);
    }

    private function renew($token) {
        if(!$token) {
            return back();
        }

        return view('auth/reset', [
            'token' => $token
        ]);
    }

    public function change(Request $request) {
        $token = str_replace(' ', '+', $request->token);

        if(!$request->token) {
            return back();
        }

        $user = Token::firstWhere('token_generated', $token);

        if(!$user) {
            return back();
        }

        $email = $user->user_email;

        $validatedData = $request->validate([
            'password' => ['required', 'min:8', 'max:255']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('email', $email)->update(['password' => $validatedData['password']]);
        Token::where('token_generated', $token)->delete();

        return redirect('/auth')->with('changed', 'Reset Password Success, You Can Login With Your New Password Now!');
    }

}
