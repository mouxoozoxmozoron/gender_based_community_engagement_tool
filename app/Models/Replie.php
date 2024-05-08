<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replie extends Model
{
    use HasFactory;
    protected $fillable = ['message', 'user_id', 'comment_id'];

    //relations to comment
    public function replie()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
