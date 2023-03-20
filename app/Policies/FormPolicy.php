<?php

namespace App\Policies;

use App\Models\Form;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class FormPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRole('Admin') || $user->hasPermissionTo('view form') || $user->hasPermissionTo('create form')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Form $form): bool
    {
        // Used scope to define view authorizaton for each record because here only offers "view button" visibility option
        // See Model/Scopes/FormScope for detailed setting
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $userForm = $user->forms()->exists();
        
        if ($user->hasRole('Admin') || !$userForm && $user->hasPermissionTo('create form')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Form $form): bool
    {
        $userId = $user->id;
        $userSchool = $user->school;
        $userDistrict = $user->district;
        $formUserId = $form->users()->where('user_id', $userId)->exists();
        $formSchool = $form->school;
        $formDistrict = $form->district;

        // if ($user->hasRole('學生') && $formUserId) { // 學生可改自己
        //     return true;
        // } else if ($user->hasRole('輔導幹部') && $userDistrict === $formDistrict && $userSchool === $formSchool) { // 校級幹部 可改自校
        //     return true;
        // } else if ($user->hasRole('輔導幹部') && $userDistrict === $formDistrict && $userSchool == '不分校') { // 區級幹部 可改自區
        //     return true;
        // } else if ($user->hasRole('輔導幹部') && $userDistrict == '不分區' && $userSchool == '不分校') { // 會級幹部 可改全區全校
        //     return true;
        // }

        $result = match (true) {
            $user->hasRole('Admin'),
            $user->hasRole('學生') && $formUserId => true, // 學生 可改自己
            $user->hasRole('輔導幹部') && $userDistrict === $formDistrict && $userSchool === $formSchool => true, // 校級幹部 可改自校
            $user->hasRole('輔導幹部') && $userDistrict === $formDistrict && $userSchool == '不分校' => true, // 區級幹部 可改自區
            $user->hasRole('輔導幹部') && $userDistrict == '不分區' && $userSchool == '不分校' => true, // 會級幹部 可改全區全校
            default => false,
        };

        return $result;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Form $form): bool
    {
        if ($user->hasRole('Admin')) {
            return true;
        }

        return false;
    }
}
