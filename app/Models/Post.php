<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['group_id','description', 'title', 'post_image', 'user_id', 'post_type'];

    //relstions here
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //relation to comments
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    //relatio with likes
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function replies()
    {
        return $this->hasMany(Replie::class, 'comment_id');
    }

    function group(){
        return $this->belongsTo(Group::class, 'group_id');
    }
    // public function replies(){
    //     return $this->hasMany(Replie::class, '');
    // }
}
