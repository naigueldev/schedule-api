<?php

namespace App\Transformers;

use App\Models\Schedule;
use League\Fractal\TransformerAbstract;

class ScheduleTransformer extends TransformerAbstract
{   
    protected $defaultIncludes = [
        'status',
        'user'
    ];

    public function transform(Schedule $schedule)
    {
        return [
            "id_agenda"      => (int) $schedule->id,
            "data_inicial"   => (string) $schedule->start_date,
            "data_prazo"     => (string) $schedule->due_date,
            "data_conclusao" => (string) $schedule->due_date_complete,
            "titulo"         => (string) $schedule->title,
            "descricao"      => (string) $schedule->description
        ];
    }

    public function includeStatus(Schedule $schedule)
    {
        return $this->item($schedule->status, new StatusTransformer);
    }

    public function includeUser(Schedule $schedule)
    {
        return $this->item($schedule->user, new UserTransformer);
    }
}