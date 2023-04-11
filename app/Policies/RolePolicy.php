<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('管理員');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->hasRole('管理員');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('管理員');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->hasRole('管理員');
    }

    public function delete(User $user, Role $role): bool
    {
        return false;
    }
}