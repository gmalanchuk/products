<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Requests\Admin\ChangeRoleRequest;
use App\Http\Resources\Admin\ChangeRoleResource;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;


class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['changeRole']),
            new Middleware(IsAdminMiddleware::class, only: ['changeRole']),
        ];
    }

    public function changeRole(User $user, ChangeRoleRequest $request): ChangeRoleResource
    {
        Gate::authorize('changeRole', $user);

        $user->update([
            'role' => $request->role,
            'changed_by' => auth()->id(),
        ]);

        return new ChangeRoleResource($user);
    }
}
