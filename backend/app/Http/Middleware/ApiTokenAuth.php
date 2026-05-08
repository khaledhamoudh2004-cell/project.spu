<?php

namespace App\Http\Middleware;

use App\Models\ApiSession;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $session = ApiSession::query()
            ->where('token_hash', hash('sha256', $token))
            ->whereNull('revoked_at')
            ->where(function ($query): void {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->with('user')
            ->first();

        if (! $session || ! $session->user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $session->update(['last_used_at' => now()]);
        $request->attributes->set('apiSession', $session);
        $request->setUserResolver(fn () => $session->user);
        Auth::setUser($session->user);

        return $next($request);
    }
}
