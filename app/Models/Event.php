<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'group_id', 'title', 'description', 'location', 'image', 'date', 'time'];

    //relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'event_id');
    }
    public function feedbacs()
    {
        return $this->hasMany(Feedbac::class, 'event_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
