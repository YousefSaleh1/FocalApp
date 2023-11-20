<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class JopRequest extends FormRequest
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
            'job_title' => 'Required|string',
            'job_role' => ['Required',Rule::in(['BackEnd Dev','FrontEnd Dev','Graphics Designer','Content Creator','Digital Marketing']),],
            'job_level'=>['Required',Rule::in(['Beginner','Junior','Mid','Senior','Expert']),],
            'experience'=>['Required','string'],
            'education_level'=>['Required',Rule::in(['highSchoolDiploma','collegeDegree','MasterDegree','A Ph.D']),],
            'language'=>['Required',Rule::in(['English','Arabic','French']),],
            'age_range'=>['Required',Rule::in(['20-25','25-30','30-35','35-40']),],
            'gender'=>['Required',Rule::in(['male','female','no_profrence']),],
            'job_type'=>['Required',Rule::in(['full Time','partTime','Remotely','trainee']),],
            'address'=>'Required|string',
            'work_hour'=>['Required',Rule::in(['One hour','Tow hours','Three hours','Four hours','Five hours','Six hours','Seven hours','Eight hours']),],
            'salary_range'=>['Required',Rule::in(['500000-10000000','10000000-1500000','1500000-2000000','2000000-2500000']),],
            'help'=>'Required|boolean',
            'job_discription'=>'Required|string',
            'job_requirement'=>'Required|string',
            'status'=>Rule::in(['Active','Closed','Waiting']),
            'cancel_desc'=>'Required|string',
        ];
    }
}
