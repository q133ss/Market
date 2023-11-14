<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthController\AuthRequest;
use App\Mail\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function sendMail(Request $request)
    {
        $password = Str::random(8);

        if(User::where('email', $request->email)->exists()){
            return Response('Пользователь с таким email уже существует', 403);
        }

        Mail::to(['email' => $request->email])->send(new Register($request->email, $password));

        User::create(['email' => $request->email, 'password' => Hash::make($password)]);

        return Response('success', 200);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function auth(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        Auth::login($user);

        dd(Auth()->user());
    }
}
