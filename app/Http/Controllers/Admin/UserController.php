<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // 显示所有用户
    public function index()
    {
        $users = User::all();  // 或者根据需要进行分页 User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 显示添加用户表单
    public function create()
    {
        return view('admin.users.create');
    }

    // 存储新用户
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',  // 确保密码字段有确认
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->is_admin = $request->has('is_admin') ? 1 : 0;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
    }

    // 显示用户编辑表单
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // 更新用户信息
    public function update(Request $request, User $user)
    {
      
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,  // 排除当前用户的 email
            'password' => 'nullable|min:6',  // 如果提供新密码，进行验证
        ]);
        
         // 更新用户信息
         $user->name = $validated['name'];
         $user->email = $validated['email'];
 
         // 如果提供了新密码，则更新密码
         if ($request->filled('password')) {
             $user->password = Hash::make($validated['password']);
         }
 
         // 如果是管理员字段需要更新
         $user->is_admin = $request->has('is_admin') ? 1 : 0;
 
         // 保存更新
         $user->save();
 
         // 返回更新成功的消息
         return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // 删除用户
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
