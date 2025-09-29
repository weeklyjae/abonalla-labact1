<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // If specific roles are provided, ensure the user's role matches any of them
        if (!empty($roles)) {
            if (!$user || !in_array($user->role, $roles, true)) {
                return redirect()->route('error');
            }
        }

        return $next($request);
    }
}
