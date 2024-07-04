<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ChangeRoleRequest;
use App\Http\Resources\Admin\ChangeRoleResource;
use App\Models\User;

class AdminController extends Controller
{
    public function changeRole(User $user, ChangeRoleRequest $request)
    {
        if ($user->role === 'admin') {
            if ($user->id !== auth()->id()) {
                return response()->json(['message' => 'You can\'t change role of another admin'], 403); // todo exception
            }
        }

        $user->role = $request->role;
        $user->save();

        return new ChangeRoleResource($user);
    }
}
