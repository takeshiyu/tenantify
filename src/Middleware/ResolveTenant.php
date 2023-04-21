<?php

namespace Wuhsien\Tenantify\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Wuhsien\Tenantify\Tenancy;

class ResolveTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Tenancy::resolve($request);

        return $next($request);
    }
}
