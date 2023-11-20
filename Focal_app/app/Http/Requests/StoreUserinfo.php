<?php

namespace App\Http\Requests;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'full_name' => 'required|string|max:100',
            'city' => 'required|string',
            'phone_number' => 'required|integer',
            'facebook_account' => 'required|email|unique:user_info,facebook_account',
            'linked_in_account' => 'required|email|unique:user_info,linked_in_account',
            'behanc_account' => 'required|string',
            'profile_photo' => 'required',
        ];
    }
}
