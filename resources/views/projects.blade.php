<x-app-layout>
    <x-slot name="title">Projects</x-slot>

    <x-page-header 
        title="/projects" 
        description="A curated collection of my recent work, showcasing innovation and technical excellence." 
    />

    <!-- Projects Grid -->
    <div class="relative pb-12">
        <div class="max-w-6xl mx-auto px-4 md:px-0">
            @if ($projects->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                    @foreach ($projects as $project)
                        <article class="group relative" x-data="{ showModal: false }">
                            <!-- Project Card -->
                            <div @click="showModal = true"
                                class="relative bg-white dark:bg-[#161b22] rounded-3xl border border-slate-200/60 dark:border-slate-800/60 shadow-xl shadow-slate-900/5 dark:shadow-black/20 hover:shadow-2xl hover:shadow-slate-900/10 dark:hover:shadow-black/40 transition-all duration-700 cursor-pointer overflow-hidden group-hover:-translate-y-2 group-hover:scale-[1.02]">

                                <!-- Project Image/Preview -->
                                <div
                                    class="relative h-64 md:h-80 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 overflow-hidden">
                                    @if ($project->image_path)
                                        <img src="{{ Storage::url($project->image_path) }}" alt="{{ $project->title }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                            onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-blue-500/10 to-purple-500/10 flex items-center justify-center\'><div class=\'text-center space-y-4\'><i class=\'fa-solid fa-code text-4xl text-slate-400\'></i><p class=\'text-sm font-medium text-slate-500\'>{{ $project->title }}</p></div></div>'">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-blue-500/10 to-purple-500/10 flex items-center justify-center">
                                            <div class="text-center space-y-4">
                                                <i class="fa-solid fa-code text-4xl text-slate-400"></i>
                                                <p class="text-sm font-medium text-slate-500">{{ $project->title }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    </div>

                                    <!-- Hover Icon -->
                                    <div
                                        class="absolute top-6 right-6 w-12 h-12 bg-white/90 dark:bg-black/80 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                        <i
                                            class="fa-solid fa-arrow-up-right-from-square text-slate-700 dark:text-white"></i>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6 space-y-4">
                                    <div class="space-y-4">
                                        <h2
                                            class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white tracking-tight group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                                            {{ $project->title }}
                                        </h2>
                                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-lg">
                                            {{ Str::limit($project->description, 120) }}
                                        </p>
                                    </div>

                                    <!-- Tech Stack -->
                                    @if (!empty($project->tech_stack) && is_array($project->tech_stack))
                                        <div class="flex flex-wrap gap-2">
                                            @foreach (array_slice($project->tech_stack, 0, 4) as $tech)
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-medium rounded-full border border-slate-200 dark:border-slate-700">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                            @if (count($project->tech_stack) > 4)
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-sm font-medium rounded-full border border-blue-200 dark:border-blue-800">
                                                    +{{ count($project->tech_stack) - 4 }} more
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- CTA -->
                                    <div class="pt-4">
                                        <div
                                            class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 font-semibold group-hover:gap-3 transition-all duration-300">
                                            <span>View Details</span>
                                            <i
                                                class="fa-solid fa-arrow-right text-sm transform group-hover:translate-x-1 transition-transform duration-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Premium Modal -->
                            <div x-show="showModal" x-cloak @click.self="showModal = false"
                                @keydown.escape.window="showModal = false"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-md">

                                <div x-transition:enter="transition ease-out duration-300 delay-75"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="relative bg-white dark:bg-[#161b22] rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">

                                    <!-- Close Button -->
                                    <button @click="showModal = false"
                                        class="absolute top-6 right-6 z-10 w-10 h-10 bg-white/90 dark:bg-black/80 backdrop-blur-sm rounded-full flex items-center justify-center text-slate-500 hover:text-slate-700 dark:hover:text-white transition-colors shadow-lg">
                                        <i class="fa-solid fa-times"></i>
                                    </button>

                                    <div class="overflow-y-auto max-h-[90vh]">
                                        <!-- Modal Image -->
                                        <div class="relative max-w-xl mx-auto mb-3 mt-3">
                                            @if ($project->image_path)
                                                <div
                                                    class="relative bg-slate-100 dark:bg-slate-800 rounded-2xl overflow-hidden">
                                                    <img src="{{ Storage::url($project->image_path) }}"
                                                        alt="{{ $project->title }}"
                                                        class="w-full h-auto object-contain">
                                                </div>
                                            @else
                                                <div
                                                    class="w-full h-64 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-2xl flex items-center justify-center">
                                                    <div class="text-center space-y-6">
                                                        <i class="fa-solid fa-code text-6xl text-slate-400"></i>
                                                        <p
                                                            class="text-xl font-semibold text-slate-600 dark:text-slate-300">
                                                            {{ $project->title }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Modal Content -->
                                        <div class="p-8 md:p-12 space-y-8">
                                            <div class="space-y-6">
                                                <h1
                                                    class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white tracking-tight">
                                                    {{ $project->title }}
                                                </h1>
                                                <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                                                    {{ $project->description }}
                                                </p>
                                            </div>

                                            <!-- Full Tech Stack -->
                                            @if (!empty($project->tech_stack) && is_array($project->tech_stack))
                                                <div class="space-y-4">
                                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                                                        Technologies Used</h3>
                                                    <div class="flex flex-wrap gap-3">
                                                        @foreach ($project->tech_stack as $tech)
                                                            <span
                                                                class="inline-flex items-center px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-medium rounded-xl border border-slate-200 dark:border-slate-700">
                                                                {{ $tech }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Action Buttons -->
                                            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                                                @if ($project->link)
                                                    <a href="{{ $project->link }}" target="_blank"
                                                        class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-semibold rounded-2xl hover:bg-slate-800 dark:hover:bg-slate-100 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                                        <span>View Live Project</span>
                                                        <i class="fa-solid fa-external-link"></i>
                                                    </a>
                                                @endif
                                                <button @click="showModal = false"
                                                    class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-semibold rounded-2xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-all duration-300">
                                                    <span>Close</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-24 space-y-8">
                    <div
                        class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto">
                        <i class="fa-solid fa-folder-open text-3xl text-slate-400"></i>
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">No Projects Yet</h3>
                        <p class="text-slate-600 dark:text-slate-400 max-w-md mx-auto">
                            Projects will appear here once they're added to the portfolio.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- GitHub Repositories Section -->
    @if (!empty($githubRepos))
        <div class="relative py-24 bg-slate-50/50 dark:bg-[#0d1117]/50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center space-y-8 mb-16">
                    <div
                        class="inline-flex items-center gap-3 px-4 py-2 bg-white/60 dark:bg-white/5 backdrop-blur-sm border border-white/40 dark:border-white/10 rounded-full shadow-lg">
                        <i class="fa-brands fa-github text-slate-600 dark:text-slate-300"></i>
                        <span class="text-sm font-semibold text-slate-600 dark:text-slate-300 tracking-wide">OPEN
                            SOURCE</span>
                    </div>
                    <div class="space-y-4">
                        <h2 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white tracking-tight">
                            GitHub Repositories
                        </h2>
                        <p class="text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">
                            Explore my open-source contributions and personal projects on GitHub.
                        </p>
                    </div>
                </div>

                <div x-data="{ showAll: false }" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($githubRepos as $index => $repo)
                            <a href="{{ $repo['html_url'] }}" target="_blank"
                                class="group block p-6 bg-white dark:bg-[#161b22] rounded-2xl border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                                @if ($index >= 6) x-show="showAll" x-cloak x-transition @endif>

                                <div class="space-y-4">
                                    <div class="flex items-start justify-between">
                                        <h3
                                            class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors font-mono">
                                            {{ $repo['name'] }}
                                        </h3>
                                        <div class="flex items-center gap-1 text-sm text-slate-500">
                                            <i class="fa-regular fa-star"></i>
                                            <span>{{ $repo['stargazers_count'] }}</span>
                                        </div>
                                    </div>

                                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed line-clamp-3">
                                        {{ $repo['description'] ?? 'No description available.' }}
                                    </p>

                                    <div class="flex items-center justify-between pt-2">
                                        @if ($repo['language'])
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-medium rounded-full">
                                                {{ $repo['language'] }}
                                            </span>
                                        @else
                                            <span></span>
                                        @endif
                                        <span class="text-xs text-slate-400">
                                            {{ \Carbon\Carbon::parse($repo['updated_at'])->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if (count($githubRepos) > 6)
                        <div class="text-center pt-8">
                            <button @click="showAll = !showAll"
                                class="inline-flex items-center gap-3 px-8 py-4 bg-white dark:bg-[#161b22] border border-slate-200 dark:border-slate-700 rounded-2xl font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all duration-300 shadow-lg">
                                <span x-text="showAll ? 'Show Less' : 'Show More'"></span>
                                <i class="fa-solid fa-chevron-down transition-transform duration-300"
                                    :class="{ 'rotate-180': showAll }"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
