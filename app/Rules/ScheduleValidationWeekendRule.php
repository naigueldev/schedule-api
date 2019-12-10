<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
use App\Helpers\Helper;

class ScheduleValidationWeekendRule implements Rule
{
    /**
    * Verifica e valida se a data informada está fim de semana.
    * @param  string  $attribute
    * @param  mixed  $value
    * @return bool
    */
    
    public function passes($attribute, $value)
    {
        $value = Helper::dateToDb($value);
        $dt = new Carbon($value);
        return !$dt->isWeekend();
    }
    /**
    * Obtém a mensagem de erro da validação
    * @return string
    */
    public function message()
    {
        return 'Essa data não pode registrada no final de semana!';
    }
    
    
}
