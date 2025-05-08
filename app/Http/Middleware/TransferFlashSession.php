<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TransferFlashSession
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('warning_next')) {
            session()->flash('warning', session('warning_next'));
            session()->forget('warning_next');
        }

        return $next($request);
    }
}
