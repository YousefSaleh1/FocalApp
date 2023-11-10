<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BusinessOwner;
use App\Models\Question;

class Job extends Model
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
        'city',
        'address',
        'work_hour',
        'salary_range',
        'job_discription',
        'job_requirement',
        'status',
        'cancel_desc',
       
    ];

    //This relation, Links the created job, with it's BusinessOwner.
    public function owner(){

        return $this->belongsTo('BusinessOwner::class','owner_id');
    }

    //This relation, Links the Job with their questions, so every Job 
    //have many Question.
    public function questions() {

        return $this->hasMany('Question::class', 'job_id');
    }
      

}
