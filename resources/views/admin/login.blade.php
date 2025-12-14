<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Borel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-[#f9f9f9] dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 font-mono min-h-screen flex items-center justify-center relative transition-colors duration-300">
    
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-20%] left-[-20%] w-[60%] h-[60%] bg-blue-500/10 dark:bg-blue-600/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-[-20%] right-[-20%] w-[60%] h-[60%] bg-purple-500/10 dark:bg-purple-600/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <!-- Login Card -->
    <div class="relative w-full max-w-md mx-4 bg-white/80 dark:bg-[#161b22]/80 backdrop-blur-md border border-slate-200/60 dark:border-white/10 rounded-[2.5rem] shadow-xl dark:shadow-2xl p-8 z-10">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-user-shield text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2" style="font-family: 'Borel', sans-serif;">Admin Portal</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 tracking-wide uppercase font-medium">Secure Access</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
            @csrf
            
            @if ($errors->any())
                <div class="p-4 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-600 dark:text-red-300 text-sm text-center mb-6">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ $errors->first() }}
                </div>
            @endif

            <!-- Email -->
            <div class="space-y-3">
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 ml-1">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-envelope text-slate-400 dark:text-slate-500"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="block w-full pl-11 pr-4 py-4 bg-white dark:bg-slate-900/50 border border-slate-300 dark:border-slate-700 rounded-2xl text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                        placeholder="admin@example.com">
                </div>
            </div>

            <!-- Password -->
            <div class="space-y-3">
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 ml-1">Password</label>
                <div class="relative">
                   <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-slate-400 dark:text-slate-500"></i>
                    </div>
                    <input id="password" type="password" name="password" required 
                        class="block w-full pl-11 pr-4 py-4 bg-white dark:bg-slate-900/50 border border-slate-300 dark:border-slate-700 rounded-2xl text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center px-1">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-800">
                    <span class="text-sm text-slate-600 dark:text-slate-400">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-4 px-6 bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-bold rounded-2xl shadow-lg hover:scale-105 transition-all duration-300 text-sm">
                Sign In <i class="fa-solid fa-arrow-right ml-2"></i>
            </button>
        </form>
        
        <!-- Footer -->
        <div class="mt-8 pt-6 border-t border-slate-200/60 dark:border-white/10 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors duration-300 bg-slate-100/50 dark:bg-white/5 hover:bg-slate-200/50 dark:hover:bg-white/10 px-4 py-2 rounded-full">
                <i class="fa-solid fa-arrow-left"></i> Back to Portfolio
            </a>
        </div>
    </div>

</body>
</html>
