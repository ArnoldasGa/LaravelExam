<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            // dd($request);
        if (!$this->isAdmin($request))
        {
            abort(403);
        }
        return $next($request);
    
    }
    
    public function isAdmin(Request $request) {
        return $request->user() && $request->user()->auth === 'ADMIN';
    }
}

