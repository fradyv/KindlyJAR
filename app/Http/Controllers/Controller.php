<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function authUser(): User
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        return $user;
    }

    protected function authUserFromRequest(Request $request): User
    {
        $user = $request->user();

        if (! $user instanceof User) {
            abort(403);
        }

        return $user;
    }
}
