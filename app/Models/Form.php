<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\FormScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Form extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'form_number',
        'applier',
        'year',
        'semester',
        'district',
        'school',
        'class',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Form $form) {
           // 產生 form 流水號
           $lastForm = Form::orderBy('created_at','desc')->first();
        //    Log::info($lastForm->id);

          if (is_null($lastForm)) {
            $form->form_number = 'TL'.(date("Y")-1911).date('m').str_pad(1, 3, "0", STR_PAD_LEFT);
            return;
           }

           if (date('m', strtotime($lastForm->created_at)) === date('m')) {
                $lastFormNumber = substr($lastForm->form_number, -3);
            } else {
                $lastFormNumber = 0;
            }

            $form->form_number = 'TL'.(date("Y")-1911).date('m').str_pad((int)$lastFormNumber + 1, 3, "0", STR_PAD_LEFT);
        });

    }
}
