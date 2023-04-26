<?php

namespace App\Scopes;

class BelongsToUserScope implements \Illuminate\Database\Eloquent\Scope
{
    public function apply($builder, $model)
    {
        if (auth()->check()) {
            $builder->where('user_id', auth()->id());
        }
    }
}
