<?php

use App\Http\Controllers\API\TelegramBotsController;

Route::prefix('telegram')
    ->middleware('auth.tg_bot')
    ->name('telegram.')
    ->group(function () {
        Route::post('/register', [TelegramBotsController::class, 'registerUserInBot'])->name('telegram.register');
        Route::post('/auth', [TelegramBotsController::class , 'canUserAuthenticate'])->name('telegram.auth');
        Route::post('/user/{$userId}', [TelegramBotsController::class, 'getUserInBot'])->name('telegram.user');
        Route::post('/user/action', [TelegramBotsController::class, 'userMadeAction'])->name('telegram.user.action');
    });
