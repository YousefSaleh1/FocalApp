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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required','integer','exists:users,id','min:1','max:10000',],
            'title' => ['required','string','max:255',],
            'body' => ['required','string','min:10',],
            'photo' => ['image','mimes:jpeg,png','max:2048','dimensions:min_width=300,min_height=300,max_width=2000,max_height=2000',],
            'status' => [
                'required',
                Rule::in(['draft','post']),
            ],




                ];
    }
}