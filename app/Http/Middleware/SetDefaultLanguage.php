<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetDefaultLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( !$request->session()->has('locale') ) {
            app()->setLocale('ua');
            $request->session()->put('locale', 'ua');
        } else if( $request->session()->get('locale') === 'ru' ) {
            app()->setLocale('ua');
            $request->session()->put('locale', 'ua');
        } else {
            app()->setLocale($request->session()->get('locale'));
        }

        return $next($request);
    }
}
