<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CannotChangeAdminRoleException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'You can\'t change role of another admin'
        ], 403);
    }
}
