<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    
    // 显示后台首页
    public function index()
    {
        $users = User::all();  // 或者根据需要进行分页 User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 其他后台功能方法可以继续添加
}
