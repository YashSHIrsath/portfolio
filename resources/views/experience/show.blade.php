<x-app-layout>
<x-app-layout>
    <div class="min-h-screen pt-10 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto space-y-8">
            
            <!-- Back Button -->
            <a href="{{ route('experience') }}" class="group inline-flex items-center text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 mb-4">
                <i class="fa-solid fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                <span class="font-medium">Back to Timeline</span>
            </a>

            <!-- Header Section (Compact) -->
            <div class="bg-white dark:bg-[#161b22] rounded-3xl p-8 shadow-xl border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row gap-6 md:items-center justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                                {{ $experience->position }}
                            </h1>
                            <span class="px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-xs font-bold uppercase tracking-wide border border-blue-100 dark:border-blue-800">
                                {{ $experience->duration }}
                            </span>
                        </div>
                        <div class="flex items-center text-lg text-slate-600 dark:text-slate-300 font-bold">
                            <i class="fa-solid fa-building text-blue-500 mr-2"></i>
                            {{ $experience->company }}
                        </div>
                    </div>
                </div>

                <div class="mt-6 prose prose-lg dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed font-medium border-t border-slate-100 dark:border-slate-800 pt-6">
                    {!! nl2br(e($experience->description)) !!}
                </div>
            </div>

            <!-- Projects Section -->
            @if($projects->count() > 0)
                <div class="space-y-6 animate-fade-in-up">
                    <div class="flex items-center gap-4 py-4">
                        <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
                        <h2 class="text-xl font-bold text-slate-400 uppercase tracking-widest">Key Projects</h2>
                        <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($projects as $project)
                            <div class="bg-white dark:bg-[#161b22] rounded-[2rem] overflow-hidden border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col">
                                
                                <!-- Project Image -->
                                @if($project->image_path)
                                    <div class="h-56 w-full overflow-hidden relative">
                                        <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#161b22] to-transparent opacity-60"></div>
                                    </div>
                                @else
                                    <div class="h-24 bg-gradient-to-r from-slate-100 to-slate-200 dark:from-slate-800 dark:to-[#0d1117] w-full"></div>
                                @endif

                                <div class="p-8 flex-1 flex flex-col">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-2xl font-black text-slate-900 dark:text-white group-hover:text-blue-500 transition-colors">
                                            {{ $project->title }}
                                        </h3>
                                        @if($project->duration)
                                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-xs font-bold border border-slate-200 dark:border-slate-700 whitespace-nowrap ml-2">
                                                {{ $project->duration }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <p class="text-slate-600 dark:text-slate-400 mb-6 leading-relaxed flex-1">
                                        {{ $project->description }}
                                    </p>

                                    <!-- Tech Stack Pills -->
                                    @if($project->tech_stack && count($project->tech_stack) > 0)
                                        <div class="flex flex-wrap gap-2 mb-6">
                                            @foreach($project->tech_stack as $tech)
                                                <span class="px-3 py-1 bg-blue-50 dark:bg-blue-900/10 text-blue-600 dark:text-blue-300 rounded-full text-xs font-bold border border-blue-100 dark:border-blue-800/30">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if($project->link)
                                        <a href="{{ $project->link }}" target="_blank" class="inline-flex items-center justify-center w-full px-4 py-3 bg-slate-900 dark:bg-slate-800 hover:bg-blue-600 dark:hover:bg-blue-600 text-white rounded-xl font-bold transition-all duration-300 text-sm">
                                            View Project <i class="fa-solid fa-external-link-alt ml-2"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @endif

            <!-- Linked Repositories Section -->
            @if(is_array($experience->github_repos) && count($experience->github_repos) > 0)
                <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="flex items-center gap-4 py-4">
                        <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
                        <h2 class="text-xl font-bold text-slate-400 uppercase tracking-widest">
                            <i class="fa-brands fa-github mr-2"></i> Linked Repositories
                        </h2>
                        <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($experience->github_repos as $repo)
                            @php 
                                // Safely handle strings/arrays
                                $repo = is_string($repo) ? json_decode($repo, true) : (array) $repo; 
                                if (!isset($repo['html_url'])) continue; 
                            @endphp
                            <a href="{{ $repo['html_url'] }}" target="_blank" class="group block p-6 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 hover:border-slate-400 dark:hover:border-slate-600 hover:shadow-lg transition-all">
                                <div class="flex flex-col items-start gap-2 mb-3">
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors font-mono">
                                        {{ $repo['name'] }}
                                    </h3>
                                    <div class="flex items-center gap-1.5 text-xs text-slate-500 bg-white dark:bg-slate-800 px-2 py-0.5 rounded-md border border-slate-200 dark:border-slate-700">
                                        <i class="fa-regular fa-star text-yellow-500"></i>
                                        <span class="font-bold">{{ $repo['stargazers_count'] }}</span>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 leading-relaxed line-clamp-2">
                                    {{ $repo['description'] ?? 'No description available.' }}
                                </p>
                                <div class="flex justify-between items-center mt-auto">
                                    @if(isset($repo['language']) && $repo['language'])
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                                            <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                                            {{ $repo['language'] }}
                                        </span>
                                    @endif
                                    <span class="text-xs text-slate-400 font-medium">
                                        Updated {{ \Carbon\Carbon::parse($repo['updated_at'])->diffForHumans() }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
</x-app-layout>
