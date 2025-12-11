<x-admin-layout>
    <x-slot name="title">Bio / Who Am I</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Bio / Who Am I</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2">Manage the description displayed in your "Who Am I" / Unified section.</p>
        </div>

        @if (session('success'))
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 animate-fade-in">
                <i class="fa-solid fa-circle-check text-xl"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" class="animate-slide-up">
            @csrf
            
            <div class="bg-white dark:bg-[#161b22] p-8 rounded-[2.5rem] border border-slate-200 dark:border-white/5 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">About Me Description</h3>
                
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
                    This text is shown in your main "Unified Developer Hub" or "About Me" card.
                </p>
                
                <div class="relative group">
                    <textarea name="description" rows="15" class="w-full p-6 bg-slate-50 dark:bg-[#0d1117] border-2 border-transparent focus:border-blue-500/50 rounded-2xl text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:outline-none focus:ring-0 transition-all resize-none shadow-inner leading-relaxed text-base font-light" placeholder="Write something amazing about yourself...">{{ $settings['description'] ?? '' }}</textarea>
                    
                    <div class="absolute bottom-4 right-4 text-xs text-slate-400 pointer-events-none">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-white/5 flex justify-end">
                    <button type="submit" class="group relative py-3 px-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full text-white font-bold shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 transition-all duration-300">
                        <span class="flex items-center gap-2">
                            Save Bio <i class="fa-solid fa-check group-hover:scale-110 transition-transform"></i>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
