<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__.'/auth.php';

Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::group(['middleware' => ['auth']], function () {
    Route::resource('channels', ChannelController::class, ['except' => 'create', 'edit']);
    Route::resource('chats', ChatController::class, ['only' => 'store', 'update', 'destroy']);
});

