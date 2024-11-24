<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CareerOfficeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('api')->user();

        // Check if user is authenticated and has the student role
        if (!$user || $user->role_id !== \App\Models\User::ROLE_CAREEROFFICE) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
