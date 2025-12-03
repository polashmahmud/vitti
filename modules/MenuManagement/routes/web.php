<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth'])->group(function () {
    Route::get('/menu-management', function () {
        return Inertia::render('MenuManagement::Index');
    })->name('menu-management.index');
});
