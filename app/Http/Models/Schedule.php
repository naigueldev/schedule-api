<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Helper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Schedule extends Model
{   
    public $timestamps = false;
    
    public $table = "schedules";

    protected $fillable = [
        "start_date",
        "due_date",
        "due_date_complete",
        "title",
        "description",
        "status_id",
        "user_id"
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $casts = [
        'start_date' => 'datetime:d/m/Y H:i:s',
        'due_date' => 'datetime:d/m/Y H:i:s'
    ];

    public $formated_columns = [
        'start_date',
        'due_date',
        'due_date_complete'
    ];

    /**
     * Obtém o usuário que possui a agenda
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Obtém o status associado a agenda
     */
    public function status()
    {
        return $this->hasOne('App\Models\Status');
    }

    public static function searchBetweenDates($request)
    {

        if ($request->has('initialDate') && $request->has('finalDate')) {
            $initialDate = Helper::dateToDb($request->initialDate);
            $finalDate = Helper::dateToDb($request->finalDate);
            $schedules = DB::table('schedules')->whereBetween('start_date', [$initialDate, $finalDate])->get();
            return $schedules;
        }
        
        return Schedule::all();
    }

    public function setStartDateAttribute($date, $divider='/') 
    {
        $date = ($date) ? str_replace($divider, '-', $date) : $date;
        $this->attributes['start_date']= Carbon::parse($date)->format($this->dateFormat);
    }

    public function setDueDateAttribute($date, $divider='/') 
    {
        $date = ($date) ? str_replace($divider, '-', $date) : $date;
        $this->attributes['due_date'] = Carbon::parse($date)->format($this->dateFormat);
    }
    public function setDueDateCompleteAttribute($date, $divider='/') 
    {
        $date = ($date) ? str_replace($divider, '-', $date) : $date;
        
        if(isset($this->attributes['due_date_complete']))
            $this->attributes['due_date_complete'] ($date) ? Carbon::parse($date)->format($this->dateFormat) : $date;
    }

}
