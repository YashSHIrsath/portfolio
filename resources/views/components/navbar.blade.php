<nav class="sticky top-0 z-50 bg-[#f9f9f9]/90 dark:bg-[#0d1117]/90 backdrop-blur-sm border-b border-slate-200 dark:border-slate-800 transition-colors duration-300">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="flex items-center justify-between h-14">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="font-bold text-slate-800 dark:text-slate-100 hover:text-blue-600 dark:hover:text-blue-400 transition-colors text-sm">
                ~/yash_shirsath
            </a>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-600 dark:text-slate-300 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-6 text-xs font-medium">
                <a href="{{ route('home') }}" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 {{ request()->routeIs('home') ? 'text-blue-600 dark:text-blue-400' : '' }} transition-colors">/home</a>
                <a href="{{ route('about') }}" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 {{ request()->routeIs('about') ? 'text-blue-600 dark:text-blue-400' : '' }} transition-colors">/about</a>
                <a href="{{ route('experience') }}" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 {{ request()->routeIs('experience') ? 'text-blue-600 dark:text-blue-400' : '' }} transition-colors">/experience</a>
                <a href="{{ route('projects') }}" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 {{ request()->routeIs('projects') ? 'text-blue-600 dark:text-blue-400' : '' }} transition-colors">/projects</a>
                <a href="{{ route('contact') }}" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 {{ request()->routeIs('contact') ? 'text-blue-600 dark:text-blue-400' : '' }} transition-colors">/contact</a>
                
                <!-- Theme Toggle -->
                <button id="theme-toggle" class="p-1.5 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 transition-colors focus:outline-none ml-2" aria-label="Toggle Theme">
                    <!-- Sun Icon -->
                    <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <!-- Moon Icon -->
                    <svg class="w-4 h-4 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#f9f9f9] dark:bg-[#0d1117] border-t border-slate-200 dark:border-slate-800">
        <div class="flex flex-col px-6 py-4 space-y-2 text-sm">
            <a href="{{ route('home') }}" class="block py-2 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">/home</a>
            <a href="{{ route('about') }}" class="block py-2 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">/about</a>
            <a href="{{ route('experience') }}" class="block py-2 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">/experience</a>
            <a href="{{ route('projects') }}" class="block py-2 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">/projects</a>
            <a href="{{ route('contact') }}" class="block py-2 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">/contact</a>
        </div>
    </div>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        themeToggleBtn.addEventListener('click', () => {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</nav>
