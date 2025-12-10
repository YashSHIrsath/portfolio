<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10 animate-fade-in">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Dashboard</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2">Welcome back, {{ auth()->user()->name }}! Here's what's happening with your portfolio.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10 animate-slide-up">
            <!-- Stat Card -->
            <div class="bg-white dark:bg-[#161b22] p-6 rounded-[2rem] border border-slate-200 dark:border-white/5 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <i class="fa-solid fa-layer-group text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Tech Stack</p>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $techStackCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#161b22] p-6 rounded-[2rem] border border-slate-200 dark:border-white/5 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-purple-600 dark:text-purple-400">
                        <i class="fa-solid fa-keyboard text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Typing Texts</p>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $typingTextCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#161b22] p-6 rounded-[2rem] border border-slate-200 dark:border-white/5 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-green-50 dark:bg-green-900/20 flex items-center justify-center text-green-600 dark:text-green-400">
                        <i class="fa-solid fa-share-nodes text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Social Links</p>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $socialLinkCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>

             <div class="bg-white dark:bg-[#161b22] p-6 rounded-[2rem] border border-slate-200 dark:border-white/5 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center text-orange-600 dark:text-orange-400">
                        <i class="fa-solid fa-address-book text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Contacts</p>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $contactInfoCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
         <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-slide-up delay-100">
            
            <a href="{{ route('admin.settings.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-blue-500 to-indigo-600 rounded-[2.5rem] p-8 text-white shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-1 transition-all duration-300">
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-sliders text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">General Settings</h3>
                    <p class="text-blue-100 text-sm">Update your profile, bio, and resume.</p>
                </div>
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
            </a>

            <a href="{{ route('admin.tech-stacks.create') }}" class="group bg-white dark:bg-[#161b22] p-8 rounded-[2.5rem] border border-slate-200 dark:border-white/5 hover:border-blue-500/50 hover:shadow-lg transition-all duration-300">
                <div class="mb-4">
                    <span class="inline-block p-3 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
                        <i class="fa-solid fa-plus text-lg"></i>
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Add Tool</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Add a new technology or tool to your stack.</p>
            </a>

             <a href="{{ route('admin.contact-infos.create') }}" class="group bg-white dark:bg-[#161b22] p-8 rounded-[2.5rem] border border-slate-200 dark:border-white/5 hover:border-purple-500/50 hover:shadow-lg transition-all duration-300">
                <div class="mb-4">
                    <span class="inline-block p-3 rounded-xl bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400">
                        <i class="fa-solid fa-phone text-lg"></i>
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">Add Contact</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Add a new way for people to reach you.</p>
            </a>

        </div>
    </div>
</x-admin-layout>
