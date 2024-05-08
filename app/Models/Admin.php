<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'group_id'];

    //relations
    public function groups()
    {
        return $this->hasMany(Group::class, 'admin_id');
    }

}
