<?php

use App\Http\Controllers\Family\FamilyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [FamilyController::class, 'index'])->name('dashboard');
    Route::get('/family/add', [FamilyController::class, 'create'])->name('family.show');
    Route::post('/family/add', [FamilyController::class, 'store'])->name('family.store');
    Route::get('/family/{id}/edit', [FamilyController::class, 'edit'])->name('family.edit');
    Route::put('/family/{id}', [FamilyController::class, 'update'])->name('family.update');
});

require __DIR__ . '/auth.php';
