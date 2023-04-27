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
        'user_id',
    ];

    protected $appends = [
        'created_ago',
    ];

    public function getCreatedAgoAttribute()
    {
        return $this->created_at?->diffForHumans();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
