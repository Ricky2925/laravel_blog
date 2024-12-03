<?php

// app/Http/Middleware/AdminAuth.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        // 检查用户是否已登录且是管理员
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            
            if ($user->is_admin == 1) {
                // 如果是管理员，继续请求
                return $next($request);
            }
        }

        // 如果未登录或不是管理员，跳转到登录页面
        return redirect()->route('admin.login');
    }
}
