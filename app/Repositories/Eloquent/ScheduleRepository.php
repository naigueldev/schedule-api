<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ScheduleRepositoryInterface;
use App\Http\Models\Schedule;
use App\Http\Models\Helper;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    private $model;

    public function __construct(Schedule $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function getBetweenDate($request)
    {
        if ($request->has('initialDate') && $request->has('finalDate')) {
            $initialDate = Helper::dateToDb($request->initialDate);
            $finalDate = Helper::dateToDb($request->finalDate);
            $schedules = Schedule::where([
                ['start_date', '>=', $initialDate],
                ['start_date', '<=', $finalDate]
            ])->get();
            return $schedules;
        }
        
        return Schedule::all();
    }
}
