<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationAdmin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'organisation_id', 'position'];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }
}

