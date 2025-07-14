<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\RegisterController; // Remove this line

// Registration routes
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// Default home route to dashboard
Route::get('/', function () {
    return view('pages.dashboard');
})->name('dashboard');

// Placeholder route for tasks.index
Route::get('/tasks', function () {
    return view('pages.tasks');
})->name('tasks.index');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/tasks/create', function () {
        // Placeholder for task creation view
        return 'Task creation form (admin only)';
    })->name('tasks.create');
});

require __DIR__.'/auth.php';
