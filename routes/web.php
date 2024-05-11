<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::middleware(['role:admin'])->group(function () {
        route::get('/dashboard/users', function () {
            return view('dashboard.users.index');
        })->name('dashboard.users.index');
        route::get('/dashboard/categories', function () {
            return view('dashboard.categories.index');
        })->name('dashboard.categories.index');
    });
});
