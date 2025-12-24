<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

Route::get('/datatable', function () {
    $users = QueryBuilder::for(User::class)
        ->allowedFields([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ])
        ->paginate(10)
        ->withQueryString();

    return Inertia::render('DataTable::Index', [
        'users' => $users,
    ]);
});
