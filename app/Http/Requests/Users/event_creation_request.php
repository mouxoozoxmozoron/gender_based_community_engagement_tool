<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class event_creation_request extends FormRequest
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
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'string|nullable',
            'date' => 'required',
            'time' => 'required|string',
            'title' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'location.required' => 'location field is required',
            'description.required' => 'description field is required',
            'date.required' => 'date field is required',
            'time.required' => 'time field is required',
            'title.required' => 'event title is required',
        ];
    }
}

// protected $fillable = ['user_id', 'group_id', 'description', 'location', 'image', 'date', 'time'];
//
