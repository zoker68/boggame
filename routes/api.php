<?php

use App\Http\Controllers\CreateAccountController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function () { //   for check user use sanctum

Route::post('/create-account', CreateAccountController::class)->name('create-account');

// });
