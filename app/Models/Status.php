<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{   
    public $timestamps = false;
    
    protected $fillable = [
        "name"
    ];

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }
}
