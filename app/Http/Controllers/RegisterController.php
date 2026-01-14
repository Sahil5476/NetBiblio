<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 1. Show the Registration Form
    public function showRegistrationForm()
    {
        return view('register');
    }

    // 2. Handle the Form Submission
    public function register(Request $request)
    {
        // Validate Inputs
        // 'confirmed' automatically checks if 'password' matches 'password_confirmation'
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        // Create the User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Secure hashing (Bcrypt)
            'user_type' => 'user', // Default user type
        ]);

        // Redirect to Login with a success message
        return redirect()->route('login')->with('success', 'Registered successfully! Please login.');
    }
}