<?php

namespace App\Transformers;

use App\Models\Status;
use League\Fractal\TransformerAbstract;

class StatusTransformer extends TransformerAbstract
{
    public function transform(Status $status)
    {
        return [
            "nome" => $status->name
        ];
    }

}