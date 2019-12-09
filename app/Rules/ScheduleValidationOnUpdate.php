<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Http\Models\Schedule;

class ScheduleValidationOnUpdate implements Rule
{
    private $request;
    private $schedule;
    private $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->schedule = Schedule::find($id);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($this->schedule);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Agenda não encontrada para ser atualizada!';
    }
}
