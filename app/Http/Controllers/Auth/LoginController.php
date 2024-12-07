<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    // Apply middleware in the constructor
    public function __construct()
    {
        // Only allow non-logged-in users to access the login page, logged-in users will be redirected
        $this->middleware('check.login')->only('showLoginForm');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
     // Handle the login request
     public function login(Request $request)
     {
         // Validate the request data
         $this->validateLogin($request);
 
         // Attempt to log in the user
         if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
             return redirect()->intended(route('welcome')); // On successful login, redirect to the intended page
         }
 
          // If login fails
         return back()->withErrors([
             'password' => 'The provided credentials do not match our records.',
         ]);
     }
 
     // Validate login data
     protected function validateLogin(Request $request)
     {
         $request->validate([
             'email' => ['required', 'email'],
             'password' => ['required', 'string'],
         ]);
     }

    // Log out the user
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the current user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect('/'); // Redirect to the homepage or another page
    }
}
