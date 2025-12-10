<x-app-layout>
    <x-slot name="title">Projects</x-slot>

    <div class="animate-fade-in text-center">
        <h1 class="text-2xl font-bold mb-2 text-slate-800 dark:text-slate-100">/projects</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mb-8 max-w-md mx-auto">A selection of my recent work.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
            <!-- Project Card 1 -->
            <a href="#" class="group block p-4 bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-sm transition-all animate-slide-up delay-100">
                <div class="flex justify-between items-start mb-2 animate-pulse">
                    <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Portfolio V2</h3>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 leading-relaxed">
                    Modern portfolio website built with Laravel 11 and Tailwind CSS. Features dark mode and clean typography.
                </p>
                <div class="flex gap-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">Laravel</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400">Tailwind</span>
                </div>
            </a>

            <!-- Project Card 2 -->
            <a href="#" class="group block p-4 bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-sm transition-all animate-slide-up delay-200">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">E-Commerce API</h3>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 leading-relaxed">
                    RESTful API for online store management. Includes auth, product handling, and payment integration.
                </p>
                <div class="flex gap-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400">Node.js</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-purple-50 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">PostgreSQL</span>
                </div>
            </a>
            
             <!-- Project Card 3 -->
            <a href="#" class="group block p-4 bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-sm transition-all animate-slide-up delay-300">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Task Manager</h3>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 leading-relaxed">
                    Productivity application with drag-and-drop kanban boards and real-time updates.
                </p>
                <div class="flex gap-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-cyan-50 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-400">React</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-orange-50 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400">Firebase</span>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
