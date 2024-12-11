<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth class
class LoginController extends Controller
{
    
    public function showLoginForm()
    {
        
         // Check if the admin is already logged in
         if (Auth::guard('admin')->check()) {
		 $user = Auth::guard('admin')->user();
		 if ($user->is_admin == 1) {
                // If already logged in, redirect to the admin dashboard
            return redirect()->route('admin.dashboard');
            }
            
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Validate the login request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Get the credentials from the request
        $credentials = $request->only('email', 'password');

         // Use the admin guard to authenticate the credentials
        if (Auth::guard('admin')->attempt($credentials)) {
            // Get the currently logged-in user
            $user = Auth::guard('admin')->user();

            // Check if the user is an admin
            if ($user->is_admin == 1) {
                // If the user is an admin, redirect to the admin dashboard
                return redirect()->route('admin.dashboard');
            }

             // If the user is not an admin, log them out and return an error
            Auth::guard('admin')->logout();
            return back()->withErrors([
                'email' => 'You are not authorized to access this area.',
            ]);
        }

        // If the user is not an admin, log them out and return an error
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
