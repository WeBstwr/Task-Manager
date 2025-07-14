@php
    // $isAdmin = $isAdmin ?? false; // Use passed variable or default to false
@endphp

@extends('layouts.app')

@section('title', 'Tasks - Task Manager')

@section('content')
<div class="tasks-page">
    <div class="page-header">
        @if(auth()->check() && auth()->user()->isAdmin())
            <h2>All Tasks</h2>
            <p>Manage and assign tasks to users</p>
        @else
            <h2>My Tasks</h2>
            <p>View and update your assigned tasks</p>
        @endif
    </div>

    @if(auth()->check() && auth()->user()->isAdmin())
        <!-- Admin: Task Management -->
        <div class="admin-controls">
            <a href="{{ route('admin.tasks.create') }}" class="btn">Create New Task</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Manage Users</a>
        </div>
        <div class="tasks-list">
            <h3>All Tasks</h3>
            @if(isset($tasks) && count($tasks) === 0)
                <div class="alert alert-info">There are currently no tasks in the system.</div>
            @else
                <!-- Loop through tasks for admin -->
                @foreach($tasks ?? [] as $task)
                    <div class="task-item">
                        <div class="task-header">
                            <h4 class="task-title">{{ $task->title }}</h4>
                            <span class="priority priority-{{ $task->priority }}">{{ ucfirst($task->priority) }}</span>
                            <span class="status status-{{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                        </div>
                        <div class="task-meta">
                            <span>Assigned to: {{ $task->assignee_name ?? 'N/A' }}</span>
                            <span>Due: {{ $task->due_date ?? '-' }}</span>
                            <span>Created by: {{ $task->creator_name ?? 'Admin' }}</span>
                        </div>
                        <div class="task-actions">
                            <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-small">Edit</a>
                            <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    @else
        <!-- Regular User: My Tasks -->
        <div class="tasks-list">
            <h3>My Assigned Tasks</h3>
            @if(isset($tasks) && count($tasks) === 0)
                <div class="alert alert-info">You have zero tasks assigned.</div>
            @else
                <!-- Loop through tasks for user -->
                @foreach($tasks ?? [] as $task)
                    <div class="task-item">
                        <div class="task-header">
                            <h4 class="task-title">{{ $task->title }}</h4>
                            <span class="priority priority-{{ $task->priority }}">{{ ucfirst($task->priority) }}</span>
                            <span class="status status-{{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                        </div>
                        <div class="task-meta">
                            <span>Due: {{ $task->due_date ?? '-' }}</span>
                            <span>Assigned by: {{ $task->creator_name ?? 'Admin' }}</span>
                        </div>
                        <div class="task-actions">
                            <form method="POST" action="{{ route('tasks.status.update', $task) }}" style="display:inline-flex;align-items:center;gap:0.5rem;">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="status-select">
                                    <option value="pending" @if($task->status == 'pending') selected @endif>Pending</option>
                                    <option value="in_progress" @if($task->status == 'in_progress') selected @endif>In Progress</option>
                                    <option value="completed" @if($task->status == 'completed') selected @endif>Completed</option>
                                </select>
                                <button type="submit" class="btn btn-small">Update Status</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    @endif
</div>
@endsection

@section('styles')
<style>
.page-header {
    text-align: center;
    margin-bottom: 2rem;
}

.page-header h2 {
    color: #333;
    margin-bottom: 0.5rem;
}

.admin-controls {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    justify-content: center;
}

.tasks-list {
    max-width: 800px;
    margin: 0 auto;
}

.task-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.task-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.task-title {
    flex: 1;
    margin: 0;
    color: #333;
}

.task-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 1rem;
}

.task-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.priority {
    padding: 0.2rem 0.5rem;
    border-radius: 3px;
    font-size: 0.8rem;
    font-weight: bold;
}

.priority-high {
    background-color: #dc3545;
    color: white;
}

.priority-medium {
    background-color: #ffc107;
    color: #333;
}

.priority-low {
    background-color: #28a745;
    color: white;
}

.status {
    padding: 0.2rem 0.5rem;
    border-radius: 3px;
    font-size: 0.8rem;
    font-weight: bold;
}

.status-pending {
    background-color: #6c757d;
    color: white;
}

.status-in-progress {
    background-color: #007bff;
    color: white;
}

.status-completed {
    background-color: #28a745;
    color: white;
}

.status-select {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 0.9rem;
}

.btn-small {
    padding: 0.25rem 0.5rem;
    font-size: 0.8rem;
}

.alert-info {
    background-color: #e9f7fd;
    color: #31708f;
    border: 1px solid #bce8f1;
    padding: 1rem;
    border-radius: 4px;
    margin-bottom: 1rem;
    text-align: center;
}
</style>
@endsection 