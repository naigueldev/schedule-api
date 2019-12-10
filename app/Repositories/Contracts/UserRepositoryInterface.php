<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function findAll();
    
    public function create(array $attributes);
}