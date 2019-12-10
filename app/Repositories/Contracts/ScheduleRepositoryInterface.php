<?php

namespace App\Repositories\Contracts;

interface ScheduleRepositoryInterface
{
    public function findAll();

    public function findById($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

    public function getBetweenDate($request);
    
    public function getColumnsToFormat();
}