<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $guarded = [];

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
