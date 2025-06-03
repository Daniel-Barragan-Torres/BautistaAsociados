<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RolePermissions
{
    public static function hasPermission(string $permission): bool
    {
        $user = Auth::user();

        if (!$user || !$user->role?->nombre) {
            return false;
        }

        $roleName = $user->role->nombre;
        $permissions = config('roles_permissions')[$roleName] ?? [];

        return $permissions[$permission] ?? false;
    }
}
