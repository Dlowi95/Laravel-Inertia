<?php

namespace App\Repositories;

class BaseRepo
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getFillable(): array
    {
        return $this->model->getFillable();
    }

    public function getRelationable(): array
    {
        return $this->model->getRelationable();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);

        return $model->fresh();
    }
}
