<?php

namespace App\Http\Resources;

use App\Models\CompanyJob;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               =>$this->id,
            'job_title'        =>$this->job_title,
            'job_role'         =>$this->job_role,
            'job_level'        =>$this->job_level,
            'experience'       =>$this->experience,
            'education_level'  =>$this->education_level,
            'language'         =>$this->language,
            'age_range'        =>$this->age_range,
            'gender'           =>$this->gender,
            'city_id'          =>$this->city_id,
            'job_type'         =>$this->job_type,
            'address'          =>$this->address,
            'work_hour'        =>$this->work_hour,
            'salary_range'     =>$this->salary_range,
            'help'             =>$this->help,
            'job_discription'  =>$this->job_discription,
            'job_requirement'  =>$this->job_requirement,
            'status'           =>$this->status,
            'cancel_desc'      =>$this->cancel_desc,

        ];
    }
}


