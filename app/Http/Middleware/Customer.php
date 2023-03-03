<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // dd($request);
        if (!$this->isCustomer($request))
        {
            abort(403);
        }
        return $next($request);

    }

    public function isCustomer(Request $request) {
        return $request->user() && $request->user()->auth === 'CUSTOMER';
    }
}
