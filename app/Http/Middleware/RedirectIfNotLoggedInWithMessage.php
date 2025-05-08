<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotLoggedInWithMessage
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            session()->flash('warning', '⚠️ Kamu harus login dulu untuk mengakses halaman ini.');
            return redirect()->route('login.form');
        }

        return $next($request);
    }
}
