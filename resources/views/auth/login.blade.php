@extends('layouts.app')

@section('title', 'Login - Task Manager')

@section('content')
<div class="auth-form-container">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="remember"> Remember Me</label>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
    <div class="form-footer">
        <a href="{{ route('register') }}">Don't have an account? Register</a>
        @if (Route::has('password.request'))
            <br><a href="{{ route('password.request') }}">Forgot your password?</a>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
.auth-form-container {
    max-width: 400px;
    margin: 2rem auto;
    background: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.auth-form-container h2 {
    text-align: center;
    margin-bottom: 1.5rem;
}
.form-group {
    margin-bottom: 1rem;
}
.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
}
.form-group input[type="email"],
.form-group input[type="password"] {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}
.form-error {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 0.25rem;
}
.form-footer {
    text-align: center;
    margin-top: 1rem;
}
</style>
@endsection
