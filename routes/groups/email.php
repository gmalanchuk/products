<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'email'], function () {
    Route::post('verify/{id}/{hash}', [EmailController::class, 'verify'])->name('verification.verify');
    Route::post('resend', [EmailController::class, 'resend'])->name('verification.resend');
});
