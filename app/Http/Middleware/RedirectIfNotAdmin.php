<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kalau URL mengandung '/admin' dan user bukan admin, tolak
        if (
            $request->is('admin*') &&  // hanya cek untuk /admin route
            (!Auth::check() || Auth::user()->role !== 'admin')
        ) {
            return redirect('/');
        }

        return $next($request);
    }
}