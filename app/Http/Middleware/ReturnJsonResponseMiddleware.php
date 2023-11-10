<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\V2\CountryController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReturnJsonResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // TODO: Solve this somehow more elegant
        if($request->route()->getName() && preg_match('/countries\./', $request->route()->getName())) {
            $request->headers->set('Accept', 'application/json');
        }
        return $next($request);
    }
}
