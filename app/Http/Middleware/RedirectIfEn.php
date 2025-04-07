<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfEn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->getLocale() == 'en') {
            $url = $request->getRequestUri();
            $uaUrl = str_replace('/en', '/ua', $url);

            return redirect()->to($uaUrl, 301);
        }

        return $next($request);
    }
}
