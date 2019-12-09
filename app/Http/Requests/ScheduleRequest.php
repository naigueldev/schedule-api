<?php

namespace App\Http\Requests;
use App\Http\Requests\Api\FormRequest;
use App\Rules\ScheduleValidationWeekendRule;
use App\Rules\UniqueScheduleInUserDate;

class ScheduleRequest extends FormRequest
{
    
    private $date_format = 'd/m/Y H:i:s';
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start_date' =>  ['required','date_format:'.$this->date_format, new ScheduleValidationWeekendRule],
            'due_date' => ['required','date_format:'.$this->date_format.',after:start_date', new ScheduleValidationWeekendRule],
            'title' => 'required',
            'description' => 'required',
            'status_id' => 'required|exists:statuses,id',
            'user_id' => ['required','exists:users,id', new UniqueScheduleInUserDate($this->request)]
        ];
    }

    /**
     * Mensagens customizadas para validação
     *
     * @return array
     */
    public function messages()
    {
        return [
            'start_date.required' => 'A data inicial é obrigatória!',
            'start_date.date_format' => 'A data deve ser no formato '.$this->date_format.'!',
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
