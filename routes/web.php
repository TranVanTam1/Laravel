<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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

Route::get('/', function () {
    return view('page.index');
});
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/product/{id}', [PageController::class, 'show'])->name('page.product');

// Route::get('cars/{id}',[CarController::class,'show'])->name('car-show');

// Route::get('/cars', [CarController::class, 'index'])->name('cars.index');


// Route::get('car/create', [CarController::class, 'create'])->name('create');
// Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
// Route::get('/cars/{id}/edit', [CarController::class, 'edit'])->name('cars.edit');

// // Route cho phương thức update
// Route::put('/cars/{id}', [CarController::class, 'update'])->name('cars.update');

// Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
// Route::resource('cars',CarController::class);