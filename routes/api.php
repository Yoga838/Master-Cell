<?php

use App\Http\Controllers\barangController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\UserModelController;
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

Route::post('/pengguna', [UserModelController::class, 'destroy'])->name('delete-pengguna');
Route::post('/stock-barang', [barangController::class, 'destroy'])->name('delete-barang');
