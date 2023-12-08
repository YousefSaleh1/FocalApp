<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserinfo extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:100',
            'city_id' => 'required|integer',
            'phone_number' => 'required|integer|unique:user_infos',
            'facebook_account' => 'nullable|string',
            'linked_in_account' => 'nullable|string',
            'profile_photo' => 'nullable',
        ];
    }
}
