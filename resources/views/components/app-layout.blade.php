@php
    $settings = \App\Models\Setting::pluck('value', 'key');
    $firstName = $settings['first_name'] ?? 'Portfolio';
    $lastName = $settings['last_name'] ?? 'Owner';
    $fullName = trim($firstName . ' ' . $lastName);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $fullName }} - {{ $title ?? 'Portfolio' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Baumans&family=Borel&family=Playwrite+DE+Grund:wght@100..400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            scroll-behavior: smooth;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Cursive name styling to avoid clipping and improve rendering */
        .name-cursive {
            font-family: 'Edu SA Hand', cursive;
            display: inline-block;
            line-height: 1.05;
            padding-top: 0.06em;
            transform: translateY(0.02em);
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        /* Name entrance + hover animation */
        .name-animate .first-name,
        .name-animate .last-name {
            display: inline-block;
            opacity: 0;
            transform: translateY(12px) scale(0.98);
            animation: nameIn 560ms cubic-bezier(.2, .9, .2, 1) forwards;
        }

        .name-animate .last-name {
            animation-delay: 80ms;
            margin-left: 0.25rem;
        }

        @keyframes nameIn {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .name-animate:hover .first-name,
        .name-animate:hover .last-name {
            transform: translateY(-2px) scale(1.02);
            transition: transform 180ms ease;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'monospace'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js for lightweight UI state used by the Hello animation -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body
    class="bg-[#f9f9f9] text-[#24292f] dark:bg-[#0d1117] dark:text-[#c9d1d9] transition-colors duration-300 font-mono min-h-screen flex flex-col antialiased selection:bg-blue-200 dark:selection:bg-blue-900 px-4 md:px-6 xl:px-8">
    <!-- Navbar -->
    @include('components.navbar')

    @props(['mainClass' => 'flex-grow flex flex-col justify-center'])

    <!-- Main Content -->
    <main class="{{ $mainClass }} pt-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="py-8 text-center text-xs text-slate-500 dark:text-slate-500">
        <p class="mb-2">&copy; {{ date('Y') }} {{ $fullName }}</p>
        <div class="flex justify-center gap-6">
            @if (isset($socialLinks))
                @foreach ($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="hover:text-blue-500 transition-colors"
                        title="{{ $link->platform }}">
                        @if ($link->icon_class)
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
