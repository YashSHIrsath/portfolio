<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- JetBrains Mono Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Inline script to apply theme immediately and prevent flash -->
    <script>
        (function() {
            try {
                const theme = localStorage.getItem('theme') || 'dark';
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch(e) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body class="bg-white dark:bg-[#0d1117] text-gray-900 dark:text-[#e6edf3] transition-colors" style="font-family: 'JetBrains Mono', monospace;">
    @include('components.navbar')
    
    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/theme/theme.js') }}" defer></script>
    <script src="{{ asset('js/navbar/navbar.js') }}" defer></script>
</body>
</html>

