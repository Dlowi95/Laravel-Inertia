<?php 
namespace App\Repositories\User;

use App\Models\UserCatalogue;
use App\Repositories\BaseRepo;

class UserCatalogueRepo extends BaseRepo{
    protected $model;

    public function __construct(
        UserCatalogue $model
    )
    {
        $this->model = $model;
        parent::__construct($model);
    }
}