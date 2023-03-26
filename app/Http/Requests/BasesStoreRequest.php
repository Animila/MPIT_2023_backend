<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasesStoreRequest extends FormRequest
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
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'longitude'=>'required|numeric',
            'latitude'=>'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Заполните поле заголовка',
            'title.string'=>'Заголовок должен иметь тип строки',
            'title.max'=>'Заголовок превышает 255 символов',
            'description.required'=>'Заполните поле описания',
            'description.string'=>'Описание должно иметь тип строки',
            'longitude.required'=>'Заполните поле долготы',
            'longitude.numeric'=>'Долгота должна иметь тип числа',
            'latitude.required'=>'Заполните поле ширины',
            'latitude.numeric'=>'Ширина должна иметь тип числа',
        ];
    }
}
