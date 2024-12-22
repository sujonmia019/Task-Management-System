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
            'title'       => ['required','string','max:150'],
            'description' => ['required','string'],
            'due_date'    => ['required'],
            'priority'    => ['required','integer','in:1,2,3,4'],
            'status'      => ['required','integer','in:1,2,3'],
        ];

        if(request()->task_board == 'task_board'){
            $rules['status'][0] = 'nullable';
        }

        return $rules;
    }
}
