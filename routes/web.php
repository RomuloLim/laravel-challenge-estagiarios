<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function(){
    Route::get('/cars', [CarController::class, 'index'])->name('car.index');
    Route::post('/car/new', [CarController::class, 'store'])->name('car.store');
    Route::post('/car/rent', [CarController::class, 'rent'])->name('car.rent');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/auth.php';
