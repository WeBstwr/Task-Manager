@extends('layouts.app')

@section('title', 'Dashboard - Task Manager')

@section('content')
<div class="dashboard">
    <div class="dashboard-header">
        <h2>Welcome to Your Task Manager</h2>
        <p>Organize your tasks and boost your productivity</p>
    </div>

    <div class="dashboard-stats">
        <div class="stat-card card">
            <h3>Total Tasks</h3>
            <p class="stat-number">{{ $totalTasks ?? 0 }}</p>
        </div>
        <div class="stat-card card">
            <h3>Completed</h3>
            <p class="stat-number">{{ $completedTasks ?? 0 }}</p>
        </div>
        <div class="stat-card card">
            <h3>Pending</h3>
            <p class="stat-number">{{ $pendingTasks ?? 0 }}</p>
        </div>
        <div class="stat-card card">
            <h3>Overdue</h3>
            <p class="stat-number">{{ $overdueTasks ?? 0 }}</p>
        </div>
    </div>

    @if(auth()->check() && auth()->user()->isAdmin())
        <!-- Admin Dashboard Actions -->
        <div class="dashboard-actions">
            <a href="{{ route('admin.tasks.create') }}" class="btn">Create New Task</a>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">View All Tasks</a>
        </div>
    @else
        <!-- Regular User Dashboard Actions -->
        <div class="dashboard-actions">
            <a href="{{ route('tasks.index') }}" class="btn">View My Tasks</a>
        </div>
    @endif

    <div class="recent-tasks">
        <h3>Recent Tasks</h3>
        <ul>
            @forelse($recentTasks as $task)
                <li>
                    {{ $task->title }} ({{ ucfirst(str_replace('_', ' ', $task->status)) }})
                    - Due: {{ $task->due_date ? $task->due_date->format('Y-m-d') : '-' }}
                </li>
            @empty
                <li>No recent tasks found.</li>
            @endforelse
        </ul>
    </div>

    @if(auth()->check() && auth()->user()->isAdmin())
        
    @endif
</div>
@endsection

@section('styles')
<style>
.dashboard-header {
    text-align: center;
    margin-bottom: 2rem;
}

.dashboard-header h2 {
    color: #333;
    margin-bottom: 0.5rem;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    text-align: center;
    padding: 1.5rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #007bff;
    margin: 0;
}

.dashboard-actions {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    justify-content: center;
}

.btn-secondary {
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #545b62;
}

.recent-tasks {
    margin-bottom: 2rem;
}

.task-form-section {
    max-width: 600px;
    margin: 0 auto;
}

.task-form {
    background-color: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.task-item {
    border-left: 4px solid #007bff;
    margin-bottom: 1rem;
}

.task-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.task-title {
    flex: 1;
    margin: 0;
}

.task-title.completed {
    text-decoration: line-through;
    color: #6c757d;
}

.task-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.9rem;
    color: #666;
}

.priority {
    padding: 0.2rem 0.5rem;
    border-radius: 3px;
    font-size: 0.8rem;
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

.alert {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 4px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>
@endsection 