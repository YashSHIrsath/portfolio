<x-app-layout>
    <x-slot name="title">Projects</x-slot>

    <div class="animate-fade-in text-center">
        <h1 class="text-2xl font-bold mb-2 text-slate-800 dark:text-slate-100">/projects</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mb-8 max-w-md mx-auto">A selection of my recent work.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
            @forelse($projects as $project)
            <a href="{{ $project->link ?? '#' }}" target="_blank" class="group block p-4 bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-sm transition-all animate-slide-up" style="animation-delay: {{ $loop->index * 100 }}ms">
                <div class="flex justify-between items-start mb-2 {{ $loop->first ? 'animate-pulse' : '' }}">
                    <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $project->title }}</h3>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 leading-relaxed">
                    {{ $project->description }}
                </p>
                <div class="flex gap-2 flex-wrap">
                    @if(!empty($project->tech_stack) && is_array($project->tech_stack))
                        @foreach($project->tech_stack as $tech)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">{{ $tech }}</span>
                        @endforeach
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-2 text-center py-10">
                <p class="text-slate-500 dark:text-slate-400">No projects found.</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
