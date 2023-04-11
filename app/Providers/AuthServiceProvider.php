<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\ActivityPolicy;
use App\Policies\FormPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Activity::class => ActivityPolicy::class,
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        Form::class => FormPolicy::class,
    ];
}
