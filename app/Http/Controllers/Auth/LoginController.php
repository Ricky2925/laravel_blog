<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    // 在构造函数中应用中间件
    public function __construct()
    {
        // 只让未登录的用户访问登录页面，已登录用户会被重定向
        $this->middleware('check.login')->only('showLoginForm');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
     // 处理登录请求
     public function login(Request $request)
     {
         // 验证请求数据
         $this->validateLogin($request);
 
         // 尝试登录用户
         if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
             return redirect()->intended(route('welcome')); // 登录成功，重定向到原定页面
         }
 
         // 如果登录失败
         return back()->withErrors([
             'password' => 'The provided credentials do not match our records.',
         ]);
     }
 
     // 验证登录数据
     protected function validateLogin(Request $request)
     {
         $request->validate([
             'email' => ['required', 'email'],
             'password' => ['required', 'string'],
         ]);
     }

    // 注销用户
    public function logout(Request $request)
    {
        Auth::logout(); // 注销当前用户
        $request->session()->invalidate(); // 清空会话
        $request->session()->regenerateToken(); // 重新生成 CSRF token

        return redirect('/'); // 重定向到首页或其他页面
    }
}
