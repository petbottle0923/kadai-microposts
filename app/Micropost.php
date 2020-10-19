<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    //
    protected $fillable = ['content'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function favorite_user()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }
}
