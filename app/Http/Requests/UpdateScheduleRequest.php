<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;
use App\Rules\ScheduleValidationWeekendRule;
use App\Rules\UniqueScheduleInUserDate;
use App\Rules\ScheduleValidationOnUpdate;
use App\Http\Requests\ScheduleRequest;


class UpdateScheduleRequest extends FormRequest
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
        
        $schedule = new ScheduleRequest($this);
        
        return $schedule->rules();

    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        $schedule = new ScheduleRequest($this);
        return $schedule->messages();
    }
}
