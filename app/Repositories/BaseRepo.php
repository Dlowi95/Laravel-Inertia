<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Mockery\Undefined;

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

    public function create(array $payload = []): Model | null {
        return $this->model->create($payload)->fresh();
    }

    public function update(int $id, array $payload = []): Model {
        $model = $this->findById($id);
        $model->fill($payload);
        $model->save();
        return $model;
    }
    public function findById(int $id, array $with = [], array $column = ['*']){
        return $this->model->select($column)->with($with)->findOrFail($id);
    }
    public function pagination(array $specs = []){
        return $this->model
        ->simpleFilter($specs['filter']['simple'] ?? [])
        ->complexFilter($specs['filter']['complex'] ?? [])
        ->dateFilter($specs['filter']['date'] ?? [])
        ->keyword($specs['filter']['keyword'] ?? [])
        ->when(
            $specs['all'],
            fn($q) => $q->get(),
            fn($q) => $q->paginate($specs['perpage'])
            //fn($q) => $q->toSql()
        );
    }
}
