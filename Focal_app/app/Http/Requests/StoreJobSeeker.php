<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Constraint\IsFalse;

class StoreJobSeeker extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'       => ["required","integer",Rule::exists('users','id')],
            //must be job_title_id
            'job_title'      =>["required","string","max:255"],
            'address'         =>["required","string","max:255"],
            'Date_of_birth'   =>["required","date"],
            'gender'          =>["required",Rule::in(['male','female','no_profrence'])],
            'field_of_work'   =>["required",Rule::in(['UI/UX','graphicDesign','flutter','frontend_developer','digital_marketing','backend_developer'])],
            'job_level'       => ["required",Rule::in(['beginner','junior','mid','Senior','expert'])],
            'experience'      =>["required","string","max:255"],
            'work_type'       =>["required",Rule::in(['full Time','partTime','Remotely','trainee'])],
            'education_level' =>["required",Rule::in(['highSchoolDiploma','collegeDegree','MasterDegree','A Ph.D'])],
            'current_Job_Status'=>["required",Rule::in(['openToWork','emlpoyee'])],
            'salary_range'    =>["required",Rule::in(['500000-10000000','10000000-1500000','1500000-2000000','2000000-2500000'])],

        ];
    }
}

