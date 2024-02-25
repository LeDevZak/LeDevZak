<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Retrieve user by email
        $user = User::where('email', $credentials['email'])->first();
    
        // Check if user exists and password matches
        if ($user && $user->password === $credentials['password']) {
            // Authenticate user
            Auth::login($user);
    
            // Redirect authenticated user
            return redirect('/')->with('success', 'Welcome Back!');
        }
    
        // Authentication failed
        throw ValidationException::withMessages([
            'email' => 'Invalid credentials.',
        ]);
    }
    
    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
