<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{   
    private $model;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->model = $user; 
    }

    /**
     * Obtém todos os usuários cadastrados
     */
    public function index()
    {
        return $this->model->findAll();
    }
    /**
     * Registra um novo usuario.
     * 
     * @param $request
     */
    public function store(StoreUserRequest $request)
    {
        $request->validated();

        return $this->model->create($request->all());
    }
}
