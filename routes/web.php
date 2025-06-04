<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
