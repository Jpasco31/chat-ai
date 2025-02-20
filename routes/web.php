<?php

use App\Http\Controllers\ChatgptDestroyController;
use App\Http\Controllers\ChatgptIndexController;
use App\Http\Controllers\ChatgptStoreController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chat/{id?}', ChatgptIndexController::class)->name('chat.show');
    Route::post('/chat/{id?}', ChatgptStoreController::class)->name('chat.store');
    Route::delete('/chat/{chat}', ChatgptDestroyController::class)->name('chat.destroy');
});

require __DIR__ . '/auth.php';
