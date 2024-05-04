<?php

namespace App\Facades;

use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

/**
 * @method static EmailService verify($user_id, Request $request)
 * @method static EmailService resend()
 */
class EmailFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'email-service';
    }
}
