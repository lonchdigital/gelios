<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrimRouteSuffix
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->secure() && config('app.env') !== 'local') {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        if($request->is('admin*')) {
            return $next($request);
        }

        $path = $request->path();
        $allowedSuffixes = [
            'index.php',
            'home.php',
            'index.html',
            'home.html',
            'index.htm',
            'home.htm',
            'home',
        ];

        foreach ($allowedSuffixes as $suffix) {
            if (str_ends_with($path, $suffix) ) {
                $path = rtrim($path, '/' . $suffix);

                if($path == '/') {
                    return redirect(config('app.url'), 301);
                }

                return redirect(config('app.url') . '/' . $path, 301);
            }
        }

        $segments = $request->segments();

        $lastSegment = end($segments);

        if (is_numeric($lastSegment)) {
            array_pop($segments);

            $newUrl = implode('/', $segments);

            return redirect(config('app.url') . '/' . $newUrl, 301);
        }

        if (strpos($request->getHost(), 'www.') === 0) {
            return redirect()->to(
                $request->getScheme() . '://' . preg_replace('/^www\./', '', $request->getHost()) . $request->getRequestUri(),
                301
            );
        }

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
