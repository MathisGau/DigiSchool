<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\StatistiquesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'markAsRead'])->name('dashboard');

    Route::get('/notes',[NotesController::class, 'show'])->name('notes');
    Route::post('/notes',[NotesController::class, 'store'])->name('notes');

    Route::get('/statistiques',[StatistiquesController::class, 'show'])->name('statistiques');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
