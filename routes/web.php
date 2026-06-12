<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::resource('/contacts', ContactController::class)->middleware('auth');