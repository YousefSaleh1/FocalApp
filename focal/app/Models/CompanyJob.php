<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyJob extends Model
{
    use HasFactory;

    protected $fillable = [

        'business_owner_id',
        'job_title',
        'job_role',
        'job_level',
        'experience',
        'education_level',
        'language',
        'age_range',
        'gender',
        'job_type',
        'city_id',
        'address',
        'work_hour',
        'salary_range',
        'help',
        'job_description',
        'job_requirement',
        'status',
        'cancel_desc',

    ];

    //This relation, Links the created job, with it's BusinessOwner.
    public function owner(){

        return $this->belongsTo(BusinessOwner::class,'business_owner_id');
    }

    //This relation, Links the Job with their questions, so every Job
    //have many Question.
    public function questions() {

        return $this->hasMany(Question::class, 'company_job_id' , 'id');
    }

    public function city(){

        return $this->belongsTo(City::class,'city_id' , 'id');
    }
}
