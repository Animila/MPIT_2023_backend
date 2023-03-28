<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BonusesStoreRequest extends FormRequest
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
            'item_id'=>'required|integer',
            'type'=>'required|integer',
            'count'=>'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'item_id.required'=>'Введите идентификатор услуги',
            'type.required'=>'Введите тип бонуса',
            'count.required'=>'Введите количество бонуса'
        ];
    }
}
