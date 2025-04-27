<?php

use App\Http\Controllers\Account\CreateAccountController;
use App\Http\Controllers\Transaction\ProcessTransactionController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function () { //   for check user use sanctum

Route::post('/create-account', CreateAccountController::class)->name('create-account');
Route::post('/process-transaction', ProcessTransactionController::class)->name('process-transaction');

// });
