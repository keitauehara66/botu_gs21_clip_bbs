<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Thread extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'bookmarks')->withTimestamps();
    }
    
    public function isBookmarkedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->bookmarks->where('id', $user->id)->count()
            : false;
    }

    public function comments(){
        return $this->hasMany('\App\Comment', 'thread_id', 'id');
    }
    
    public function getCountBookmarksAttribute(): int
    {
        return $this->bookmarks->count();
    }
    
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag', 'thread_tag')->withTimestamps();
    }
    
    public function getCountCommentsAttribute(): int
    {
        return $this->comments->count();
    }
}
