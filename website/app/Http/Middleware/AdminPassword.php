<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPassword
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('admin_authenticated')) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
