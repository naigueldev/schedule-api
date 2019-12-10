<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Helper;
use Carbon\Carbon;

class Schedule extends Model
{  
    /**
     * Indica se as colunas created_at e updated_at existem
     * 
     * @var bool
     */
    public $timestamps = false;
    
    public $table = "schedules";

    public $formated_columns = [
        'start_date',
        'due_date',
        'due_date_complete'
    ];

    protected $fillable = [
        "start_date",
        "due_date",
        "due_date_complete",
        "title",
        "description",
        "status_id",
        "user_id"
    ];

    protected $date_format = 'Y-m-d H:i:s';

    protected $casts = [
        'start_date' => 'datetime:d/m/Y H:i:s',
        'due_date' => 'datetime:d/m/Y H:i:s'
    ];

    /**
     * Obtém o usuário que possui a agenda
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtém o status associado a agenda
     */
    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function setStartDateAttribute($date) 
    {
        $date = Helper::getDateToParse($date);
        
        if($date)
            $this->attributes['start_date'] = Carbon::parse($date)->format($this->date_format);
    }

    public function setDueDateAttribute($date, $divider='/') 
    {
        $date = Helper::getDateToParse($date);
        
        if($date)
            $this->attributes['due_date'] = Carbon::parse($date)->format($this->date_format);
    }

    public function setDueDateCompleteAttribute($date, $divider='/') 
    {
        $date = Helper::getDateToParse($date);
        if(isset($this->attributes['due_date_complete']) && $date)
            $this->attributes['due_date_complete'] ($date) ? Carbon::parse($date)->format($this->date_format) : $date;
    }

}
