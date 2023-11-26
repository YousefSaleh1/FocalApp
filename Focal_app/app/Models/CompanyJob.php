<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BusinessOwner;
use App\Models\Question;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;

class CompanyJob extends Model implements CanVisit
{
    use HasFactory;
    use HasVisits;

protected $table='company_jobs';
    protected $fillable = [
        'business_owners_id',
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
        'help',
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

        return $this->belongsTo(BusinessOwner::class,'business_owner_id');
    }

    //This relation, Links the Job with their questions, so every Job
    //have many Question.
    public function questions() {

        return $this->hasMany(Question::class, 'job_id');
    }


}
