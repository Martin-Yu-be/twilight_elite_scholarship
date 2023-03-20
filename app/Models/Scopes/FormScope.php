<?php
 
namespace App\Models\Scopes;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
 
class FormScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();
        $userDistrict = $user->district;
        $userSchool = $user->school;

        if ($userDistrict !== '不分區') {
            if ($userSchool == '不分校') {
                $builder->where('district', $user->district);
            } else {
                $builder->where('district', $user->district)->where('school', $user->school);
            }
        }
    }
}