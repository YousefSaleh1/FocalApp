<?php

namespace App\Http\Resources;

use App\Http\Requests\JobRequest;
use App\Models\CompanyJob;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $job = CompanyJob::find($this->company_job_id);
        return [
            'id'      => $this->id ,
            'job'     => new JobResource($job),
            'question'=> $this->question ,

        ];
    }
}
