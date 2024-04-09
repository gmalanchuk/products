<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private array $data;

    public function register(): User | string
    {
        $user = new User([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);

        if (!$user->save()) {
            return response()->json(['error' => 'Provide proper details'], 400);  // TODO maybe make an exception
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $user->token = $tokenResult->plainTextToken;

        return $user;
    }

    public function login(): User | string
    {
        if (!Auth::guard('web')->attempt($this->data)) {
            return response()->json([
                'message' => 'Invalid password or email'
            ], 401);
        }  // TODO maybe make an exception

        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token');
        $user->token = $tokenResult->plainTextToken;

        return $user;
    }

    public function setData(array $data): AuthService
    {
        $this->data = $data;
        return $this;
    }
}
