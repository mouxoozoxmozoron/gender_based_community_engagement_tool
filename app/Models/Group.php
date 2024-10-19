<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'admin_id', 'status', 'organisation_id', 'archive', 'legal_docs']; // Fix the typo here


    //relations
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }


    public function group_members()
    {
        return $this->hasMany(Group_Member::class, 'group_id');
    }

    function events(){
        return $this->hasMany(Event::class, 'group_id');
    }

    function posts(){
        return $this->hasMany(Post::class, 'group_id');
    }


    //new for web
    // public function users()
    // {
    //     return $this->hasoMany(User::class, 'group_members', 'group_id', 'user_id');
    // }
    function user(){
        return $this->belongsTo(User::class, 'admin_id');
    }

    function organisation(){
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }


}
