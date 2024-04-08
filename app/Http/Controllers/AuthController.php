<?php

namespace App\Http\Controllers;


use App\Facades\AuthFacade;
use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Http\Resources\Auth\TokenResource;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;
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

    public function register(RegisterAuthRequest $request)
    {
        $user = AuthFacade::setData($request->validated())->register();
        return (new UserResource($user))->additional([
            'token' => new TokenResource($user),
        ]);
    }

    public function login(LoginAuthRequest $request)
    {
        $user = AuthFacade::setData($request->validated())->login();
        return (new UserResource($user))->additional([
            'token' => new TokenResource($user),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([], 204);
    }
}
