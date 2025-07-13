@php
    $isAdmin = false; // Change to false to test regular user UI
@endphp

@extends('layouts.app')

@section('title', 'Tasks - Task Manager')

@section('content')
<div class="tasks-page">
    <div class="page-header">
        @if($isAdmin)
            <h2>All Tasks</h2>
            <p>Manage and assign tasks to users</p>
        @else
            <h2>My Tasks</h2>
            <p>View and update your assigned tasks</p>
        @endif
    </div>

    @if($isAdmin)
        <!-- Admin: Task Management -->
        <div class="admin-controls">
            <a href="{{ route('tasks.create') }}" class="btn">Create New Task</a>
            <a href="#" class="btn btn-secondary">Manage Users</a>
        </div>

        <div class="tasks-list">
            <h3>All Tasks</h3>
            <!-- Sample tasks for demonstration -->
            <div class="task-item">
                <div class="task-header">
                    <h4 class="task-title">Complete Project Documentation</h4>
                    <span class="priority priority-high">High</span>
                    <span class="status status-pending">Pending</span>
                </div>
                <div class="task-meta">
                    <span>Assigned to: John Doe</span>
                    <span>Due: 2024-01-15</span>
                    <span>Created by: Admin</span>
                </div>
                <div class="task-actions">
                    <button class="btn btn-small">Edit</button>
                    <button class="btn btn-small btn-secondary">Reassign</button>
                </div>
            </div>

            <div class="task-item">
                <div class="task-header">
                    <h4 class="task-title">Review Code Changes</h4>
                    <span class="priority priority-medium">Medium</span>
                    <span class="status status-in-progress">In Progress</span>
                </div>
                <div class="task-meta">
                    <span>Assigned to: Jane Smith</span>
                    <span>Due: 2024-01-20</span>
                    <span>Created by: Admin</span>
                </div>
                <div class="task-actions">
                    <button class="btn btn-small">Edit</button>
                    <button class="btn btn-small btn-secondary">Reassign</button>
                </div>
            </div>
        </div>
    @else
        <!-- Regular User: My Tasks -->
        <div class="tasks-list">
            <h3>My Assigned Tasks</h3>
            <!-- Sample tasks for demonstration -->
            <div class="task-item">
                <div class="task-header">
                    <h4 class="task-title">Complete Project Documentation</h4>
                    <span class="priority priority-high">High</span>
                    <span class="status status-pending">Pending</span>
                </div>
                <div class="task-meta">
                    <span>Due: 2024-01-15</span>
                    <span>Assigned by: Admin</span>
                </div>
                <div class="task-actions">
                    <select class="status-select">
                        <option value="pending" selected>Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    <button class="btn btn-small">Update Status</button>
                </div>
            </div>

            <div class="task-item">
                <div class="task-header">
                    <h4 class="task-title">Review Code Changes</h4>
                    <span class="priority priority-medium">Medium</span>
                    <span class="status status-in-progress">In Progress</span>
                </div>
                <div class="task-meta">
                    <span>Due: 2024-01-20</span>
                    <span>Assigned by: Admin</span>
                </div>
                <div class="task-actions">
                    <select class="status-select">
                        <option value="pending">Pending</option>
                        <option value="in_progress" selected>In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    <button class="btn btn-small">Update Status</button>
                </div>
            </div>
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
</style>
@endsection 