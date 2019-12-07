<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{   
    public $timestamps = false;
    
    protected $fillable = [
        "name"
    ];
}
