<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'image',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function thread(): BelongsTo
    {
        return $this->belongsTo('App\Thread', 'thread_id');
    }
    
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }
    
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }
    
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

}
