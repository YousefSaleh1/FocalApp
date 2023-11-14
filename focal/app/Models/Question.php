<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\Answer;


class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'company_job_id',
    ];

    //This relation, Links the Question, with it's Job.
    public function job(){

        return $this->belongsTo(Job::class,'company_job_id' , 'id');
    }


    //This relation, Links the Question with their answers, so every Question have many answers.

    public function QuestionAnswers() {

        return $this->hasMany(Answer::class, 'question_id');
    }


}
