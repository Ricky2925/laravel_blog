<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 检查用户是否已登录
        if (auth()->check()) {
            // 如果已登录，重定向到主页
            return redirect()->route('welcome');  // 这里可以是你希望跳转的任何页面
        }

        // 如果未登录，继续处理请求
        return $next($request);
    }
}
