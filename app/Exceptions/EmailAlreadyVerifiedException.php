<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class EmailAlreadyVerifiedException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            "message" => "User email already verified"
        ], 400);
    }
}
