<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\QuestionResource;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Answer;
use App\Models\CompanyJob;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
     public function index($company_job_id)
    {
        $questions = Question::whereHas('Answer', function ($query) use ($company_job_id) {
            $query->where('company_job_id', $company_job_id);
        })->with('Answer')->get();

       $questions = QuestionResource::collection($questions);

       return $this->apiResponse($questions,NULL,'done!',200);

    }


    /**
     * Store a newly created resource in storage.
     */

        public function storeQuestion(StoreQuestionRequest $request,$answer_id)
    {

        $question = $request->validated();
        $answer = Answer::find($answer_id);

        $question = collect([
            'question' => $question['question'],
            'answer' => $answer,
        ]);

       // $user = Auth::user();



       $question = Question::Create([
        'question'=> $question['question'],
        'answer_id'=> $answer_id,

       ]);


        return $this->apiResponse($question,NULL,'done!',201);

    }

    public function showQuestion($answer_id)
    {

        $answer = Answer::where('id',$answer_id)->first();

        $questions = $answer -> QuestionAnswers;

        $questions = QuestionResource::collection($questions);

        return $this->apiResponse($questions,NULL,'done!',200);
    }


    public function updateQuestion(StoreQuestionRequest $request, $answer_id)
    {

        $question = $request->validated();
        $answer = Answer::find($answer_id);

        $question = collect([
            'question' => $question['question'],
            'answer' => $answer,
        ]);

        if($question->fails()){
            return $this->apiResponse(null,null,$question->errors(),400);
        }

        $question = Question::updateQuestion([
            'question' => $question['question'],
            'answer_id'=> $answer_id,
        ]);

        if($question){
            return $this->apiResponse(new QuestionResource($question),null,'the question updated',200);
        }
        return $this->apiResponse(null,null,'the question not updated',400);
    }


    public function destroy(string $id)
    {
        $question = Question::find($id);
        if($question){
            return $this->apiResponse(null,null ,'the question not found',404);
        }
        $question->delete($id);
        return $this->apiResponse("",null ,'the question deleted',200);
    }

}


