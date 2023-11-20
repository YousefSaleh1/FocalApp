<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResumeResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                           => $this->id,
            'job_seeker_id'                => $this->job_seeker_id,
            'certificates_training_courses'=> $this->certificates_training_courses,
            'experience'                   => $this->experience,
            'skills'                       => $this->skills,
            'languages'                    => $this->languages,

        ];
    }
}