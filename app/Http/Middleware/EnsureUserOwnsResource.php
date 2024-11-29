<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserOwnsResource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        // if ($request->route('id')->user_id !== auth()->id()) {
        //     abort(403, 'Unauthorized access.');
        // }

        
        // if ($resource->user_id !== auth()->id()) {
        //     abort(403, 'Unauthorized access.');
        // }

        return $next($request);
    }
}
