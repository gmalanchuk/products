<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {
    Route::post('change/role/{user}', [AdminController::class, 'changeRole']);
});
