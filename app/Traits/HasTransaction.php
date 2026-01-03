<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait HasTransaction{

    protected function beginTransaction(): static {
        DB::beginTransaction();
        return $this;
    }

    protected function commit(): static {
        DB::beginTransaction();
        return $this;
    }

    protected function rollback(): void {
        DB::rollBack();
    }

    protected function beforeSave(): static{
        return $this;
    }

}