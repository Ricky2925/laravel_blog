<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login')->only('showRegistrationForm');
    }

    // Show the registration form
    public function showRegistrationForm()
    {
       
        return view('auth.register');
  
    }


    // Handle the registration logic
    public function register(Request $request)
    {
        $messages = [
            'email.unique' => 'The email address is already taken by another user.',
        ];
        
       // Validate registration form data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Check if email is unique
            'password' => ['required', 'string', 'min:8'],
        ],$messages );
        $user = $this->create($request->all());

        auth()->login($user);
        
        return redirect()->route('welcome');
       
    }

    // Custom validation rules
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Create a new user
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
