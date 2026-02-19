<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LoanController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/loans', [LoanController::class, 'store']);
    Route::post('/returns/{loan_id}', [LoanController::class, 'devolucion']);
});


