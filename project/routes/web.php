<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', [App\Http\Controllers\SoundSamplerController::class, 'main'])
->middleware(['auth', 'verified'])->name('main');

Route::get('/recording', [App\Http\Controllers\SoundSamplerController::class, 'recording'])
    ->name('recording');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
