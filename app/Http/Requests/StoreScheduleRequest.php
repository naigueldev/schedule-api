<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;
use App\Rules\ScheduleValidationWeekendRule;
use App\Rules\UniqueScheduleInUserDate;


class StoreScheduleRequest extends FormRequest
{
    private $date_format = 'd/m/Y';

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
            'start_date' =>  ['required','date_format:'.$this->date_format, 'after:today', new ScheduleValidationWeekendRule],
            'due_date' => 'required|date_format:'.$this->date_format.'|after:start_date',
            'title' => 'required',
            'description' => 'required',
            'status_id' => 'required|exists:statuses,id',
            'user_id' => ['required','exists:users,id', new UniqueScheduleInUserDate($this)]
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'start_date.required' => 'A data inicial é obrigatória!',
            'start_date.date_format' => 'A data deve ser no formato '.$this->date_format.'!',
            'start_date.after' => 'A data inicial deve ser após o dia atual!',
            'due_date.date_format' => 'A data deve ser no formato '.$this->date_format.'!',
            'due_date.required' => 'A data final do prazo é obrigatória!',
            'due_date.after' => 'A data final do prazo deve ser após a data inicial!',
            'title.required' => 'O título da atividade é obrigatório!',
            'description.required' => 'A descrição da atividade é obrigatória!',
            'status_id.required' => 'O id do Status da atividade deve ser informado!',
            'status_id.exists' => 'O id do status é inválido!',
            'user_id.required' => 'O id do usuário responsável pela atividade deve ser informado!',
            'user_id.exists' => 'O id do usuário selecionado é inválido!',
        ];
    }
}
