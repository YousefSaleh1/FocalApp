<?php

namespace App\Http\Resources;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find($this->user_id);
        $question = Question::where('id' , $this->question_id);
        return [

            'id'             => $this->id ,
            'question'       => new QuestionResource($question),
            'email'          => $user->email,
            'answer'         => $this->answer ,

        ];
    }
}
