<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'You are not authorized'
            ], 401);
        }

        if (auth()->user()?->role !== 'admin') {
            return response()->json([
                'message' => 'You do not have admin rights to perform this action'
            ], 403);
        }

        return $next($request);
    }
}
