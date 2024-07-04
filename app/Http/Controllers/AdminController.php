<?php

namespace App\Http\Controllers;

use App\Exceptions\CannotChangeAdminRoleException;
use App\Http\Middleware\AdminOnly;
use App\Http\Requests\Admin\ChangeRoleRequest;
use App\Http\Resources\Admin\ChangeRoleResource;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['changeRole']),
            new Middleware(AdminOnly::class, only: ['changeRole']),
        ];
    }

    public function changeRole(User $user, ChangeRoleRequest $request)
    {
        if ($user->role === 'admin') {
            if ($user->id !== auth()->id()) {
                throw new CannotChangeAdminRoleException();
            }
        }

        $user->role = $request->role;
        $user->save();

        return new ChangeRoleResource($user);
    }
}
