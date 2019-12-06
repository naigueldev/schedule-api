<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        "start_date",
        "due_date",
        "due_date_complete",
        "title",
        "description"
    ];
}
