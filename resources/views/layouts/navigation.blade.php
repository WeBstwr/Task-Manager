<nav class="nav">
    <div class="nav-brand">
        <h1>Task Manager</h1>
    </div>
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
            @if(auth()->user()->isAdmin())
                <li><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
            @endif
            <li><a href="#">Profile</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-link" style="background:none;border:none;padding:0;color:#007bff;cursor:pointer;">Logout</button>
                </form>
            </li>
        @endguest
    </ul>
</nav>
