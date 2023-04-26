<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToUser;

class Project extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = [
        'title',
        'description',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
