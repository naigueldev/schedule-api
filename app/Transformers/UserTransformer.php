<?php

namespace App\Transformers;

use App\Http\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            "nome" => $user->name
        ];
    }

}