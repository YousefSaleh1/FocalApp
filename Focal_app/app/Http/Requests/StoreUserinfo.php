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
            'user_id' => 'required|integer|exists:users,id',
            'full_name' => 'required|string|max:100',
            'city_id' => 'required|integer',
            'phone_number' => 'required|integer',
            'facebook_account' => 'nullable|string|unique:user_info,facebook_account',
            'linked_in_account' => 'nullable|string|unique:user_info,linked_in_account',
            'behanc_account' => 'nullable|string',
            'profile_photo' => 'nullable',
        ];
    }
}
