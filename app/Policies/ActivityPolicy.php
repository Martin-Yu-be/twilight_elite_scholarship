<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

class ActivityPolicy
{
    use HasRoles;

    public function viewAny(User $user): bool
    {
        if ($user->hasRole('管理員')) {
            return true;
        }

        return false;
    }

    public function view(User $user): bool
    {
        if ($user->hasRole('管理員')) {
            return true;
        }

        return false;
    }
}
