<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function signin(){
        return view('auth.sign_in');
    }
    public function register(){
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).*$/',
                'min:8',
                'confirmed'
            ],
        ]);

        $user = User::create($validation);
        
        Auth::login($user);

        return  redirect()->route('home');
    }
}
