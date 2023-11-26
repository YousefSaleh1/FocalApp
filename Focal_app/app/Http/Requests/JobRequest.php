<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class JobRequest extends FormRequest
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
            'job_title' => 'required|string',
            'job_role' => ['required',Rule::in(['BackEnd Dev','FrontEnd Dev','Graphics Designer','Content Creator','Digital Marketing']),],
            'job_level'=>['required',Rule::in(['Beginner','Junior','Mid','Senior','Expert']),],
            'experience'=>['required','string'],
            'education_level'=>['required',Rule::in(['highSchoolDiploma','collegeDegree','MasterDegree','A Ph.D']),],
            'language'=>['required',Rule::in(['English','Arabic','French']),],
            'age_range'=>['required',Rule::in(['20-25','25-30','30-35','35-40']),],
            'gender'=>['required',Rule::in(['male','female','no_profrence']),],
            'job_type'=>['required',Rule::in(['full Time','partTime','Remotely','trainee']),],
            'address'=>'required|string',
            'city_id'=>'required|integer',
            'work_hour'=>['required',Rule::in(['One hour','Tow hours','Three hours','Four hours','Five hours','Six hours','Seven hours','Eight hours']),],
            'salary_range'=>['required',Rule::in(['500000-10000000','10000000-1500000','1500000-2000000','2000000-2500000']),],
            'help'=>'required|boolean',
            'job_discription'=>'required|string',
            'job_requirement'=>'required|string',
            'status'=>Rule::in(['Active','Closed','Waiting']),
            'cancel_desc'=>'required|string',
        ];
    }
}
