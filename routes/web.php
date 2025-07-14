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

    // Admin User Management Routes
    Route::get('/admin/users', [\App\Http\Controllers\UserManagementController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [\App\Http\Controllers\UserManagementController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [\App\Http\Controllers\UserManagementController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [\App\Http\Controllers\UserManagementController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [\App\Http\Controllers\UserManagementController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\UserManagementController::class, 'destroy'])->name('admin.users.destroy');
});

require __DIR__.'/auth.php';
