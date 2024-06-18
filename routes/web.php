<?php

use App\Http\Controllers\barangController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\UserModelController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// route guest
Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [loginController::class, 'login'])->name('login');


// route admin
Route::middleware('auth')->group(function(){
    Route::get('/logout',[loginController::class, 'logout'])->name('logout');

    Route::get('/Dashboard', function () {
        return view('dashboard');
    });
    Route::get('/pengguna', [UserModelController::class, 'show'])->name('show-pengguna');
    Route::post('/pengguna', [UserModelController::class, 'store'])->name('add-pengguna');
    Route::put('/pengguna/{id}', [UserModelController::class, 'update'])->name('update-pengguna');
    Route::get('/pengguna/export',[UserModelController::class, 'export'])->name('export-users');
    
    Route::get('/stock-barang',[barangController::class, 'show'])->name('show-barang');
    Route::post('/stock-barang',[barangController::class, 'store'])->name('add-barang');
    Route::put('/stock-barang/{id}',[barangController::class, 'update'])->name('update-barang');
    Route::get('/stock-barang/export',[barangController::class, 'export'])->name('export-barang');

    Route::get('/history', function () {
        return view('history');
    });

    Route::get('keranjang',[cartController::class, 'index'])->name('keranjang');
    Route::post('add-chart',[cartController::class, 'add'])->name('add-chart');
    

});