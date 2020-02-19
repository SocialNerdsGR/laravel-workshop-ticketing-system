<?php

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', 'TicketsController');
});
