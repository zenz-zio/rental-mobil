<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

       $user = \App\Models\User::find(Auth::id());

        // Kalau admin tapi masuk halaman user
        if ($request->is('user/*') || $request->is('user')) {
            if ($user->role !== 'user') {
                return redirect()->route('admin.dashboard');
            }
        }

        // Kalau user tapi masuk halaman admin
        if ($request->is('admin/*') || $request->is('admin')) {
            if ($user->role !== 'admin') {
                return redirect()->route('user.dashboard');
            }
        }

        return $next($request);
    }
}