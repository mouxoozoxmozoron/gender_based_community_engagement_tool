<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['message', 'user_id', 'post_id'];

    //relation to post
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    //rtlatio with replies
    public function replies()
    {
        return $this->hasMany(Replie::class, 'comment_id');
    }
}
