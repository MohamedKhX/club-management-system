<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/federation/{federation}', [HomeController::class, 'showFederation'])->name('federation.show');
Route::get('/club/{club}', [HomeController::class, 'showClub'])->name('club.show');
