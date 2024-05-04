<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailService
{
    public function verify($user_id, Request $request): JsonResponse
    {
        if (!$request->hasValidSignature()) {
            return response()->json(['message' => 'Invalid or expired url provided'], 401);  // todo make an exception
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return response()->json([
            'message' => 'Email verified successfully'
        ], 200);
    }

    public function resend(): JsonResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(["message" => "User email already verified"], 400); // todo make an exception
        }

        auth()->user()->sendEmailVerificationNotification(); // todo make a job

        return response()->json([
            "message" => "Email verification link sent on your email id"
        ], 200);
    }
}
