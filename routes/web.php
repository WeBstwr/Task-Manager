<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', function () {
    return view('pages.dashboard');
})->name('dashboard');

// Task routes (placeholder routes for now)
Route::get('/tasks', function () {
    return view('pages.dashboard');
})->name('tasks.index');

Route::get('/tasks/create', function () {
    return view('pages.dashboard');
})->name('tasks.create');

// Auth routes (placeholder routes for now)
Route::get('/login', function () {
    return view('pages.dashboard');
})->name('login');

Route::get('/register', function () {
    return view('pages.dashboard');
})->name('register');

Route::get('/profile', function () {
    return view('pages.dashboard');
})->name('profile');

Route::post('/logout', function () {
    return redirect('/');
})->name('logout');
