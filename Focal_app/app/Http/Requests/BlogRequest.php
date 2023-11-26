<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
            'title' => ['required','string','max:255',],
            'body' => ['required','string'],
            'photo' => ['nullable ' , 'image ' ,'mimes:png,jpg,jpeg,gif,sug ',' max:2048'],
            'status' => [
                'required',
                Rule::in(['draft','post']),
            ],
            // 'category_id' => ['required' , 'array']
            //
        ];
    }
}
