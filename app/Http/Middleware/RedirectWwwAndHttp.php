<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectWwwAndHttp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Don't redirect in local environments to prevent breaking localhost
        if (app()->environment('local') || str_contains($request->getHost(), 'localhost') || str_contains($request->getHost(), '127.0.0.1')) {
            return $next($request);
        }

        $host = $request->getHost();
        $isWww = str_starts_with($host, 'www.');
        $isHttp = !$request->secure();

        if ($isWww || $isHttp) {
            $newHost = $isWww ? substr($host, 4) : $host;
            $newUrl = 'https://' . $newHost . $request->getRequestUri();
            return redirect()->to($newUrl, 301);
        }

        return $next($request);
    }
}
