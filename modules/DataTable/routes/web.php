<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/datatable', function () {
    return Inertia::render('DataTable::Index');
});
