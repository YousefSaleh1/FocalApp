<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessOwner extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'business_owners';

    protected $fillable = [
        'user_id',
        'company_name',
        'company_field',
        'company_size',
        'year_founded',
        'responsible_job_role',
        'company_number',
        'website',
    ];

    //This relation, Links the BusinessOwner with their created jobs, so every BusinessOwner
    //have many created jobs.
    public function jobs() {

        return $this->hasMany(CompanyJob::class, 'business_owner_id');
    }

     //This relation, Links the BusinessOwner, with it's own user information.
     public function User(){

        return $this->belongsTo(User::class,'user_id');
    }



}
