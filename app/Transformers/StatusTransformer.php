<?php

namespace App\Transformers;

use App\Http\Models\Status;
use League\Fractal\TransformerAbstract;

class StatusTransformer extends TransformerAbstract
{
    public function transform(Status $status)
    {
        return [
            "nome_status" => $status->name
        ];
    }

}