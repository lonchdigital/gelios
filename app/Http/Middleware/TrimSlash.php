<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrimSlash
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uri = $request->getRequestUri();

        if ($request->isMethod('get') && $uri !== '/' && preg_match('#/$#', $uri)) {
            $target = rtrim($uri, '/');

            $qs = $request->getQueryString();
            if ($qs) {
                $target .= '?' . $qs;
            }

            return redirect($target, 301);
        }

        return $next($request);
    }
}
