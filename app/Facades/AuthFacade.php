<?php

namespace App\Facades;

use App\Services\AuthService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static AuthService register()
 * @method static AuthService login()
 * @method static AuthService setData(array $data)
 */
class AuthFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'auth-service';
    }
}
