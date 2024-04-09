<?php

namespace App\Services;

use App\Exceptions\InvalidDetailsException;
use App\Exceptions\InvalidLoginException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private array $data;

    /**
     * @throws InvalidDetailsException
     */
    public function register(): User | string
    {
        $user = new User([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);

        if (!$user->save()) {
            throw new InvalidDetailsException();
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $user->token = $tokenResult->plainTextToken;

        return $user;
    }

    /**
     * @throws InvalidLoginException
     */
    public function login(): User | string
    {
        if (!Auth::guard('web')->attempt($this->data)) {
            throw new InvalidLoginException();
        }

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
