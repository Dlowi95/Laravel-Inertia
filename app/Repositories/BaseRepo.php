<?php 
namespace App\Repositories;

class BaseRepo{
    protected $model;
    
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getFillable(): array {
        return $this->model->getFillable();
    }

    public function getRelationable(): array{
        return $this->model->getRelationable();
    }
}