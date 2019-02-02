<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nickname' => ['required','string'],
            'first_name' => ['required', 'string'],
            'second_name' => ['required', 'string'],
            'sex' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nickname.required' => 'Укажите никнейм',
            'first_name.required' => 'Назовите своё имя',
            'second_name.required' => 'Ваша фамилия?',
            'sex.required' => 'Укажите, пожалуйста, ваш пол',
        ];
    }
}
