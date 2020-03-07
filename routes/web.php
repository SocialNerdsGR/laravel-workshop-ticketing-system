<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', 'TicketsController');
    Route::resource('tickets.replies', 'RepliesController')->only(['store']);
});
