<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [ChannelController::class, 'index'])->name('top');

    Route::resource('channels', ChannelController::class, ['except' => ['create', 'edit']]);
    Route::resource('chats', ChatController::class, ['only' => ['index', 'store', 'update', 'destroy']]);
});

