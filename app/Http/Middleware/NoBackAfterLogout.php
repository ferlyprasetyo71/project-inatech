<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NoBackAfterLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        }
        return redirect()->route('login.index');
        // return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        //                 ->header('Pragma', 'no-cache')
        //                 ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }
}
