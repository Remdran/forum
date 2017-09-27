<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/threads/' . $this->id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accepts an array of the reply info
    // Get an instance of the Reply relationship/class, create it with the $reply info
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
}
