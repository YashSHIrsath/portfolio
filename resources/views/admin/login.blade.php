<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0d1117] text-slate-200 font-sans antialiased min-h-screen flex items-center justify-center overflow-hidden relative bg-noise">
    
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/20 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-600/20 rounded-full blur-[100px] animate-pulse delay-1000"></div>
    </div>

    <!-- Login Card -->
    <div class="relative w-full max-w-md p-8 mx-4 bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] shadow-2xl animate-slide-up z-10">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-full flex items-center justify-center text-white shadow-lg shadow-blue-500/25">
                <i class="fa-solid fa-rocket text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-white tracking-tight">Admin Portal</h2>
            <p class="text-sm text-slate-400 mt-2 tracking-wide uppercase font-medium">Authentication Required</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
            @csrf
            
            @if ($errors->any())
                <div class="p-4 rounded-3xl bg-red-500/10 border border-red-500/20 text-red-200 text-sm text-center animate-fade-in">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i> {{ $errors->first() }}
                </div>
            @endif

            <!-- Email -->
            <div class="space-y-2 group">
                <label for="email" class="text-xs font-bold text-slate-400 uppercase tracking-wider ml-4">Email Address</label>
                <div class="relative transition-all duration-300 transform group-hover:-translate-y-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-envelope text-slate-500 group-focus-within:text-blue-500 transition-colors"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/50 border border-slate-700/50 rounded-full text-slate-100 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all font-mono text-sm shadow-inner"
                        placeholder="admin@example.com">
                </div>
            </div>

            <!-- Password -->
            <div class="space-y-2 group">
                <label for="password" class="text-xs font-bold text-slate-400 uppercase tracking-wider ml-4">Password</label>
                <div class="relative transition-all duration-300 transform group-hover:-translate-y-1">
                   <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-slate-500 group-focus-within:text-blue-500 transition-colors"></i>
                    </div>
                    <input id="password" type="password" name="password" required 
                        class="block w-full pl-11 pr-4 py-3.5 bg-slate-900/50 border border-slate-700/50 rounded-full text-slate-100 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all font-mono text-sm shadow-inner"
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between px-4">
                <label class="flex items-center space-x-2 cursor-pointer group">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-600 text-blue-600 focus:ring-blue-500 bg-slate-800 transition-colors">
                    <span class="text-sm text-slate-400 group-hover:text-slate-300 transition-colors">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-full shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-1 transition-all duration-300 text-sm tracking-widest uppercase">
                Sign In <i class="fa-solid fa-arrow-right ml-2 opacity-70"></i>
            </button>
        </form>
        
        <!-- Footer -->
        <div class="mt-8 pt-6 border-t border-white/5 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-white transition-colors duration-300 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full">
                <i class="fa-solid fa-arrow-left"></i> Back to Portfolio
            </a>
        </div>
    </div>

</body>
</html>
