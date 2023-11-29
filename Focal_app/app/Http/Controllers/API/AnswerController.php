<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\AnswerResource;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    use ApiResponseTrait;

    /*This method will get the questions and their answers
        based on the company_job_id*/

    public function ShowJobQandA($company_job_id)
    {
        $answers = Answer::whereHas('Question', function ($query) use ($company_job_id) {
            $query->where('company_job_id', $company_job_id);
        })->with('Question')->get();

        $answers = AnswerResource::collection($answers);

        return $this->customeRespone($answers,'done!', 200);
    }

    /*  This method will store new answer, for a specifice question, You should
     *  pass the selected question to the method, then it will send the date
     *  with the Api, maybe to show them.
     *  It will pass the following data [answer,question,question_id,company_job_id]
    */


    public function storeAnswer(StoreAnswerRequest $request, $question_id)
    {

        $answer = $request->validated();
        $question = Question::find($question_id);

        $answer = collect([
            'answer' => $answer['answer'],
            'question' => $question,
        ]);

        $user = Auth::user();
        $user_id = $user->id;


        $answer = Answer::Create([
            'answer'        => $answer['answer'],
            'question_id'   => $question_id,
            'user_id'       => $user_id,
        ]);


        return $this->customeRespone($answer,'done!', 201);
    }





    /**
     * This method will show ALL the answers of a specifice question
     * You should pass the question_id to the method
     * It will pass the following data [question,answer,answer_id,user_id,question_id,company_job_id]
     */
    public function showAnswer($question_id)
    {

        $question = Question::where('id', $question_id)->first();

        $answers = $question->QuestionAnswers;

        $answers = AnswerResource::collection($answers);

        return $this->customeRespone($answers,'done!', 200);
    }

    //ss


}
