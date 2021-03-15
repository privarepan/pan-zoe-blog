<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $appends = [
        'wrap_content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getWrapContentAttribute()
    {
        return strip_tags($this->content);
    }

    public function star()
    {
        return $this->morphMany(Star::class, 'star', 'origin_type', 'origin_id');
    }

    public function starWithAuth()
    {
        return $this->morphOne(Star::class, 'star_with_auth', 'origin_type', 'origin_id')
            ->where('user_id', auth()->id());
    }

    public function tag()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comment()
    {
        return $this->hasMany(PostComment::class);
    }

}
