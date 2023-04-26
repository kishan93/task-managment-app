<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = [
        'title',
        'description',
        'project_id',
        'priority',
        'status',
    ];
}
