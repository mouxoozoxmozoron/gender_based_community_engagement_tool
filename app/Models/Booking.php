<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['token', 'user_id', 'event_id'];

    //relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function events()
    {
        return $this->belongsTo(Booking::class, 'event_id');
    }


}
