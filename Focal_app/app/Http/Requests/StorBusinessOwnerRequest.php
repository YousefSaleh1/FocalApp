<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorBusinessOwnerRequest extends FormRequest
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
            "company_name"          =>["required","string","min:3","max:255"],
            "company_field"         =>["required","string"],
            "company_size"          =>["string"],
            "year_founded"          =>["date"],
            "responsible_job_role"  =>["required","string"],
            "company_number"        =>["required","integer"],
            "website"               =>["required","string"],

        ];
    }
}
