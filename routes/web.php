<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;


Route::get('/cars', [CarController::class, 'index'])->name('car.index');
Route::post('/car/new', [CarController::class, 'store'])->name('car.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
