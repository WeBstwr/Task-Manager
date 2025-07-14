<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\RegisterController; // Remove this line

// Registration routes
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// Default home route to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Placeholder route for tasks.index
Route::get('/tasks', function () {
    $tasks = [];
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            $tasks = \App\Models\Task::with(['assignedUser', 'createdBy'])->orderByDesc('created_at')->get();
        } else {
            $tasks = auth()->user()->assignedTasks()->with('createdBy')->orderByDesc('created_at')->get();
        }
    }
    return view('pages.tasks', compact('tasks'));
})->name('tasks.index');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) {
        $totalTasks = \App\Models\Task::count();
        $completedTasks = \App\Models\Task::where('status', 'completed')->count();
        $pendingTasks = \App\Models\Task::where('status', 'pending')->count();
        $overdueTasks = \App\Models\Task::where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->where('due_date', '<', now())
            ->count();
        $recentTasks = \App\Models\Task::orderByDesc('created_at')->take(5)->get();
    } else {
        $totalTasks = $user->assignedTasks()->count();
        $completedTasks = $user->completedTasks()->count();
        $pendingTasks = $user->pendingTasks()->count();
        $overdueTasks = $user->overdueTasks()->count();
        $recentTasks = $user->assignedTasks()->orderByDesc('created_at')->take(5)->get();
    }
    return view('pages.dashboard', compact('totalTasks', 'completedTasks', 'pendingTasks', 'overdueTasks', 'recentTasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User: Update status of assigned task
    Route::patch('/tasks/{task}/status', [\App\Http\Controllers\TaskController::class, 'updateStatus'])->name('tasks.status.update');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Admin Task Management Routes (explicit, dot-named)
    Route::get('/admin/tasks', [\App\Http\Controllers\TaskController::class, 'index'])->name('admin.tasks.index');
    Route::get('/admin/tasks/create', [\App\Http\Controllers\TaskController::class, 'create'])->name('admin.tasks.create');
    Route::post('/admin/tasks', [\App\Http\Controllers\TaskController::class, 'store'])->name('admin.tasks.store');
    Route::get('/admin/tasks/{task}/edit', [\App\Http\Controllers\TaskController::class, 'edit'])->name('admin.tasks.edit');
    Route::put('/admin/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'update'])->name('admin.tasks.update');
    Route::delete('/admin/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('admin.tasks.destroy');

    // Admin User Management Routes
    Route::get('/admin/users', [\App\Http\Controllers\UserManagementController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [\App\Http\Controllers\UserManagementController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [\App\Http\Controllers\UserManagementController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [\App\Http\Controllers\UserManagementController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [\App\Http\Controllers\UserManagementController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\UserManagementController::class, 'destroy'])->name('admin.users.destroy');
});

Route::get('/logtest', function () {
    \Log::info('Log test from route');
    return 'Logged!';
});

require __DIR__.'/auth.php';
