<?php

namespace App\Services\Impl\V1;

use App\Services\Interfaces\BaseServiceInterface;
use App\Traits\HasTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class BaseService implements BaseServiceInterface
{
    use HasTransaction;

    protected $repository;

    protected $request;

    protected $modelData;

    protected $model;

    protected $result;

    public function __construct(
        $repository
    ) {
        $this->repository = $repository;
    }

    abstract protected function prepareModelData(): static;

    public function setRequest($request): static
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
        $this->model = $id
                        ? $this->repository->update($id, $this->modelData)
                        : $this->repository->create($this->modelData);
        $this->result = $this->model;

        return $this;
    }

    private function getResult()
    {
        return $this->result;
    }
}
