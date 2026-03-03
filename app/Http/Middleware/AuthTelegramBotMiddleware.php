<?php

namespace App\Http\Middleware;

use App\Models\MybotSecure;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthTelegramBotMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');

        if (!$apiKey) {
            return response()->json(['error' => 'Unauthorized: Missing credentials'], 401);
        }

        $secureEntry = MybotSecure::where('api_key', $apiKey)->first();
        if (!$secureEntry || $secureEntry->api_key !== $apiKey) {
            return response()->json(['error' => 'Forbidden: Invalid API Key or Bot ID'], 403);
        }

        $request->attributes->add(['current_bot' => $secureEntry->bot]);

        return $next($request);
    }
}
