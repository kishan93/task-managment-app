<?php

namespace App\Models;

use App\Scopes\SelectedProjectScope;
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
        'user_id',
        'priority',
        'status',
    ];

    protected $casts = [
    ];

    protected $appends = [
        'created_ago',
    ];

    public function getCreatedAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SelectedProjectScope());
    }
}
