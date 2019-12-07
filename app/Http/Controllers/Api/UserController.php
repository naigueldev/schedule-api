<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;


class UserController extends Controller
{   
    public function index()
    {
        return User::all();
    }
    /**
     * Cria um novo usuario.
     */
    public function store(StoreUserRequest $request)
    {
       
        $request->validated();

        return User::create($request->all());
    }
}
