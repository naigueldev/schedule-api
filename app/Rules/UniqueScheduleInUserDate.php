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
    private $user;
    private $duplicated = false;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;

        $this->method = $request->method();

        $this->start_date = $request->start_date;

        $this->user = DB::table('schedules')->where('user_id', $request->user_id)->first();
       
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
        $this->validateUserDate();
        
        $this->duplicated = ($this->user) ? $this->validateMethod() : false;
        
        return !$this->duplicated;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Não é permitido cadastros na mesma data de outra atividade desse usuário!';
    }

    public function validateUserDate(){
        if($this->user)
        {
            $this->start_date = Helper::dateToDb($this->start_date);
            $this->user->start_date = Helper::dateToDb($this->user->start_date);
        }
    }

    public function dateAlreadyRegistered()
    {
        return ($this->start_date == $this->user->start_date);
    }

    public function validateMethod()
    {
        return ( !$this->request->isMethod('put') && $this->dateAlreadyRegistered() );
    }
}
