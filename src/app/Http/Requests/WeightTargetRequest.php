<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightTargetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'target_weight' => [
                'required',
                'regex:/^\d{1,3}(\.\d)?$/'
            ],
        ];
    }

    public function messages()
    {
        return [
            'target_weight.required' => '体重を入力してください',
            'target_weight.regex' => '4桁までの数字で入力してください',
        ];
    }
}
