<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;


//Route::get('/animales/{id}/edit', [AnimalController::class, 'edit']); 
//Route::put('/animales/{id}', [AnimalController::class, 'update']); // Procesa la actualización de registros existentes
//Route::delete('/animales/{id}', [AnimalController::class, 'destroy']); // Procesa la eliminación de registros de la lista

// Ruta para listar los animales
//Route::get('/animales', [AnimalController::class, 'index']);
//Route::post('/animales', [AnimalController::class, 'store']);

Route::get('/', function () {
    return view('welcome');
});

// Rutas para la gestión de animales
Route::group(['prefix' => '/',
    'name' => 'animales.',], function () {
    Route::get('/', [AnimalController::class, 'index'])->name('index');
    Route::post('/', [AnimalController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AnimalController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AnimalController::class, 'update'])->name('update');
    Route::delete('/{id}', [AnimalController::class, 'destroy'])->name('destroy');
    Route::post('/reset', [AnimalController::class, 'reset'])->name('reset');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
