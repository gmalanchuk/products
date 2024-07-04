<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {
    Route::post('change/role/{user}', [AdminController::class, 'changeRole'])->middleware([AdminOnly::class]);
});
