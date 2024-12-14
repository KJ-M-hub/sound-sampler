<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoundSamplerController;
use App\Http\Controllers\PlaylistController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', [App\Http\Controllers\SoundSamplerController::class, 'main'])
->middleware(['auth', 'verified'])->name('main');

Route::get('/recording', [App\Http\Controllers\SoundSamplerController::class, 'recording'])
->name('recording');

Route::post('/save-sound', [SoundSamplerController::class, 'saveSound'])
->name('save-sound');

// Route::get('/sounds', [App\Http\Controllers\SoundSamplerController::class, 'index'])
// ->middleware(['auth', 'verified'])->name('index');

Route::get('/user-sounds', [SoundSamplerController::class, 'userSounds'])
    ->middleware(['auth', 'verified'])
    ->name('user-sounds');

Route::delete('/delete-sound/{id}', [SoundSamplerController::class, 'deleteSound'])
->name('delete-sound');

Route::post('/playlist', [PlaylistController::class, 'store'])
->name('playlist.store');

Route::put('/playlist/{id}', [PlaylistController::class, 'update'])
->name('playlist.update');

Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist.index');

Route::get('/sounds/{id}', [SoundSamplerController::class, 'getSound'])
->name('get-sound');

Route::post('/save-soundMp3', [SoundSamplerController::class, 'saveSoundMp3'])
->name('save-sound');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
