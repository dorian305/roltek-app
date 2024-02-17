<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/get-all-import-orders-queues', [ImportOrderQueueController::class, 'index']);
Route::post('/filter-import-queues', [ImportOrderQueueController::class, 'filter']);

Route::get('/get-all-import-orders-queues-backup', [ImportOrderQueueBackupController::class, 'index']);
Route::get('/get-order-status/{id}', [GetOrderStatusController::class, 'getOrderStatus']);