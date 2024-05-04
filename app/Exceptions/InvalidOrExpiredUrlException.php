<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidOrExpiredUrlException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Invalid or expired url provided'
        ], 401);
    }
}
