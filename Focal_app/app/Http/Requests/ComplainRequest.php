<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplainRequest extends FormRequest
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
            'complain_type'    => 'required|string|max:225',
            'complain_reason'  => 'required|string|max:1000',
            'photoURL'         => 'nullable | image | mimes:png,jpg,jpeg,gif,sug | max:2048',
        ];
    }
}
