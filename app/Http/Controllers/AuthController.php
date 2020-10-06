<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]); 

        $token = base64_encode(Str::random(40));
        $request->user()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => $token,
        ])->save();

        $credentials = $request->only('email', 'password');
        if (Auth::once($credentials)) {
            // update token
            $token = Str::random(40);
            $request->user()->forceFill([
                // 'api_token' => hash('sha256', $token),
                'api_token' => base64_encode($token),
            ])->save();
            // return authenticate user
            return Auth::user()->makeVisible([ 'api_token' ]);
        }
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);        
        $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        if (Auth::once($credentials)) {
            // update token
            $token = Str::random(40);
            $request->user()->forceFill([
                // 'api_token' => hash('sha256', $token),
                'api_token' => base64_encode($token),
            ])->save();
            // return authenticate user
            return Auth::user()->makeVisible([ 'api_token' ]);
        }
    }
    public function remember_token(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);  
        // if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
        if (Auth::once(['email' => $email, 'password' => $password], $remember)) {
        // The user is being remembered...
            return Auth::user()->makeVisible([ 'api_token' ]);
        }
    }
    // public function forgot(Request $request) {
    //     // $credentials = request()->validate(['email' => 'required|email']);
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //     ]); 
        
    //     $credentials = $request->only('email');
    //     Password::sendResetLink($credentials);

    //     return response()->json(["msg" => 'Reset password link sent on your email id.']);
    // }
    public function log_out(Request $request)
    {
        Auth::logout();
    }
}
