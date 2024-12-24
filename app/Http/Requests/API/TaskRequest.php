<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\FormRequest;

class TaskRequest extends FormRequest
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
        $rules = [
            'title'       => ['required','string','max:150'],
            'description' => ['required','string'],
            'due_date'    => ['required','date_format:Y-m-d'],
            'priority'    => ['required','integer','in:1,2,3,4'],
            'status'      => ['required','integer','in:1,2,3'],
        ];

        return $rules;
    }
}
