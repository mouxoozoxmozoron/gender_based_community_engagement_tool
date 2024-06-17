<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_Member extends Model
{

    protected $table = 'group_members';

    use HasFactory;

    protected $fillable = ['user_id', 'group_id'];

    //relations
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    //extra for web
    public function groupusers()
    {
        return $this->hasMany(User::class, 'id');
    }

}
