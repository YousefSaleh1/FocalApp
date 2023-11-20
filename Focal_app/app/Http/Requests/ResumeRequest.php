<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ResumeRequest extends FormRequest
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
            'job_seeker_id'=> ["required", "integer", Rule::exists('job_seekers','id')],
            'user_id'             =>["required", "integer", Rule::exists('users','id')],
            'certificates_training_courses' =>["required","string","max:255"],
            'experience'                    =>["required","string","max:255"],
            'skills'                        =>["required","string","max:255"],
            'languages'                     =>["required","string","max:255"],
        ];
    }
}