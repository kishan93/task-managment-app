<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;

class SelectedProjectScope implements Scope
{
    public function apply($builder, $model)
    {
        if (session()->has('project_id')) {
            $builder->where('project_id', session()->get('project_id'));
        }
    }
}
