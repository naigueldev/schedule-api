<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Http\Models\Schedule;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Helper;
use Carbon\Carbon;

class UniqueScheduleInUserDate implements Rule
{
    private $start_date;
    private $schedule;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;

        $this->method = $request->method();

        $this->start_date = Helper::dateToDb($request->start_date);

        $this->schedule = DB::table('schedules')
            ->where('user_id', $request->user_id)
            ->where('start_date', $this->start_date)
            ->first();
       
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
        return $this->validateMethod();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Não é permitido cadastros na mesma data de outra atividade desse usuário! - '.$this->schedule->id;
    }
    /**
     * Exceção: a data pode ser mantida quando for o método para atualizar
     */
    public function validateMethod()
    {
        return !( isset($this->schedule) && !$this->request->isMethod('put')  );
    }
}
