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

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $schedule = $this->model->findOrFail($id);
        $schedule->update($attributes);
        $schedule->save();
        return $schedule;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function getBetweenDate($request)
    {
        if ($request->has('initialDate') && $request->has('finalDate')) {
            $initialDate = Helper::dateToDb($request->initialDate);
            $finalDate = Helper::dateToDb($request->finalDate);
            $schedules = $this->model->where([
                ['start_date', '>=', $initialDate],
                ['start_date', '<=', $finalDate]
            ])->get();
            return $schedules;
        }
        
        return $this->model->all();
    }

    public function getColumnsToFormat()
    {
        return $this->model->formated_columns;
    }
}
