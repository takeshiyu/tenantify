<?php

namespace Wuhsien\Tenantify\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
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

        $cookieName = Str::snake(Tenancy::slug()).'_session';
        Session::setName($cookieName);
        Config::set('session.cookie', $cookieName);

        return $next($request);
    }
}
