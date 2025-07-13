<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager')</title>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    
    <!-- Additional CSS -->
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <div class="nav-brand">
                    <h1>Task Manager</h1>
                </div>
                <ul class="nav-links">
                    @if(isset($isAdmin) && $isAdmin)
                        <li><a href="#">Manage Users</a></li>
                        <li><a href="#">Assign Tasks</a></li>
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('tasks.index') }}">All Tasks</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Logout</a></li>
                    @else
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('tasks.index') }}">My Tasks</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Logout</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Task Manager. All rights reserved.</p>
        </div>
    </footer>

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    
    <!-- Additional JavaScript -->
    @yield('scripts')
</body>
</html>