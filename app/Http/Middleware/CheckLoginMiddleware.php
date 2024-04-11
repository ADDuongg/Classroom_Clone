<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        /* dd(auth()->check(), auth()->user()->role, $role); */
        if (!auth()->check() || auth()->user()->role !== $role) {
            return redirect()->route('login'); // Chuyển hướng về trang chủ hoặc trang không có quyền truy cập
        }

        return $next($request);
    }
}
