<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - {{ $title ?? 'Dashboard' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dark Mode Script -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-[#0d1117] text-slate-800 dark:text-slate-200 font-sans antialiased transition-colors duration-300 bg-noise" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex flex-col md:flex-row">
        
        <!-- Mobile Menu Button -->
        <div class="md:hidden fixed top-4 left-4 z-50">
            <button @click="sidebarOpen = !sidebarOpen" class="w-10 h-10 rounded-xl bg-white dark:bg-[#161b22] border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-400 shadow-lg">
                <i class="fa-solid fa-bars" x-show="!sidebarOpen"></i>
                <i class="fa-solid fa-times" x-show="sidebarOpen"></i>
            </button>
        </div>
        
        <!-- Sidebar -->
        <aside class="fixed md:static inset-y-0 left-0 w-72 bg-white dark:bg-[#161b22] border-r border-slate-200 dark:border-slate-800 flex-shrink-0 z-40 transition-all duration-300 transform md:transform-none" :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }" x-show="sidebarOpen || window.innerWidth >= 768" x-transition>
            <!-- Logo Area -->
            <div class="h-20 flex items-center px-8 border-b border-slate-100 dark:border-slate-800/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg tracking-tight">Portfolio</h1>
                        <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-6 space-y-2">
                <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Menu</p>
                
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/25' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-blue-600 dark:hover:text-blue-400' }}">
                    <i class="fa-solid fa-gauge-high w-5 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Home Page Group -->
                <div x-data="{ open: {{ request()->is('admin/typing-texts*') || request()->is('admin/contact-infos*') || request()->is('admin/social-links*') || request()->is('admin/key-values*') || request()->is('admin/tech-stacks*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-300 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-blue-600 dark:hover:text-blue-400">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-house w-5 text-center"></i>
                            <span class="font-medium">Home Page</span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="pl-4 space-y-1">
                        
                        <a href="{{ route('admin.typing-texts.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.typing-texts.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                            <i class="fa-solid fa-keyboard w-4 text-center text-xs"></i>
                            <span class="text-sm">Typing Texts</span>
                        </a>

                        <a href="{{ route('admin.key-values.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.key-values.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                            <i class="fa-solid fa-chart-simple w-4 text-center text-xs"></i>
                            <span class="text-sm">Stats (Cat Stack)</span>
                        </a>


                        <a href="{{ route('admin.tech-stacks.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.tech-stacks.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                            <i class="fa-solid fa-layer-group w-4 text-center text-xs"></i>
                            <span class="text-sm">Visual Icons (Home)</span>
                        </a>

                        <a href="{{ route('admin.contact-infos.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.contact-infos.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                            <i class="fa-solid fa-address-book w-4 text-center text-xs"></i>
                            <span class="text-sm">Contact Info</span>
                        </a>
                        
                        <a href="{{ route('admin.social-links.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.social-links.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                            <i class="fa-solid fa-share-nodes w-4 text-center text-xs"></i>
                            <span class="text-sm">Social Links</span>
                        </a>
                    </div>
                </div>

                <!-- About Page Group -->
                <div x-data="{ open: {{ request()->is('admin/bios*') || request()->is('admin/cat-stacks*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-300 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-blue-600 dark:hover:text-blue-400">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-user-astronaut w-5 text-center"></i>
                            <span class="font-medium">About Page</span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="pl-4 space-y-1">
                        
                         <a href="{{ route('admin.bios.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.bios.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                            <i class="fa-solid fa-address-card w-4 text-center text-xs"></i>
                            <span class="text-sm">Bio / Who Am I</span>
                        </a>

                         <a href="{{ route('admin.cat-stacks.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.cat-stacks.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                            <i class="fa-solid fa-code w-4 text-center text-xs"></i>
                            <span class="text-sm">Cat Stack Section</span>
                        </a>
                    </div>
                </div>

                <!-- Experience Group -->
                <div x-data="{ open: {{ request()->is('admin/experiences*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-300 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-blue-600 dark:hover:text-blue-400">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-briefcase w-5 text-center"></i>
                            <span class="font-medium">Experience</span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="pl-4 space-y-1">
                        <a href="{{ route('admin.experiences.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.experiences.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                            <i class="fa-solid fa-timeline w-4 text-center text-xs"></i>
                            <span class="text-sm">Work History</span>
                        </a>
                    </div>
                </div>

                <!-- Projects -->
                <a href="{{ route('admin.projects.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.projects.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/25' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-blue-600 dark:hover:text-blue-400' }}">
                    <i class="fa-solid fa-folder-open w-5 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Projects</span>
                </a>

                <!-- Messages -->
                <a href="{{ route('admin.contact-submissions.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.contact-submissions.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/25' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-blue-600 dark:hover:text-blue-400' }}">
                    <i class="fa-solid fa-envelope w-5 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Messages</span>
                </a>
                
                <!-- Settings (Bottom) -->
                <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-800">
                    <div x-data="{ open: {{ request()->is('admin/settings*') || request()->is('admin/github-settings*') || request()->is('admin/contact-settings*') ? 'true' : 'false' }} }" class="space-y-1">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-300 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-blue-600 dark:hover:text-blue-400">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-cog w-5 text-center"></i>
                                <span class="font-medium">Settings</span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="pl-4 space-y-1">
                            <a href="{{ route('admin.settings.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.settings.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                                <i class="fa-solid fa-sliders w-4 text-center text-xs"></i>
                                <span class="text-sm">General Settings</span>
                            </a>
                            
                            <a href="{{ route('admin.github-settings.edit') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.github-settings.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                                <i class="fa-brands fa-github w-4 text-center text-xs"></i>
                                <span class="text-sm">GitHub Settings</span>
                            </a>
                            
                            <a href="{{ route('admin.contact-settings.edit') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.contact-settings.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/10' : 'text-slate-500 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
                                <i class="fa-solid fa-envelope-open-text w-4 text-center text-xs"></i>
                                <span class="text-sm">Contact Form Settings</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Overlay for mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-30 md:hidden" x-transition></div>
        
        <!-- Main Area -->
        <div class="flex-1 flex flex-col min-h-screen min-w-0 overflow-hidden md:ml-0">
            
            <!-- Top Navbar -->
            <header class="bg-white/80 dark:bg-[#161b22]/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 h-20 flex items-center justify-between px-8 md:px-8 pl-16 md:pl-8 sticky top-0 z-30 transition-colors duration-300">
                <!-- Left: Home Link -->
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 dark:text-slate-400 dark:hover:text-white transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center group-hover:bg-blue-50 dark:group-hover:bg-blue-500/20 transition-colors">
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </div>
                    <span>View Website</span>
                </a>

                <!-- Right: Actions -->
                <div class="flex items-center gap-4">
                    
                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:text-yellow-500 dark:hover:text-yellow-400 transition-colors">
                        <i class="fa-solid fa-sun hidden dark:block"></i>
                        <i class="fa-solid fa-moon dark:hidden"></i>
                    </button>

                    <!-- Profile Pill -->
                    <div class="flex items-center gap-3 pl-4 pr-2 py-1.5 bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-full">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-slate-900 dark:text-white">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-[10px] font-medium text-slate-500">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                        </div>
                        <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center text-white text-xs font-bold shadow-md overflow-hidden">
                            @php
                                $profileImage = \App\Models\Setting::first()->profile_image ?? null;
                            @endphp
                            @if($profileImage)
                                <img src="{{ Storage::url($profileImage) }}" alt="{{ Auth::user()->name }}" class="h-full w-full object-cover">
                            @else
                                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                            @endif
                        </div>
                        
                        <!-- Logout Action -->
                        <form action="{{ route('admin.logout') }}" method="POST" class="border-l border-slate-200 dark:border-white/10 pl-2">
                            @csrf
                            <button type="submit" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all" title="Logout">
                                <i class="fa-solid fa-power-off text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-8 relative">
                <!-- Background Decoration -->
                <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-blue-50/50 to-transparent dark:from-blue-900/5 dark:to-transparent pointer-events-none -z-10"></div>
                
                <!-- Flash Messages -->
                <x-flash-message />
                
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Alpine.js (Lightweight for Dropdowns) -->
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <script>
        // Theme Toggle Logic
        const themeToggleBtn = document.getElementById('theme-toggle');
        
        themeToggleBtn.addEventListener('click', function() {
            // if set via local storage previously
            if (localStorage.getItem('theme')) {
                if (localStorage.getItem('theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            
            // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
        });
        
        // Auto-close mobile menu on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                document.querySelector('[x-data]').__x.$data.sidebarOpen = false;
            }
        });
    </script>
</body>
</html>
