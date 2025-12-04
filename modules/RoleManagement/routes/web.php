<?php

use Illuminate\Support\Facades\Route;
use Modules\MenuManagement\Http\Controllers\MenuController;

Route::middleware(['auth'])->prefix('role-management')->name('role-management.')->group(function () {});
