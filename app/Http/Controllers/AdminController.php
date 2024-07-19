<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ChangeRoleRequest;
use App\Http\Resources\Admin\ChangeRoleResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['changeRole']),
        ];
    }

    public function changeRole(User $user, ChangeRoleRequest $request): ChangeRoleResource
    {
        $currentUser = auth()->user();

        if ($currentUser->role !== 'admin') {
            throw new AuthorizationException('You do not have admin rights to perform this action'); // todo middleware
        } elseif ($user->role === 'admin' && $user->changed_by === null) {
            throw new AuthorizationException('You cannot change the role of this admin');
        } elseif ($user->role === 'admin' && $user->changed_by !== $currentUser->id) {
            throw new AuthorizationException('You do not have the rights to change the role of this user as you did not assign them as an admin');
        }

        $user->role = $request->role;
        $user->changed_by = $currentUser->id;
        $user->save();

        return new ChangeRoleResource($user);
    }
}
