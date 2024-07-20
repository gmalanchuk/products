<?php

namespace App\Http\Controllers;


use App\Exceptions\InvalidDetailsException;
use App\Exceptions\InvalidLoginException;
use App\Facades\AuthFacade;
use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Http\Resources\Auth\TokenResource;
use App\Jobs\UserEmailVerificationJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['logout']),
        ];
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Authentication"},
     *     @OA\Response(response="201", description="Return created user data and token")
     * )
     * @throws InvalidDetailsException
     */
    public function register(RegisterAuthRequest $request): TokenResource
    {
        $user = AuthFacade::setData($request->validated())->register();

        UserEmailVerificationJob::dispatch($user); // send email verification link

        return new TokenResource($user->token);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Authentication"},
     *     @OA\Response(response="200", description="Return user data and token")
     * )
     * @throws InvalidLoginException
     */
    public function login(LoginAuthRequest $request): TokenResource
    {
        $user = AuthFacade::setData($request->validated())->login();
        return new TokenResource($user->token);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Authentication"},
     *     @OA\Response(response="204", description="No content")
     * )
     */
    public function logout(Request $request): Response
    {
        $request->user()->tokens()->delete();
        return response()->noContent();
    }
}
