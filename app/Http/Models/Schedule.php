<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Helper;

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

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'due_date' => 'date:Y-m-d'
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


}
