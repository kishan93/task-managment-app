<?php

namespace App\Traits;

use App\Scopes\BelongsToUserScope;

trait BelongsToUser
{
    protected static function bootBelongsToUser()
    {
        static::addGlobalScope(new BelongsToUserScope);
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->user_id = auth()->id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
