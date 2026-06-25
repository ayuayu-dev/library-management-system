<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReturnController;

Route::post('/return', [ReturnController::class, 'return']);

//Route::post('/borrow', [BorrowController::class, 'borrow']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
