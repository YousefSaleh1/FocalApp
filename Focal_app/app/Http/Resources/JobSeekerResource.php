<?php

namespace App\Http\Resources;

use App\Models\Resume;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobSeekerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userInfo = UserInfo::where('user_id' , $this->user_id)->first();
        return [
            'id'                 => $this->id,
            'job_title'          => $this->job_title,
            'address'            => $this->address,
            'experience'         => $this->experience,
            'Date_of_birth'      => $this->Date_of_birth ,
            'gender'             => $this->gender,
            'field_of_work'      => $this->field_of_work ,
            'job_level'          => $this->job_level,
            'work_type'          => $this->work_type,
            'education_level'    => $this->education_level,
            'current_Job_Status' => $this->current_Job_Status ,
            'salary_range'       => $this->salary_range,
            'userInfo'           => new UserinfoResource($userInfo),
        ];
    }
}
