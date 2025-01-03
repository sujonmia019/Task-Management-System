<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'   => ['required','string','max:100'],
            'email'  => ['required','email','unique:users,email,'.auth()->user()->id],
            'gender' => ['required','in:1,2'],
            'image'  => ['nullable','image','mimes:png,jpg','max:1024'],
        ];
    }
}
