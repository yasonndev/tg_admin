<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('users', 'users')
    ->middleware(['auth', 'verified'])
    ->name('users');

Route::view('mybots', 'mybots')
    ->middleware(['auth', 'verified'])
    ->name('mybots');

Route::view('tgusers', 'tgusers')
    ->middleware(['auth', 'verified'])
    ->name('tgusers');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
