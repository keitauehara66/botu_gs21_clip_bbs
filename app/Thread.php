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
    
    public function getCountBookmarksAttribute(): int
    {
        return $this->bookmarks->count();
    }
}