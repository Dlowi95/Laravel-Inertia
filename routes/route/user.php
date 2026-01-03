<?php

use App\Http\Controllers\Backend\V1\User\UserCatalogueController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/user_catalogue', UserCatalogueController::class);
});