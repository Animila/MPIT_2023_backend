<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesStoreRequest extends FormRequest
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
            'title'=>'required|string',
            'countPeople'=>'required|numeric',
            'price'=>'required|numeric',
            'base_id'=>'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Введите название услуги',
            'countPeople.required'=>'Введите количество людей',
            'price.required'=>'Введите цену услуги',
            'base_id.require'=>'Введите идентификатор базы'
        ];
    }
}
