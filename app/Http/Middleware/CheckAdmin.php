<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
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
