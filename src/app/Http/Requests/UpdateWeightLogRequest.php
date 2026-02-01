<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeightLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'between:1,300'],
            'calories' => ['required', 'integer', 'min:0'],
            'exercise_time' => ['required', 'date_format:H:i'],
            'exercise_content' => ['nullable', 'string', 'max:255'],
        ];
    }
}
