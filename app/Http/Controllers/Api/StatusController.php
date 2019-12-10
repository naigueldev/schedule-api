<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\StatusRepositoryInterface;

class StatusController extends Controller
{
    private $model;

    public function __construct(StatusRepositoryInterface $status)
    {
        $this->model = $status;
    }

    public function index()
    {
        return $this->model->findAll();
    }
}
