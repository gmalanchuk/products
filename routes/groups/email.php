<?php

use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'email'], function () {
    Route::post('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
    Route::post('resend', [EmailVerificationController::class, 'resend'])->name('verification.resend');
});
