<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    
    // Display the admin dashboard (or homepage)
    public function index()
    {
        $users = User::all();  // Retrieve all users (or paginate if needed: User::paginate(10));
        return view('admin.users.index', compact('users'));// Return a view with users data
    }


}
