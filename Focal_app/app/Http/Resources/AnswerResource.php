<?php

namespace App\Http\Resources;

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
        return [

            'id'             => $this->id ,
            'user_id'        => $this->user_id ,
            'company_job_id' => $this->question ->company_job_id ,
            'question_id'    => $this->question_id ,
            'question'       => $this->question ->question ,
            'answer'         => $this->answer ,
            'created_at'     => $this->created_at ,


        ];
    }
}
