<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
        return Status::all();
    }
}
