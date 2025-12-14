<x-app-layout>
    <x-slot name="title">Projects</x-slot>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <x-page-header title="/projects"
        description="A curated collection of my recent work, showcasing innovation and technical excellence." />

    <!-- Projects Grid -->
    <div class="relative pt-8 pb-12">
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
                                    @if ($project->images && count($project->images) > 0)
                                        <img src="{{ Storage::url($project->images[0]) }}" alt="{{ $project->title }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                            onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-blue-500/10 to-purple-500/10 flex items-center justify-center\'><div class=\'text-center space-y-4\'><i class=\'fa-solid fa-code text-4xl text-slate-400\'></i><p class=\'text-sm font-medium text-slate-500\'>{{ $project->title }}</p></div></div>'">
                                        @if (count($project->images) > 1)
                                            <div
                                                class="absolute top-4 right-4 bg-black/60 text-white px-2 py-1 rounded-full text-xs font-medium">
                                                +{{ count($project->images) - 1 }} more
                                            </div>
                                        @endif
                                    @elseif ($project->image_path)
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

                            <!-- Bento Grid Modal -->
                            <div x-show="showModal" x-cloak @click.self="showModal = false"
                                @keydown.escape.window="showModal = false"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-6 xl:p-8 bg-black/60 backdrop-blur-md">

                                <div x-transition:enter="transition ease-out duration-300 delay-75"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="relative bg-white/90 dark:bg-[#161b22]/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden border border-white/20 dark:border-white/10">

                                    <!-- Header Section -->
                                    <div class="flex items-center justify-between p-6 border-b border-white/10 dark:border-white/5">
                                        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white tracking-tight" style="font-family: 'Borel', sans-serif;">
                                            {{ $project->title }}
                                        </h1>
                                        
                                        <div class="flex items-center">
                                            @if ($project->link)
                                                <!-- Pill with Live Project + Close -->
                                                <div class="flex items-center bg-white/20 dark:bg-black/20 backdrop-blur-md rounded-full border border-white/30 dark:border-white/10 shadow-lg">
                                                    <a href="{{ $project->link }}" target="_blank"
                                                        class="flex items-center gap-2 px-4 py-3 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-300 font-medium text-sm">
                                                        <i class="fa-solid fa-external-link"></i>
                                                        <span>Live Project</span>
                                                    </a>
                                                    <div class="w-px h-6 bg-white/30 dark:bg-white/10"></div>
                                                    <button @click="showModal = false"
                                                        class="w-10 h-10 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all duration-300">
                                                        <i class="fa-solid fa-times"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <!-- Just Close Circle -->
                                                <button @click="showModal = false"
                                                    class="w-12 h-12 bg-white/20 dark:bg-black/20 backdrop-blur-md rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-white/30 dark:hover:bg-black/30 hover:text-slate-900 dark:hover:text-white transition-all duration-300 shadow-lg border border-white/30 dark:border-white/10">
                                                    <i class="fa-solid fa-times text-lg"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="overflow-y-auto max-h-[calc(90vh-80px)] p-6 pb-8">
                                        <!-- Stable Grid Layout -->
                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:items-start">
                                            
                                            <!-- Left: Image Carousel -->
                                            <div class="lg:col-span-2 flex">
                                                <!-- Image Section -->
                                                <div class="bg-white/60 dark:bg-white/5 backdrop-blur-md rounded-[2rem] p-6 border border-white/30 dark:border-white/10 shadow-lg min-h-96 w-full flex flex-col">
                                                    @if ($project->images && count($project->images) > 0)
                                                        <div class="relative flex items-center gap-4 h-full">
                                                            <button class="carousel-prev-{{ $project->id }} w-10 h-10 rounded-full bg-white/20 dark:bg-white/10 backdrop-blur-md border border-white/30 dark:border-white/20 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-white/40 dark:hover:bg-white/20 hover:text-blue-500 dark:hover:text-blue-400 transition-all duration-300">
                                                                <i class="fa-solid fa-chevron-left text-sm"></i>
                                                            </button>
                                                            
                                                            <div class="swiper project-swiper-{{ $project->id }} flex-1 h-full">
                                                                <div class="swiper-wrapper">
                                                                    @foreach ($project->images as $imagePath)
                                                                        <div class="swiper-slide">
                                                                            <div class="relative rounded-xl overflow-hidden h-full flex items-center justify-center">
                                                                                <img src="{{ Storage::url($imagePath) }}"
                                                                                    alt="{{ $project->title }}"
                                                                                    class="max-w-full max-h-full object-contain">
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <div class="swiper-pagination"></div>
                                                            </div>
                                                            
                                                            <button class="carousel-next-{{ $project->id }} w-10 h-10 rounded-full bg-white/20 dark:bg-white/10 backdrop-blur-md border border-white/30 dark:border-white/20 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-white/40 dark:hover:bg-white/20 hover:text-blue-500 dark:hover:text-blue-400 transition-all duration-300">
                                                                <i class="fa-solid fa-chevron-right text-sm"></i>
                                                            </button>
                                                        </div>
                                                    @elseif ($project->image_path)
                                                        <div class="relative rounded-xl overflow-hidden h-full flex items-center justify-center">
                                                            <img src="{{ Storage::url($project->image_path) }}"
                                                                alt="{{ $project->title }}"
                                                                class="max-w-full max-h-full object-contain">
                                                        </div>
                                                    @else
                                                        <div class="w-full h-full bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-xl flex items-center justify-center">
                                                            <div class="text-center space-y-4">
                                                                <i class="fa-solid fa-code text-4xl text-slate-400"></i>
                                                                <p class="text-lg font-semibold text-slate-600 dark:text-slate-300">{{ $project->title }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Right: Content Cards -->
                                            <div class="lg:col-span-1 space-y-4">
                                                <!-- Description Card -->
                                                <div class="bg-white/60 dark:bg-white/5 backdrop-blur-md rounded-[2rem] p-6 border border-white/30 dark:border-white/10 shadow-lg">
                                                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                                                        {{ $project->description }}
                                                    </p>
                                                    
                                                    @if ($project->duration)
                                                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-100/60 dark:bg-slate-800/60 rounded-full text-sm font-medium text-slate-600 dark:text-slate-400">
                                                            <i class="fa-solid fa-clock text-xs"></i>
                                                            {{ $project->duration }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Work Done Card -->
                                                @if (!empty($project->work_done) && is_array($project->work_done))
                                                    <div class="bg-gradient-to-br from-green-500/10 to-emerald-500/10 dark:from-green-600/20 dark:to-emerald-600/20 backdrop-blur-md rounded-[2rem] p-6 border border-green-200/30 dark:border-green-500/20">
                                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                                            <i class="fa-solid fa-check-circle text-green-500"></i>
                                                            Accomplishments
                                                        </h3>
                                                        <ul class="space-y-3">
                                                            @foreach ($project->work_done as $work)
                                                                <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                                                                    <span class="text-green-500 dark:text-green-400 mt-0.5 flex-shrink-0">
                                                                        @switch($project->bullet_type ?? 'circle')
                                                                            @case('square')
                                                                                ■
                                                                                @break
                                                                            @case('arrow')
                                                                                →
                                                                                @break
                                                                            @case('check')
                                                                                ✓
                                                                                @break
                                                                            @case('star')
                                                                                ★
                                                                                @break
                                                                            @default
                                                                                ●
                                                                        @endswitch
                                                                    </span>
                                                                    <span class="text-sm leading-relaxed">{{ $work }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                <!-- Tech Stack Card -->
                                                @if (!empty($project->tech_stack) && is_array($project->tech_stack))
                                                    <div class="bg-gradient-to-br from-blue-500/10 to-purple-500/10 dark:from-blue-600/20 dark:to-purple-600/20 backdrop-blur-md rounded-[2rem] p-6 border border-blue-200/30 dark:border-blue-500/20">
                                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                                            <i class="fa-solid fa-layer-group text-blue-500"></i>
                                                            Tech Stack
                                                        </h3>
                                                        <div class="flex flex-wrap gap-2">
                                                            @foreach ($project->tech_stack as $tech)
                                                                <span class="inline-flex items-center px-3 py-1.5 bg-white/60 dark:bg-white/10 text-slate-700 dark:text-slate-300 text-sm font-medium rounded-full border border-white/40 dark:border-white/20 backdrop-blur-sm">
                                                                    {{ $tech }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif


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

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper for each project
            @foreach ($projects as $project)
                @if ($project->images && count($project->images) > 0)
                    new Swiper('.project-swiper-{{ $project->id }}', {
                        loop: true,
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.carousel-next-{{ $project->id }}',
                            prevEl: '.carousel-prev-{{ $project->id }}',
                        },
                        autoplay: {
                            delay: 3000,
                            disableOnInteraction: false,
                        },
                    });
                @endif
            @endforeach
        });
    </script>

    <style>
        .swiper {
            width: 100%;
            height: 100%;
            position: relative;
        }
        
        .swiper-slide {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
            width: 100%;
            height: 100%;
        }
        
        .swiper-wrapper {
            height: 100%;
        }
        
        .swiper-pagination {
            position: absolute !important;
            bottom: 20px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            width: auto !important;
        }
        
        .swiper-pagination-bullet {
            background: rgba(148, 163, 184, 0.6) !important;
            opacity: 1 !important;
            transition: all 0.3s ease !important;
        }
        
        .swiper-pagination-bullet-active {
            background: #3b82f6 !important;
            transform: scale(1.2) !important;
        }
        
        .dark .swiper-pagination-bullet {
            background: rgba(148, 163, 184, 0.4) !important;
        }
        
        .dark .swiper-pagination-bullet-active {
            background: #60a5fa !important;
        }
        
        /* Match heights between left and right columns */
        @media (min-width: 1024px) {
            .grid.lg\:grid-cols-3 {
                align-items: stretch;
            }
            
            .lg\:col-span-2 {
                display: flex;
            }
        }
    </style>
</x-app-layout>