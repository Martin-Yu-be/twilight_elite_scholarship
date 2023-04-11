<?php

namespace App\Policies;

use App\Models\Instruction;
use App\Models\User;

class InstructionPolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->hasRole('管理員')) {
            return true;
        }

        return false;
    }

    public function view(User $user, Instruction $instruction): bool
    {
        if ($user->hasRole('管理員')) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Instruction $instruction): bool
    {
        if ($user->hasRole('管理員')) {
            return true;
        }

        return false;
    }

    public function delete(User $user, Instruction $instruction): bool
    {
        return false;
    }
}
