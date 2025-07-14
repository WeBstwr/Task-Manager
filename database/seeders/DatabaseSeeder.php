<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        Task::create([
            'title' => 'Complete Project Documentation',
            'description' => 'Write comprehensive documentation for the new project features',
            'status' => 'pending',
            'priority' => 'high',
            'assigned_to' => $user1->id,
            'created_by' => $admin->id,
            'due_date' => now()->addDays(7),
        ]);

        Task::create([
            'title' => 'Review Code Changes',
            'description' => 'Review and approve recent code changes in the main branch',
            'status' => 'in_progress',
            'priority' => 'medium',
            'assigned_to' => $user2->id,
            'created_by' => $admin->id,
            'due_date' => now()->addDays(5),
        ]);
    }
}
