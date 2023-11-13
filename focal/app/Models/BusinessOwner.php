<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\User;

class BusinessOwner extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_name',
        'company_field',
        'company_size',
        'year_founded',
        'company_logo',
        'responsible_job_role',
        'company_number',
        'website',
    ];

    //This relation, Links the BusinessOwner with their created jobs, so every BusinessOwner
    //have many created jobs.
    public function jobs() {

        return $this->hasMany(Job::class, 'business_owner_id');
    }

     //This relation, Links the BusinessOwner, with it's own user information.
     public function User(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function city(){

        return $this->belongsTo(City::class,'city_id');
    }

}
