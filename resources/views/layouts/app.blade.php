<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Hotel Report System</title>

        <!-- Fonts — Inter for premium typography -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            (function() {
                const theme = localStorage.getItem('theme') || 'dark';
                document.documentElement.setAttribute('data-theme', theme);
            })();
        </script>
    </head>
    <body class="min-h-screen font-sans antialiased" style="background-color: var(--bg-primary); color: var(--text-primary);">
        <div class="min-h-screen app-shell">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header style="background: var(--header-bg); backdrop-filter: blur(24px) saturate(1.2); border-bottom: 1px solid var(--border);">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pb-10">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
