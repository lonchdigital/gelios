<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ForceLocalePrefix
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $currentUri = $request->getRequestUri();
    
        if ($locale === 'ru' && str_starts_with($currentUri, '/ru')) {
            $newUri = str_replace('/ru', '', $currentUri);
            
            if ($newUri !== $currentUri) {
                return redirect($newUri, 302);
            }
        }
    
        return $next($request);
    }
}
