<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function postType() {
        return $this->belongsTo(PostType::class);
    }

    public function district() {
        return $this->belongsTo(District::class);
    }
}
