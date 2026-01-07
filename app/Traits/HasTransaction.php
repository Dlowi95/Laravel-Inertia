<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait HasTransaction
{
    protected function beginTransaction(): static
    {
        DB::beginTransaction();

        return $this;
    }

    protected function commit(): static
    {
        DB::commit();

        return $this;
    }

    protected function rollback(): void
    {
        DB::rollBack();
    }

    protected function beforeSave(): static
    {
        return $this;
    }

    protected function afterSave(): static
    {
        return $this;
    }

    protected function withRelation(): static
    {
        $relationable = $this->repository->getRelationable() ?? [];
        if (count($relationable)) {
            foreach ($relationable as $relation) {
                if ($this->request->has($relation)) {
                    $this->model->{$relation}()->sync($this->request->{$relation});
                }
            }
        }

        return $this;
    }
}
