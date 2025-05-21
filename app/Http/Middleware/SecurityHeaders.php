<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $response = $next($request);

    // Seguridad
    $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
    $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
    $response->headers->set('X-Content-Type-Options', 'nosniff');
    $response->headers->set('Referrer-Policy', 'no-referrer');
    $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

    // CSP
    $csp = "default-src 'self'; img-src 'self' data:; script-src 'self' https://cdn.ngrok.com; style-src 'self' https://cdn.ngrok.com;";
    $response->headers->set('Content-Security-Policy', $csp);

    // Cross-Origin policies
    $response->headers->set('Cross-Origin-Embedder-Policy', 'require-corp');
    $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
    $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');

    // CORS
    $origin = $request->headers->get('Origin');

if (in_array($origin, ['http://127.0.0.1:8000', 'http://localhost:8000'])) {
    $response->headers->set('Access-Control-Allow-Origin', $origin);
}

    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

    return $response;
}
}