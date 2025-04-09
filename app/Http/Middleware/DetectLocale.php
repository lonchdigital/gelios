<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class DetectLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentPath = trim($request->path(), '/');

        $firstSegment = explode('/', $currentPath)[0];

        if(!in_array($firstSegment, ['ua', 'en'])) {
            Session::put('locale', 'ru');

            $firstSegment = 'ru';
        }

        app()->setLocale($firstSegment);

        return $next($request);
    }
}
