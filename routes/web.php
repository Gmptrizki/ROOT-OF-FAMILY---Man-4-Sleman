<?php

use App\Http\Controllers\Family\FamilyController;
use App\Http\Controllers\Family\WizzardController;
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

    Route::get('/family/edit-tree', [FamilyController::class, 'editTree'])->name('family.edit.tree');
    Route::post('/family/update-tree', [FamilyController::class, 'updateTree'])->name('family.update.tree');

    //father
    Route::get('/family/father/add', [WizzardController::class, 'indexFather'])->name('dashboard.wizzard.father');
    Route::post('/families/father/store', [WizzardController::class, 'storeFather'])->name('families.store.father');

    //mother
    Route::get('/family/mother/add', [WizzardController::class, 'indexMother'])->name('dashboard.wizzard.mother');
    Route::post('/families/mother/store', [WizzardController::class, 'storeMother'])->name('families.store.mother');

    //grandfa
    Route::get('/family/grandfa/add', [WizzardController::class, 'indexGrandFather'])->name('dashboard.wizzard.grandfa');
    Route::post('/families/grandfa/store', [WizzardController::class, 'storeGrandfa'])->name('families.store.grandfa');

    //grandmom
    Route::get('/family/grandmom/add', [WizzardController::class, 'indexGrandMother'])->name('dashboard.wizzard.grandmom');
    Route::post('/families/grandmom/store', [WizzardController::class, 'storeGrandMom'])->name('families.store.grandmom');

    //brother
    Route::get('/family/add/brother', [WizzardController::class, 'indexBrother'])->name('family.create.brother');
    Route::post('/families/brother/store', [FamilyController::class, 'storeBrother'])->name('families.store.brother');

    //sister
    Route::get('/family/add/sister', [WizzardController::class, 'indexSister'])->name('family.create.sister');
    Route::post('/families/sister/store', [FamilyController::class, 'storeSister'])->name('families.store.sister');
});


Route::get('/wizzard', function () {
    return view('family.wizzard');
});

require __DIR__ . '/auth.php';
