<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Show the form
    public function showLoginForm()
    {
        return view('login');
    }

    // 2. Handle the login logic
    public function login(Request $request)
    {
        // Validate inputs (Replaces filter_var)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        // Note: Laravel expects passwords to be hashed with Bcrypt, not MD5. 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Get the currently authenticated user
            $user = Auth::user();

            // Check User Type (Your logic)
            if ($user->user_type == 'admin') {
                return redirect()->route('admin.page');
            } else {
                return redirect()->route('home');
            }
        }

        // If login fails, go back with an error
        return back()->withErrors([
            'email' => 'Incorrect email or password!',
        ]);
    }
}