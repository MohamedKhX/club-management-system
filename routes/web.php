<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home');
Route::view('/federation', 'sportfederation');
Route::view('/club-show', 'club');
