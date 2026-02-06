<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }
    public function register(Request $request){
        $validated=$request->validate([
             'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'newsletter' => ['nullable', 'boolean']
        ]);
        User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']), 
            'newsletter' => $validated['newsletter'] ?? false,
        ]);
        return redirect()->route('login.index');
    }
}
