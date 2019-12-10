<?php

namespace App\Transformers;

use App\Http\Models\Schedule;
use League\Fractal\TransformerAbstract;

class ScheduleTransformer extends TransformerAbstract
{   
    protected $availableIncludes = [
        'status'
    ];

    public function transform(Schedule $schedule)
    {
        return [
            "id_agenda" => $schedule->id,
            "data_prazo" => $schedule->due_date,
            "data_conclusao" => $schedule->due_date_complete,
            "titulo" => $schedule->title,
            "descricao" => $schedule->description,
            "responsavel" => $schedule->user_id,
            "status" => $schedule->status
        ];
    }

    public function includeStatus(Schedule $schedule)
    {
        return $this->collection($schedule->status_id, new StatusTransformer);
    }
}