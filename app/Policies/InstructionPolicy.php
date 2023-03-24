<?php

namespace App\Policies;

use App\Models\Instruction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InstructionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Instruction $instruction): bool
    {

        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasRole('Admin') && is_null(Instruction::first())) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Instruction $instruction): bool
    {
        if ($user->hasRole('Admin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Instruction $instruction): bool
    {
        if ($user->hasRole('Admin')) {
            return true;
        }

        return false;
    }
}
