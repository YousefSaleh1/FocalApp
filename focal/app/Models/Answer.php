<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'question_id',
        'user_id',
    ];

     //This relation, Links the Answer, with it's Question.
     public function question(){

        return $this->belongsTo(Question::class,'question_id');
    }

    //This relation, Links the Answer, with it's User.
    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }
}
