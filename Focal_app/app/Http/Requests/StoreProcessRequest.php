<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreProcessRequest extends FormRequest
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
            'contact_number'     =>['required','string','max:255'],
            'amount'             =>['required','integer','min:100000','max:30000000'],
            'sender_name'        =>['required','string','max:255'],
            'sender_id_number'   =>['required','string','max:225'],
            'receipt_number'     =>['required','string','max:255'],
            'address'            =>['required','string','max:255'],
            'receiver_name'      =>['required','string','max:255'],
            'receiver_id_number' =>['required','string','max:255'],
            'password_vorifi'    =>['required','numeric'],
            'receiver_id'        =>['required','integer'],
        ];
    }
}
