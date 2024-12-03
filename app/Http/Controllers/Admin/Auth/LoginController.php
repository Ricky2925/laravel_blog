<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 导入 Auth 类
class LoginController extends Controller
{
    
    public function showLoginForm()
    {
        
         // 检查管理员是否已登录
         if (Auth::guard('admin')->check()) {
		 $user = Auth::guard('admin')->user();
		 if ($user->is_admin == 1) {
                // 如果已登录，重定向到后台首页
            return redirect()->route('admin.dashboard');
            }
            
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // 验证登录请求的数据
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 获取凭据
        $credentials = $request->only('email', 'password');

        // 使用 admin guard 来验证凭据
        if (Auth::guard('admin')->attempt($credentials)) {
            // 获取当前登录的用户
            $user = Auth::guard('admin')->user();

            // 检查该用户是否是管理员
            if ($user->is_admin == 1) {
                // 如果是管理员，重定向到后台首页
                return redirect()->route('admin.dashboard');
            }

            // 如果用户不是管理员，登出并返回错误信息
            Auth::guard('admin')->logout();
            return back()->withErrors([
                'email' => 'You are not authorized to access this area.',
            ]);
        }

        // 登录失败，返回登录页面并显示错误信息
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
