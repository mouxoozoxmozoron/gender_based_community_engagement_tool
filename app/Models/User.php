<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['phone', 'photo', 'email', 'password', 'first_name', 'last_name', 'user_type', 'gender'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Relation here
    public function pots()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    //relation with likes
    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    //relations with replies
    public function replies()
    {
        return $this->hasMany(Replie::class, 'user_id');
    }
    public function user_type()
    {
        return $this->belongsTo(user_type::class, 'user_type');
    }

    public function groupMembership()
    {
        return $this->hasMany(Group_Member::class, 'user_id');
    }

    //testing for web
    public function groupMembershipp()
    {
        return $this->belongsTo(Group_Member::class, 'user_id');
    }


    //new for web
    // public function groups()
    // {
    //     return $this->belongsToMany(Group::class, 'group_members', 'user_id', 'group_id');
    // }
}
