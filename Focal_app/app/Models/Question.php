<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyJob;
use App\Models\Answer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'question',
        'company_job_id',
    ];

    //This relation, Links the Question, with it's Job.
    public function companyjob(){

        return $this->belongsTo(CompanyJob::class,'company_job_id');
    }

    //This relation, Links the Question with their answers, so every Question have many answers.

    public function QuestionAnswers() {

        return $this->hasMany(Answer::class, 'question_id');
    }


}
