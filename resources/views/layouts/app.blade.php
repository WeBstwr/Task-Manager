<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <!-- Custom JS -->
        <script src="{{ asset('js/scripts.js') }}" defer></script>
    </head>
    <body>
        <div class="container">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="header">
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="main-content">
                @yield('content')
            </main>

            <footer class="footer">
                <p>&copy; {{ date('Y') }} Task Manager. All rights reserved.</p>
            </footer>
        </div>
    </body>
</html>
