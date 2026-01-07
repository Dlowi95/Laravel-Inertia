<?php

namespace App\Http\Controllers\Backend\V1\User;

use App\Http\Controllers\Backend\BaseController;
use App\Http\Requests\User\UserCatalogue\StoreRequest;
use App\Http\Requests\User\UserCatalogue\UpdateRequest;
use App\Services\Interfaces\User\UserCatalogueServiceInterface as UserCatalogueService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserCatalogueController extends BaseController
{
    protected $service;

    public function __construct(
        UserCatalogueService $service
    ) {
        $this->service = $service;
    }

    public function index(): Response
    {
        return Inertia::render('user/user_catalogue/index');
    }

    public function create(): Response
    {
        return Inertia::render('user/user_catalogue/save');
    }

    public function edit(): Response
    {
        return Inertia::render('user/user_catalogue/save');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $response = $this->service->save($request);

        return $this->handleAction($request, $response, redirectRoute: 'user_catalogue.index');
    }

    // Store voi update giong nhau -> UpdateRequest; khac moi id
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $response = $this->service->save($request, $id);

        return $this->handleAction($request, $response, redirectRoute: 'user_catalogue.index');
    }
}
