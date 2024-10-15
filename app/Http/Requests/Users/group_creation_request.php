<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class group_creation_request extends FormRequest
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
            'name' => 'string|required',
            'organisation_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'group name is required',
            'organisation_id.required' => 'organisation iformation are missing!',
        ];
    }
}
