<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidDetailsException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json(['error' => 'The details provided are invalids'], 400);
    }
}
