<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yash Shirsath - {{ $title ?? 'Portfolio' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-[#f9f9f9] text-[#24292f] dark:bg-[#0d1117] dark:text-[#c9d1d9] transition-colors duration-300 font-mono min-h-screen flex flex-col antialiased selection:bg-blue-200 dark:selection:bg-blue-900">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="flex-grow flex flex-col justify-center container mx-auto px-6 py-12 max-w-3xl">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="py-8 text-center text-xs text-slate-500 dark:text-slate-500">
        <p class="mb-2">&copy; {{ date('Y') }} Yash Shirsath</p>
        <div class="flex justify-center gap-6">
            @if(isset($socialLinks))
                @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="hover:text-blue-500 transition-colors" title="{{ $link->platform }}">
                         @if($link->icon_class)
                            <i class="{{ $link->icon_class }} text-lg"></i>
                        @else
                            {{ $link->platform }}
                        @endif
                    </a>
                @endforeach
            @endif
        </div>
    </footer>
</body>
</html>
