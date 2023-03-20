<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\FormScope;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Form extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'form_number',
        'applier',
        'year',
        'semester',
        'district',
        'school',
        'class',
        'description',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    protected static function booted(): void
    {
        static::created(function (Form $form) {
            $userId = Auth::id();
            $form->users()->attach($userId);
        });

        static::addGlobalScope(new FormScope);

    }
}
