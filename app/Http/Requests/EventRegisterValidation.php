<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRegisterValidation extends FormRequest
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
            'title' => 'required|max:100',
            'description' => 'required|max:200',
            'start_date' => "required|date",
            'end_date' => "required|date|after_or_equal:start_date"
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Titulo é necessário',
            'title.max' => 'Titulo deve ter no máximo 100 caracteres',
            'description.required'  => 'Descrição é necessário',
            'description.max'  => 'Descrição deve ter no máximo 200 caracteres',
            'start_date.required'  => 'Data ínicio é necessário',
            'start_date.date'  => 'Data ínvalida',
            'end_date.required'  => 'Data fím é necessário',
            'end_date.date'  => 'Data ínvalida',
            'end_date.after_or_equal'  => 'Data fím deve ser maior que data de ínicio'
        ];
    }
}
