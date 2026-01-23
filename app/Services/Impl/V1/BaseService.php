<?php

namespace App\Services\Impl\V1;

use App\Services\Interfaces\BaseServiceInterface;
use App\Traits\HasTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\HasSpecBuilder;

abstract class BaseService implements BaseServiceInterface
{
    use HasTransaction, HasSpecBuilder;

    protected $repository;
    protected $request;
    protected $modelData;
    protected $model;
    protected $result;
    protected $with = [];

    protected $perpage = 20;
    protected $simpleFilter = ['publish'];
    protected $complexFilter = ['id'];
    protected $dateFilter = ['created_at', 'updated_at'];
    protected $searchFields = ['name'];

    public function __construct(
        $repository
    ) {
        $this->repository = $repository;
    }

    abstract protected function prepareModelData(): static;

    protected function setRequest($request): static
    {
        $this->request = $request;

        return $this;
    }

    public function save(Request $request, ?int $id = null)
    {
        try {
            return $this->beginTransaction()
                ->setRequest($request)
                ->prepareModelData()
                ->beforeSave()
                ->saveModel($id)
                ->withRelation()
                ->afterSave()
                ->commit()
                ->getResult();

        } catch (\Throwable $th) {
            Log::error('BaseService::save error', ['error' => $th->getMessage(), 'trace' => $th->getTraceAsString()]);
            DB::rollBack();

            return false;
        }
    }

    private function saveModel(?int $id = null): static
    {
        $this->model = is_null($id)
                        ? $this->repository->create($this->modelData)
                        : $this->repository->update($id, $this->modelData);
        $this->result = $this->model;

        return $this;
    }

    private function getResult()
    {
        return $this->result;
    }

    public function findById(int $id)
    {
        $this->model = $this->repository->findById($id, $this->with);
        $this->result = $this->model;

        return $this->getResult();
    }

    public function paginate(Request $request)
    {
        $this->setRequest($request);
        $specifications = $this->specifications();
        $this->result = $this->repository->pagination($specifications);
        dd($this->result);
        return $this->getResult();
    }

}
