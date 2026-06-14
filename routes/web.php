<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PromoteContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    Route::resource('contacts', ContactController::class);

    Route::get('/contacts/{contact}/promote', [PromoteContactController::class, 'edit'])
        ->name('contacts.promote.edit');

    Route::put('/contacts/{contact}/promote', [PromoteContactController::class, 'update'])
        ->name('contacts.promote.update');
});