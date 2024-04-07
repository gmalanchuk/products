<?php

namespace App\Http\Controllers;


use App\Facades\AuthFacade;
use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
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
        $token = AuthFacade::setData($request->validated())->register();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);  // TODO maybe make a resource
    }

    public function login(LoginAuthRequest $request)
    {
        $token = AuthFacade::setData($request->validated())->login();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);  // TODO maybe make a resource
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([], 204);
    }
}
