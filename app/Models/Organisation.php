<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'organisation_name', 'legal_docs', 'description', 'status', 'archive'];

    public function admins()
    {
        return $this->hasMany(OrganisationAdmin::class, 'organisation_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'organisation_id');
    }

}
