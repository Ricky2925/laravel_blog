<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // Display all users
    public function index()
    {
        $users = User::all();  // You can also paginate users if needed: User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Show the add user form
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed',  // Ensure the password confirmation field is present
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->is_admin = $request->has('is_admin') ? 1 : 0;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
    }

    // Show the user edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user information
    public function update(Request $request, User $user)
    {
      
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,  // Exclude the current user's email from uniqueness check
            'password' => 'nullable|min:6',  // If a new password is provided, validate it
        ]);
        
         // Update user information
         $user->name = $validated['name'];
         $user->email = $validated['email'];
 
          // If a new password is provided, update it
         if ($request->filled('password')) {
             $user->password = Hash::make($validated['password']);
         }
 
         // Update the admin status if provided
         $user->is_admin = $request->has('is_admin') ? 1 : 0;
 
         // Save the updated user
         $user->save();
 
         // Return a success message
         return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
