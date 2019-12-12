<?php

namespace App\Repositories\Eloquent;

use App\Models\Status;
use App\Repositories\Contracts\StatusRepositoryInterface;

class StatusRepository implements StatusRepositoryInterface
{
    private $model;
    
    public function __construct(Status $model)
    {
        $this->model = $model;
    }

    /**
     * Obtém todos os registros
     */
    public function findAll()
    {
        return $this->model->all();
    }

}