<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/produtos', action: [ProductController::class, 'index'])->name('produtos');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::put('/products/{id}/edit', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/avaliacoes', [ReviewController::class, 'index'])->middleware(['auth', 'verified'])->name('avaliacoes');
Route::get('/conversas', [ChatController::class, 'index'])->middleware(['auth', 'verified'])->name('conversas');
Route::get('/chats/{chatId}/messages', [ChatController::class, 'getMessages']);
Route::post('/chats/{chatId}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
Route::get('/ajustes', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('ajustes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
