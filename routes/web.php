<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');
Route::get('/pet/{pet}', PetController::class)->name('pet');
