<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userrole = auth()->user()->role;
        if($userrole == 'admin'){
            return $next($request);
        }
        elseif($userrole == 'client'){
            return redirect()->route('client-dashboard');
        }
        else{
            return redirect()->route('provider-dashboard');
        }
    }
}
