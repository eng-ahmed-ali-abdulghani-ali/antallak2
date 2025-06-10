<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckClientAuth
{
    public function handle(Request $request, Closure $next)
    {

        // Get the currently authenticated user
        $user = Auth::user();

        //dd($user);
        // If there's no authenticated user, return a 401 Unauthorized response
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Check if the user's role is not 'client'
        // If not, return a 403 Forbidden response
        if ($user->role !== $user::ROLE_CLIENT) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        // Allow the request to proceed further into the application
        return $next($request);
    }
}

