<x-app-layout>
    <x-slot name="title">Projects</x-slot>

    <div class="w-full max-w-6xl mx-auto px-4 md:px-0 py-6 animate-fade-in text-center">
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

        @if(!empty($githubRepos))
            <div class="mt-16 mb-8 border-t border-slate-200 dark:border-slate-800 pt-10">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <i class="fa-brands fa-github text-2xl text-slate-800 dark:text-slate-200"></i>
                    <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100">Open Source</h2>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-8 max-w-md mx-auto">
                    My Open Source Repositories.
                </p>

                <div x-data="{ showAll: false }" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                        @foreach($githubRepos as $index => $repo)
                            <a href="{{ $repo['html_url'] }}" target="_blank" 
                               class="group block p-4 bg-slate-50 dark:bg-slate-900/50 rounded-lg border border-slate-200 dark:border-slate-800 hover:border-slate-400 dark:hover:border-slate-600 hover:shadow-sm transition-all"
                               @if($index >= 4) x-show="showAll" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" @endif>
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors font-mono">
                                        {{ $repo['name'] }}
                                    </h3>
                                    <div class="flex items-center gap-2 text-xs text-slate-500">
                                        <span><i class="fa-regular fa-star mr-1"></i>{{ $repo['stargazers_count'] }}</span>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 leading-relaxed line-clamp-2 min-h-[2.5em]">
                                    {{ $repo['description'] ?? 'No description available.' }}
                                </p>
                                <div class="flex justify-between items-center mt-auto">
                                    @if($repo['language'])
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                                            {{ $repo['language'] }}
                                        </span>
                                    @else
                                        <span></span>
                                    @endif
                                    <span class="text-[10px] text-slate-400">
                                        Updated {{ \Carbon\Carbon::parse($repo['updated_at'])->diffForHumans() }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if(count($githubRepos) > 4)
                        <div class="text-center">
                            <button @click="showAll = !showAll" class="inline-flex items-center px-4 py-2 bg-white dark:bg-[#161b22] border border-slate-300 dark:border-slate-700 rounded-full font-semibold text-xs text-slate-700 dark:text-slate-300 uppercase tracking-widest shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                <span x-text="showAll ? 'Show Less' : 'Show More'"></span>
                                <i class="fa-solid fa-chevron-down ml-2 transition-transform duration-300" :class="{ 'rotate-180': showAll }"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
