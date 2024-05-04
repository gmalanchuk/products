<?php

namespace App\Http\Controllers;

use App\Facades\EmailFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class EmailController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['resend']),
        ];
    }

    public function verify($user_id, Request $request): JsonResponse
    {
        return EmailFacade::verify($user_id, $request);
    }

    public function resend(): JsonResponse
    {
        return EmailFacade::resend();
    }
}
