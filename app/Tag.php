<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'tagname',
    ];
    
    public function getHashtagAttribute(): string
    {
        return '#' . $this->tagname;
    }
    
    public function threads(): BelongsToMany
    {
        return $this->belongsToMany('App\Thread', 'thread_tag')->withTimestamps();
    }
}
