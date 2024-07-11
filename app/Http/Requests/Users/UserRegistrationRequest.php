<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'gender' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits_between:10,12|numeric|unique:users,phone',
            'password' => 'string|required|',
            'photo' => 'nullable|string',
            'group_id' => 'nullable',

        ];
    }

    public function messages()
    {
        return [
            'phone.digits' => 'phone number must range from 10 to 12 only.',
            'first_name.required' => 'first name is required',
            'last_name.required' => 'last name is required',
            'emai.required' => 'email is required',
            'password.required' => 'password is required',
            'gender.required' => 'gender is required',
            'password.string' => 'gender must be of type string',
        ];
    }
}
