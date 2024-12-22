<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

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
            'title'       => ['required','string','max:150','unique:tasks,title'],
            'description' => ['required','string'],
            'due_date'    => ['nullable'],
            'priority'    => ['required','integer','in:1,2,3,4'],
            'status'      => ['required','integer','in:1,2,3'],
        ];

        return $rules;
    }
}
