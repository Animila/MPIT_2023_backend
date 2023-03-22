<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstName'=>'string|required',
            'lastName'=>'string|required',
            'tel'=>'string|required',
            'password'=>'string|required'

        ];
    }
    public function messages()
    {
        return [
            'tel.required'=>'Заполните поле телефона',
            'password.required'=>'Заполните поле пароля',
            'firstName.required'=>'Введите свое имя',
            'lastName.required'=>'Введите свою фамилию',

        ];
    }
}
