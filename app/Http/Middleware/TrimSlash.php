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
        $redirects = collect(config('redirects'))->pluck('from')->all();

        if (
            $request->isMethod('get') &&
            $uri !== '/' &&
            preg_match('#/$#', $uri) &&
            !in_array($uri, $redirects, true)
        ) {
            $target = rtrim($uri, '/');
            if ($qs = $request->getQueryString()) {
                $target .= '?' . $qs;
            }
            
            return redirect($target, 301);
        }

        return $next($request);
    }
}
