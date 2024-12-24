<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'     => ['required','string','max:150'],
            'email'    => ['required','email','unique:users,email'],
            'password' => ['required','string','min:6','max:16'],
        ];
    }
}

