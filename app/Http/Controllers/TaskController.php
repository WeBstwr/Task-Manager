<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index(): View
    {
        $tasks = Task::with(['assignedUser', 'createdBy'])->orderByDesc('created_at')->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create(): View
    {
        $users = User::where('role', 'user')->get();
        return view('admin.tasks.create', compact('users'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high'],
            'assigned_to' => ['required', 'exists:users,id'],
            'due_date' => ['nullable', 'date'],
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'priority' => $validated['priority'],
            'status' => 'pending',
            'assigned_to' => $validated['assigned_to'],
            'created_by' => Auth::id(),
            'due_date' => $validated['due_date'] ?? null,
        ]);

        return Redirect::route('admin.tasks.index')->with('success', 'Task created and assigned successfully.');
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task): View
    {
        $users = User::where('role', 'user')->get();
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'assigned_to' => ['required', 'exists:users,id'],
            'due_date' => ['nullable', 'date'],
        ]);

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'assigned_to' => $validated['assigned_to'],
            'due_date' => $validated['due_date'] ?? null,
            'completed_at' => $validated['status'] === 'completed' ? now() : null,
        ]);

        return Redirect::route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Update the status of a task (for assigned user).
     */
    public function updateStatus(Request $request, Task $task)
    {
        // Only allow the assigned user to update their own task status
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }
        $validated = $request->validate([
            'status' => ['required', 'in:pending,in_progress,completed'],
        ]);
        $task->status = $validated['status'];
        if ($validated['status'] === 'completed') {
            $task->completed_at = now();
        }
        $task->save();

        return back()->with('success', 'Task status updated.');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return Redirect::route('admin.tasks.index')->with('success', 'Task deleted successfully.');
    }
} 