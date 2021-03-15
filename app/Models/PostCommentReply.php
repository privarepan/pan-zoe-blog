<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postComment()
    {
        return $this->belongsTo(PostComment::class);
    }
}
