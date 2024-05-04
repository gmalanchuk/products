<?php

namespace App\Services;


use App\Exceptions\EmailAlreadyVerifiedException;
use App\Exceptions\InvalidOrExpiredUrlException;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailService
{
    /**
     * @throws InvalidOrExpiredUrlException
     */
    public function verify($user_id, Request $request): JsonResponse
    {
        if (!$request->hasValidSignature()) {
            throw new InvalidOrExpiredUrlException();
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return response()->json([
            'message' => 'Email verified successfully'
        ], 200);
    }

    /**
     * @throws EmailAlreadyVerifiedException
     */
    public function resend(): JsonResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            throw new EmailAlreadyVerifiedException();
        }

        auth()->user()->sendEmailVerificationNotification(); // todo make a job

        return response()->json([
            "message" => "Email verification link sent on your email id"
        ], 200);
    }
}
