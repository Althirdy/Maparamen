<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrewRequest extends FormRequest
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
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:75',
            'phone' => 'required|string|max:11|regex:/^\d+$/',
            'role' => 'required|integer|in:2,3', // Only roles 2, 3
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'regex:/[A-Z]/', // At least one uppercase letter
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.regex' => 'The name must only contain alphabetic characters.',
            'name.required' => 'The name field is mandatory. Please enter the name.',
            'name.max' => 'The name must not exceed 75 characters.',
            'password.required' => 'The password field is required. Please provide a password.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.max' => 'The password must not exceed 16 characters.',
            'password.regex' => 'The password must contain at least one uppercase letter.',
            'phone.max' => 'Invalid Phone Number',
            'phone.regex' => 'Invalid Phone Number, The phone number must only contain numeric characters.',

        ];
    }
}
