<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidLoginException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Invalid password or email'
        ], 401);
    }
}
