@extends('layouts.app')

@section('title', 'Manage Tasks - Task Manager')

@section('content')
<div class="container">
    <h2>Manage Tasks</h2>
    <a href="{{ route('admin.tasks.create') }}" class="btn">Create New Task</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->assignedUser->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 