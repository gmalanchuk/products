<?php

namespace App\Services;

use App\Exceptions\InvalidDetailsException;
use App\Exceptions\InvalidLoginException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private array $data;

    /**
     * @throws InvalidDetailsException
     */
    public function register(): User | string
    {
        $this->data['password'] = Hash::make($this->data['password']); // Hash the password

        $user = new User($this->data);
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
        if (!Auth::attempt($this->data)) { // If the credentials are invalid throw an InvalidLoginException exception
            throw new InvalidLoginException();
        }

        $user = auth()->user();
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
