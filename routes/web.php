<?php

use App\Http\Controllers\Chat\ChatgptDestroyController;
use App\Http\Controllers\Chat\ChatgptIndexController;
use App\Http\Controllers\Chat\ChatgptStoreController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [FrontendController::class, 'index'])
    ->middleware([RedirectIfAuthenticated::class])
    ->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chat/{id?}', ChatgptIndexController::class)->name('chat.show');
    Route::post('/chat/{id?}', ChatgptStoreController::class)->name('chat.store');
    Route::delete('/chat/{chat}', ChatgptDestroyController::class)->name('chat.destroy');
});

Route::fallback(function () {
    return Inertia::render('Errors/404', ['status' => 404]);
});

require __DIR__ . '/auth.php';
