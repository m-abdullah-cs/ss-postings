<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isProvider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            // Not authenticated, redirect to home
            return redirect('/');
        }
        $role = auth()->user()->role;
        if($role == 'provider'){
            return $next($request);
        }else{
            return back()->with('error', 'You are not authorized to access this page.');
        }
    }
}
