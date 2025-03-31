<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LowercaseUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('X-Livewire')) {
            return $next($request);
        }

        $extension = pathinfo($request->path(), PATHINFO_EXTENSION);

        $excludedExtensions = [
            'xml', 'json', 'png', 'jpg', 'jpeg', 'gif', 'bmp',
            'ico', 'tiff', 'webp', 'svg', 'css', 'js', 'woff',
            'woff2', 'eot', 'ttf', 'otf', 'mp3', 'wav', 'mp4',
            'avi', 'mov', 'ogg', 'ogv', 'webm', 'pdf', 'doc',
            'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar',
            '7z', 'tar', 'gz', 'exe', 'dll', 'bat', 'sh',
        ];

        if (!in_array($extension, $excludedExtensions)) {
            $path = urldecode($request->path());

            if (preg_match('/[A-Z]/', $path)) {

                $lowercaseUrl = strtolower($path);

                // if (!str_ends_with($lowercaseUrl, '/') && empty($request->query())) {
                //     $lowercaseUrl .= '/';
                // }

                if (!empty($request->query())) {
                    $lowercaseUrl .= '?' . http_build_query($request->query());
                }

                return redirect()->away(config('app.url') . '/' . $lowercaseUrl, 301);
            }
        }

        return $next($request);
    }
}
