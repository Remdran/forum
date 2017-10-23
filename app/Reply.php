<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favourites()
    {
        return $this->morphToMany(Favourite::class, 'favourited');
    }

    public function favourite()
    {
        if ( ! $this->favourites()->where(['user_id' => auth()->id()])->exists()) {
            return $this->favourites()->create(['user_id' => auth()->id()]);
        }
    }
}
