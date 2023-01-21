<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin_login');
        }
    }
}
