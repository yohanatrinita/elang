<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
    if (! $request->expectsJson()) {
        session()->flash('warning', 'Kamu harus login dulu untuk mengakses halaman ini.');
        return route('login.form');
    }
    }

}

