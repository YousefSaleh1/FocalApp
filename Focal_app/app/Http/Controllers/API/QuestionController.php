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
    public function index()
    {
    $questions = Question::all();
    return $this->apiResponse( QuestionResource::collection($questions),'','all questions',200);

    }


    /**
     * Store a newly created resource in storage.
     */

     public function store(StoreQuestionRequest $request)
     {
 
         $validation = $request->validated();
 
        $question = Question::Create([
         'company_job_id'=> $request->company_job_id,
         'question'=> $request->question,
 
        ]);
        if($question){
         return $this->apiResponse( new QuestionResource($question),'','Created successfully',200);
        }else{
         return $this->apiResponse( '','','not added',400);
        }
     }

     // show method

     public function show(string $id)
     {
 
     $question = Question::findOrFail($id);
     return $this->apiResponse( new QuestionResource($question),'',' successfully',200);
     }

     // update method

     public function update(StoreQuestionRequest $request,string $id)
     {
 
         $validation = $request->validated();
         $question = Question::findOrFail($id);
 
         $question->update([
          'company_job_id'=> $request->company_job_id,
          'question'=> $request->question ]);
         if($question){
             return $this->apiResponse( new QuestionResource($question),'','updated successfully',200);
         }else{
             return $this->apiResponse( '','','not updated',400);
            }
 
     }

     // destroy method
     public function destroy(string $id)
     {
 
         $question = Question::findOrFail($id);
         $question->delete();
         return $this->apiResponse( '','','Deleted successfully',200);
     }

     // this method return all questions that relation with one selected job

     public function get_questions_for_job(string $company_job_id){
        $questions = Question::where("company_job_id", $company_job_id);
    return $this->apiResponse( QuestionResource::collection($questions),'',' successfully',200);

    }

   

}


