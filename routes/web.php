<?php

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', 'TicketsController');
    Route::resource('tickets.replies', 'RepliesController')->only(['store', 'destroy']);
});
