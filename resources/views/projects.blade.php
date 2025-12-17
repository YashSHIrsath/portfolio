<x-app-layout>
    <x-slot name="title">Projects</x-slot>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <x-page-header title="/projects"
        description="A curated collection of my recent work, showcasing innovation and technical excellence." />

    <!-- Projects Grid -->
    <div class="relative pt-8 pb-12">
        <div class="max-w-6xl mx-auto px-4 md:px-0">
            @if ($projects->count() > 0 || $githubRepos->count() > 0)
                <!-- Project Tabs -->
                <div class="flex justify-center mb-12">
                    <div class="bg-white/60 dark:bg-white/5 backdrop-blur-md rounded-2xl p-2 border border-white/30 dark:border-white/10 shadow-lg">
                        <button onclick="switchTab('portfolio')" id="portfolio-tab" class="px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 bg-blue-500 text-white shadow-lg">
                            <i class="fa-solid fa-briefcase mr-2"></i>Portfolio Projects
                        </button>
                        <button onclick="switchTab('github')" id="github-tab" class="px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 text-slate-600 dark:text-slate-300 hover:bg-white/20 dark:hover:bg-white/10">
                            <i class="fa-brands fa-github mr-2"></i>GitHub Projects
                        </button>
                    </div>
                </div>

                <!-- Swiper Container -->
                <div class="swiper project-tabs-swiper">
                    <div class="swiper-wrapper">
                        <!-- Portfolio Projects Slide -->
                        <div class="swiper-slide portfolio-slide">
                            @if ($projects->count() > 0)
                                <div class="flex flex-wrap justify-between gap-y-8">
                    @foreach ($projects as $project)
                        <article class="group relative w-[45%]">
                            <!-- Project Card -->
                            <div onclick="showPortfolioModal({{ $project->id }})"
                                class="relative bg-white/80 dark:bg-[#161b22]/80 backdrop-blur-xl rounded-2xl border border-white/30 dark:border-slate-700/50 shadow-xl shadow-slate-900/10 dark:shadow-black/30 hover:shadow-2xl hover:shadow-slate-900/20 dark:hover:shadow-black/50 transition-all duration-500 cursor-pointer overflow-hidden group-hover:-translate-y-2 group-hover:scale-[1.02] h-[450px] flex flex-col">

                                <!-- Project Image/Preview -->
                                <div class="relative h-52 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 overflow-hidden">
                                    @if ($project->images && count($project->images) > 0)
                                        <img src="{{ Storage::url($project->images[0]) }}" alt="{{ $project->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                            onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-blue-500/10 to-purple-500/10 flex items-center justify-center\'><div class=\'text-center space-y-3\'><i class=\'fa-solid fa-code text-3xl text-slate-400\'></i><p class=\'text-sm font-medium text-slate-500\'>{{ $project->title }}</p></div></div>'">
                                        @if (count($project->images) > 1)
                                            <div class="absolute top-3 right-3 bg-black/70 text-white px-2 py-1 rounded-full text-xs font-medium">
                                                +{{ count($project->images) - 1 }}
                                            </div>
                                        @endif
                                    @elseif ($project->image_path)
                                        <img src="{{ Storage::url($project->image_path) }}" alt="{{ $project->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                            onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-blue-500/10 to-purple-500/10 flex items-center justify-center\'><div class=\'text-center space-y-3\'><i class=\'fa-solid fa-code text-3xl text-slate-400\'></i><p class=\'text-sm font-medium text-slate-500\'>{{ $project->title }}</p></div></div>'">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500/10 to-purple-500/10 flex items-center justify-center">
                                            <div class="text-center space-y-3">
                                                <i class="fa-solid fa-code text-3xl text-slate-400"></i>
                                                <p class="text-sm font-medium text-slate-500">{{ $project->title }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Hover Icon -->
                                    <div class="absolute top-4 right-4 w-10 h-10 bg-white/90 dark:bg-black/80 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                        <i class="fa-solid fa-external-link text-slate-700 dark:text-white text-sm"></i>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6 flex-1 flex flex-col">
                                    <div class="space-y-4 flex-1">
                                        <h2 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300 line-clamp-2">
                                            {{ $project->title }}
                                        </h2>
                                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm line-clamp-3">
                                            {{ $project->description }}
                                        </p>
                                    </div>

                                    <!-- Tech Stack -->
                                    @if (!empty($project->tech_stack) && is_array($project->tech_stack))
                                        <div class="flex flex-wrap gap-2 mt-4">
                                            @foreach (array_slice($project->tech_stack, 0, 4) as $tech)
                                                <span class="inline-flex items-center px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-medium rounded-full">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                            @if (count($project->tech_stack) > 4)
                                                <span class="inline-flex items-center px-3 py-1 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-xs font-medium rounded-full">
                                                    +{{ count($project->tech_stack) - 4 }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- CTA -->
                                    <div class="pt-4 mt-auto">
                                        <div class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 font-semibold text-sm group-hover:gap-3 transition-all duration-300">
                                            <span>View Details</span>
                                            <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform duration-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-24 space-y-8">
                                    <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto">
                                        <i class="fa-solid fa-briefcase text-3xl text-slate-400"></i>
                                    </div>
                                    <div class="space-y-4">
                                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">No Portfolio Projects</h3>
                                        <p class="text-slate-600 dark:text-slate-400 max-w-md mx-auto">Portfolio projects will appear here once they're added.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- GitHub Projects Slide -->
                        <div class="swiper-slide">
                            @if ($githubRepos->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($githubRepos as $index => $repo)
                                        <article class="group relative h-full">
                                            <div onclick="showRepoModal({{ $repo->id }})" class="cursor-pointer h-full flex flex-col p-6 bg-white dark:bg-[#161b22] rounded-2xl border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                                <div class="flex items-start justify-between mb-4">
                                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors font-mono line-clamp-2">{{ $repo->name }}</h3>
                                                    <div class="flex items-center gap-1 text-sm text-slate-500 ml-2 flex-shrink-0">
                                                        <i class="fa-regular fa-star"></i>
                                                        <span>{{ $repo->stargazers_count }}</span>
                                                    </div>
                                                </div>
                                                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed flex-1 mb-4" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">{{ $repo->description ?? 'No description available.' }}</p>
                                                <div class="flex items-center justify-between mt-auto">
                                                    @if ($repo->language)
                                                        <span class="inline-flex items-center px-2.5 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-medium rounded-full">{{ $repo->language }}</span>
                                                    @else
                                                        <span></span>
                                                    @endif
                                                    <span class="text-xs text-slate-400">{{ $repo->updated_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-24 space-y-8">
                                    <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto">
                                        <i class="fa-brands fa-github text-3xl text-slate-400"></i>
                                    </div>
                                    <div class="space-y-4">
                                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">No GitHub Projects</h3>
                                        <p class="text-slate-600 dark:text-slate-400 max-w-md mx-auto">GitHub repositories will appear here once they're synced.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-24 space-y-8">
                    <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto">
                        <i class="fa-solid fa-folder-open text-3xl text-slate-400"></i>
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">No Projects Yet</h3>
                        <p class="text-slate-600 dark:text-slate-400 max-w-md mx-auto">Projects will appear here once they're added to the portfolio.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>



    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const portfolioData = {
            @foreach($projects as $project)
                {{ $project->id }}: {
                    title: @json($project->title),
                    description: @json($project->description),
                    images: [
                        @if($project->images && count($project->images) > 0)
                            @foreach($project->images as $image)
                                '{{ Storage::url($image) }}',
                            @endforeach
                        @elseif($project->image_path)
                            '{{ Storage::url($project->image_path) }}',
                        @endif
                    ],
                    tech_stack: @json($project->tech_stack ?? []),
                    work_done: @json($project->work_done ?? []),
                    duration: @json($project->duration),
                    link: @json($project->link),
                    bullet_type: @json($project->bullet_type ?? 'circle')
                },
            @endforeach
        };
        
        let currentImageIndex = 0;
        let currentProject = null;
        
        function showPortfolioModal(projectId) {
            const project = portfolioData[projectId];
            currentProject = project;
            currentImageIndex = 0;
            const isDark = document.documentElement.classList.contains('dark');
            
            let imagesHtml = '';
            if (project.images.length > 0) {
                if (project.images.length === 1) {
                    imagesHtml = `<div style="position: relative; height: 350px; display: flex; align-items: center; justify-content: center;"><div style="position: relative; border-radius: 20px; overflow: hidden; background: ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.7)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.3)'}; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); width: 100%; height: 100%;"><img src="${project.images[0]}" alt="${project.title}" style="width: 100%; height: 100%; object-fit: contain; display: block;"></div></div>`;
                } else {
                    imagesHtml = `
                        <div style="position: relative; height: 350px; display: flex; align-items: center; justify-content: center;">
                            <div id="carousel-container" style="position: relative; border-radius: 20px; overflow: hidden; background: ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.7)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.3)'}; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); width: 100%; height: 100%;">
                                <img id="carousel-image" src="${project.images[0]}" alt="${project.title}" style="width: 100%; height: 100%; object-fit: contain; display: block; transition: all 0.5s ease;">
                                
                                <button onclick="previousImage()" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.3)'}; backdrop-filter: blur(10px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(255, 255, 255, 0.3)'}; border-radius: 50%; color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; z-index: 10; font-size: 16px;" onmouseover="this.style.background='${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(0, 0, 0, 0.5)'}'; this.style.transform='translateY(-50%) scale(1.1)';" onmouseout="this.style.background='${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.3)'}'; this.style.transform='translateY(-50%) scale(1)';">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                                
                                <button onclick="nextImage()" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.3)'}; backdrop-filter: blur(10px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(255, 255, 255, 0.3)'}; border-radius: 50%; color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; z-index: 10; font-size: 16px;" onmouseover="this.style.background='${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(0, 0, 0, 0.5)'}'; this.style.transform='translateY(-50%) scale(1.1)';" onmouseout="this.style.background='${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.3)'}'; this.style.transform='translateY(-50%) scale(1)';">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                                
                                <div style="position: absolute; top: 15px; right: 15px; background: ${isDark ? 'rgba(0, 0, 0, 0.7)' : 'rgba(255, 255, 255, 0.9)'}; backdrop-filter: blur(10px); color: ${isDark ? 'white' : '#1e293b'}; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'}; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);">
                                    <span id="image-counter">1 / ${project.images.length}</span>
                                </div>
                                
                                <div id="dots-container" style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; background: ${isDark ? 'rgba(0, 0, 0, 0.5)' : 'rgba(255, 255, 255, 0.7)'}; backdrop-filter: blur(10px); padding: 8px 16px; border-radius: 20px; border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'}; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);">
                                    ${project.images.map((_, index) => 
                                        `<button onclick="goToImage(${index})" class="carousel-dot" style="width: 10px; height: 10px; border-radius: 50%; border: none; cursor: pointer; transition: all 0.3s ease; background: ${index === 0 ? '#3b82f6' : (isDark ? 'rgba(255,255,255,0.4)' : 'rgba(0,0,0,0.3)')}; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);" data-index="${index}" onmouseover="this.style.transform='scale(1.2)';" onmouseout="this.style.transform='scale(1)';"></button>`
                                    ).join('')}
                                </div>
                            </div>
                        </div>
                    `;
                }
            } else {
                imagesHtml = `<div style="position: relative; height: 350px; display: flex; align-items: center; justify-content: center;"><div style="width: 100%; height: 100%; background: linear-gradient(135deg, ${isDark ? 'rgba(59, 130, 246, 0.2)' : 'rgba(59, 130, 246, 0.1)'}, ${isDark ? 'rgba(139, 92, 246, 0.2)' : 'rgba(139, 92, 246, 0.1)'}); backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.3)'}; border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);"><div style="text-align: center;"><i class="fa-solid fa-code" style="font-size: 3rem; color: ${isDark ? '#60a5fa' : '#3b82f6'}; margin-bottom: 12px; opacity: 0.8;"></i><p style="color: ${isDark ? '#e2e8f0' : '#475569'}; font-weight: 600; margin: 0; font-size: 16px;">${project.title}</p></div></div></div>`;
            }
            
            let techStackHtml = '';
            if (project.tech_stack.length > 0) {
                techStackHtml = `<div style="background: ${isDark ? 'rgba(59, 130, 246, 0.1)' : 'rgba(59, 130, 246, 0.05)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(59, 130, 246, 0.2)' : 'rgba(59, 130, 246, 0.15)'}; border-radius: 20px; padding: 24px; box-shadow: 0 8px 32px rgba(59, 130, 246, 0.1); transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 40px rgba(59, 130, 246, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(59, 130, 246, 0.1)';">
                    <h3 style="color: ${isDark ? '#60a5fa' : '#2563eb'}; font-weight: 600; margin: 0 0 16px 0; font-size: 17px; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-layer-group"></i> Tech Stack</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">`;
                project.tech_stack.forEach(tech => {
                    techStackHtml += `<span style="background: linear-gradient(135deg, ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.8)'}, ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.6)'}); backdrop-filter: blur(10px); color: ${isDark ? '#e2e8f0' : '#475569'}; padding: 8px 14px; border-radius: 25px; font-size: 13px; font-weight: 500; border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(0, 0, 0, 0.1)'}; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); transition: all 0.2s ease;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.1)';">${tech}</span>`;
                });
                techStackHtml += `</div></div>`;
            }
            
            let workDoneHtml = '';
            if (project.work_done.length > 0) {
                const bulletMap = { circle: '●', square: '■', arrow: '→', check: '✓', star: '★' };
                const bullet = bulletMap[project.bullet_type] || '●';
                workDoneHtml = `<div style="background: ${isDark ? 'rgba(34, 197, 94, 0.1)' : 'rgba(34, 197, 94, 0.05)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(34, 197, 94, 0.2)' : 'rgba(34, 197, 94, 0.15)'}; border-radius: 20px; padding: 24px; box-shadow: 0 8px 32px rgba(34, 197, 94, 0.1); transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 40px rgba(34, 197, 94, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(34, 197, 94, 0.1)';">
                    <h3 style="color: ${isDark ? '#4ade80' : '#059669'}; font-weight: 600; margin: 0 0 16px 0; font-size: 17px; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-check-circle"></i> Accomplishments</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">`;
                project.work_done.forEach(work => {
                    workDoneHtml += `<li style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px; color: ${isDark ? '#e2e8f0' : '#475569'}; font-size: 14px; line-height: 1.6; padding: 0;"><span style="color: ${isDark ? '#4ade80' : '#059669'}; font-weight: bold; font-size: 15px; flex-shrink: 0;">${bullet}</span><span style="flex: 1; text-align: left;">${work}</span></li>`;
                });
                workDoneHtml += `</ul></div>`;
            }
            
            Swal.fire({
                title: `<div style="background: linear-gradient(135deg, ${isDark ? 'rgba(59, 130, 246, 0.1)' : 'rgba(59, 130, 246, 0.05)'}, ${isDark ? 'rgba(139, 92, 246, 0.1)' : 'rgba(139, 92, 246, 0.05)'}); backdrop-filter: blur(10px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.2)'}; border-radius: 20px; padding: 16px 24px; margin-bottom: 24px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);"><h2 style="color: ${isDark ? '#f8fafc' : '#1e293b'}; font-weight: 700; font-size: 28px; margin: 0; text-align: center; background: linear-gradient(135deg, #3b82f6, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">${project.title}</h2></div>`,
                html: `
                    <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 32px; padding: 0; height: 100%; max-height: calc(70vh - 120px);">
                        <!-- Left Column: Images -->
                        <div style="display: flex; flex-direction: column; height: 100%;">
                            ${imagesHtml}
                        </div>
                        
                        <!-- Right Column: Details -->
                        <div style="display: flex; flex-direction: column; gap: 20px; height: 100%; overflow-y: auto; padding-right: 8px; scrollbar-width: none; -ms-overflow-style: none;" class="custom-scroll">
                            <!-- Description Card -->
                            <div style="background: ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.7)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.3)'}; border-radius: 20px; padding: 24px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 40px rgba(0, 0, 0, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)';">
                                <h3 style="color: ${isDark ? '#60a5fa' : '#2563eb'}; font-weight: 600; margin: 0 0 14px 0; font-size: 17px; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-info-circle"></i> Description</h3>
                                <p style="color: ${isDark ? '#e2e8f0' : '#475569'}; font-size: 15px; line-height: 1.6; margin: 0; text-align: left;">${project.description}</p>
                                ${project.duration ? `<div style="margin-top: 16px;"><span style="background: linear-gradient(135deg, ${isDark ? '#374151' : '#f1f5f9'}, ${isDark ? '#4b5563' : '#e2e8f0'}); color: ${isDark ? '#d1d5db' : '#6b7280'}; padding: 8px 16px; border-radius: 25px; font-size: 13px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'}; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);"><i class="fa-solid fa-clock"></i> ${project.duration}</span></div>` : ''}
                            </div>
                            
                            ${techStackHtml}
                            ${workDoneHtml}
                        </div>
                    </div>
                    
                    <!-- Mobile Layout -->
                    <style>
                        .custom-scroll::-webkit-scrollbar { display: none; }
                        @media (max-width: 1024px) {
                            .swal2-html-container > div {
                                display: flex !important;
                                flex-direction: column !important;
                                gap: 20px !important;
                                max-height: calc(80vh - 100px) !important;
                            }
                            .swal2-html-container .custom-scroll {
                                max-height: 50vh !important;
                            }
                        }
                    </style>
                `,
                showCancelButton: project.link ? true : false,
                confirmButtonText: project.link ? '<i class="fa-solid fa-external-link" style="margin-right: 8px;"></i>Live Project' : 'Close',
                cancelButtonText: 'Close',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: isDark ? '#6b7280' : '#9ca3af',
                background: `linear-gradient(135deg, ${isDark ? 'rgba(13, 17, 23, 0.95)' : 'rgba(248, 250, 252, 0.95)'}, ${isDark ? 'rgba(22, 27, 34, 0.95)' : 'rgba(241, 245, 249, 0.95)'})`,
                color: isDark ? '#e2e8f0' : '#1e293b',
                width: window.innerWidth > 1024 ? '80vw' : '95vw',
                heightAuto: false,
                padding: '2em',
                backdrop: `rgba(0, 0, 0, ${isDark ? '0.8' : '0.6'})`,
                allowOutsideClick: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInUp animate__faster'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutDown animate__faster'
                },
                customClass: {
                    popup: 'glassmorphism-popup',
                    confirmButton: 'glassmorphism-button',
                    cancelButton: 'glassmorphism-button-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed && project.link) {
                    window.open(project.link, '_blank');
                }
            });
        }
        
        function nextImage() {
            if (!currentProject || currentProject.images.length <= 1) return;
            currentImageIndex = (currentImageIndex + 1) % currentProject.images.length;
            updateCarousel();
        }
        
        function previousImage() {
            if (!currentProject || currentProject.images.length <= 1) return;
            currentImageIndex = currentImageIndex === 0 ? currentProject.images.length - 1 : currentImageIndex - 1;
            updateCarousel();
        }
        
        function goToImage(index) {
            if (!currentProject || currentProject.images.length <= 1) return;
            currentImageIndex = index;
            updateCarousel();
        }
        
        function updateCarousel() {
            const image = document.getElementById('carousel-image');
            const counter = document.getElementById('image-counter');
            const dots = document.querySelectorAll('.carousel-dot');
            
            if (image) {
                image.style.opacity = '0';
                setTimeout(() => {
                    image.src = currentProject.images[currentImageIndex];
                    image.style.opacity = '1';
                }, 150);
            }
            
            if (counter) {
                counter.textContent = `${currentImageIndex + 1} / ${currentProject.images.length}`;
            }
            
            dots.forEach((dot, index) => {
                dot.style.background = index === currentImageIndex ? '#3b82f6' : 'rgba(255,255,255,0.5)';
            });
        }
        
        const repoData = {
            @foreach($githubRepos as $repo)
                {{ $repo->id }}: {
                    name: @json($repo->name),
                    description: @json($repo->description ?? 'No description available.'),
                    image: @json($repo->image ? Storage::url($repo->image) : null),
                    stars: {{ $repo->stargazers_count }},
                    language: @json($repo->language),
                    updated: @json($repo->updated_at->diffForHumans()),
                    github_url: @json($repo->html_url),
                    live_url: @json($repo->live_url)
                },
            @endforeach
        };
        
        function showRepoModal(repoId) {
            const repo = repoData[repoId];
            const isDark = document.documentElement.classList.contains('dark');
            
            Swal.fire({
                title: `<div style="background: linear-gradient(135deg, ${isDark ? 'rgba(59, 130, 246, 0.1)' : 'rgba(59, 130, 246, 0.05)'}, ${isDark ? 'rgba(139, 92, 246, 0.1)' : 'rgba(139, 92, 246, 0.05)'}); backdrop-filter: blur(10px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.2)'}; border-radius: 20px; padding: 16px 24px; margin-bottom: 24px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);"><h2 style="color: ${isDark ? '#f8fafc' : '#1e293b'}; font-weight: 700; font-size: 28px; margin: 0; text-align: center; background: linear-gradient(135deg, #3b82f6, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-family: monospace;">${repo.name}</h2></div>`,
                html: `
                    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 32px; padding: 0; height: 100%; max-height: calc(70vh - 120px);">
                        <!-- Left Column: Image/Preview -->
                        <div style="display: flex; flex-direction: column; height: 100%;">
                            ${repo.image ? 
                                `<div style="position: relative; height: 350px; display: flex; align-items: center; justify-content: center;"><div style="position: relative; border-radius: 20px; overflow: hidden; background: ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.7)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.3)'}; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); width: 100%; height: 100%;"><img src="${repo.image}" alt="${repo.name}" style="width: 100%; height: 100%; object-fit: contain; display: block;"></div></div>` :
                                `<div style="position: relative; height: 350px; display: flex; align-items: center; justify-content: center;"><div style="width: 100%; height: 100%; background: linear-gradient(135deg, ${isDark ? 'rgba(59, 130, 246, 0.2)' : 'rgba(59, 130, 246, 0.1)'}, ${isDark ? 'rgba(139, 92, 246, 0.2)' : 'rgba(139, 92, 246, 0.1)'}); backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.3)'}; border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);"><div style="text-align: center;"><i class="fa-brands fa-github" style="font-size: 4rem; color: ${isDark ? '#60a5fa' : '#3b82f6'}; margin-bottom: 16px; opacity: 0.8;"></i><p style="color: ${isDark ? '#e2e8f0' : '#475569'}; font-weight: 600; margin: 0; font-size: 18px;">${repo.name}</p></div></div></div>`
                            }
                        </div>
                        
                        <!-- Right Column: Details -->
                        <div style="display: flex; flex-direction: column; gap: 20px; height: 100%; overflow-y: auto; padding-right: 8px; scrollbar-width: none; -ms-overflow-style: none;" class="custom-scroll">
                            <!-- Description Card -->
                            <div style="background: ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.7)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.3)'}; border-radius: 20px; padding: 24px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 40px rgba(0, 0, 0, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)';">
                                <h3 style="color: ${isDark ? '#60a5fa' : '#2563eb'}; font-weight: 600; margin: 0 0 14px 0; font-size: 17px; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-info-circle"></i> Description</h3>
                                <p style="color: ${isDark ? '#e2e8f0' : '#475569'}; font-size: 15px; line-height: 1.6; margin: 0; text-align: left;">${repo.description}</p>
                            </div>
                            
                            <!-- Stats Card -->
                            <div style="background: ${isDark ? 'rgba(255, 215, 0, 0.1)' : 'rgba(255, 215, 0, 0.05)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 215, 0, 0.2)' : 'rgba(255, 215, 0, 0.15)'}; border-radius: 20px; padding: 24px; box-shadow: 0 8px 32px rgba(255, 215, 0, 0.1); transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 40px rgba(255, 215, 0, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(255, 215, 0, 0.1)';">
                                <h3 style="color: ${isDark ? '#fbbf24' : '#f59e0b'}; font-weight: 600; margin: 0 0 16px 0; font-size: 17px; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-chart-line"></i> Repository Stats</h3>
                                <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                                    <div style="display: flex; align-items: center; gap: 6px; background: ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.8)'}; backdrop-filter: blur(10px); padding: 8px 14px; border-radius: 25px; border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(0, 0, 0, 0.1)'}; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
                                        <i class="fa-regular fa-star" style="color: ${isDark ? '#fbbf24' : '#f59e0b'};"></i>
                                        <span style="color: ${isDark ? '#e2e8f0' : '#475569'}; font-weight: 600; font-size: 14px;">${repo.stars}</span>
                                    </div>
                                    ${repo.language ? 
                                        `<div style="background: linear-gradient(135deg, ${isDark ? 'rgba(59, 130, 246, 0.8)' : '#2563eb'}, ${isDark ? 'rgba(29, 78, 216, 0.8)' : '#1d4ed8'}); color: white; padding: 8px 14px; border-radius: 25px; font-size: 13px; font-weight: 600; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);">${repo.language}</div>` : ''
                                    }
                                    <div style="color: ${isDark ? '#94a3b8' : '#64748b'}; font-size: 13px; padding: 8px 14px; background: ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)'}; border-radius: 25px; border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'};">Updated ${repo.updated}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Layout -->
                    <style>
                        .custom-scroll::-webkit-scrollbar { display: none; }
                        @media (max-width: 1024px) {
                            .swal2-html-container > div {
                                display: flex !important;
                                flex-direction: column !important;
                                gap: 20px !important;
                                max-height: calc(80vh - 100px) !important;
                            }
                            .swal2-html-container .custom-scroll {
                                max-height: 50vh !important;
                            }
                        }
                    </style>
                `,
                showCancelButton: repo.live_url ? true : false,
                confirmButtonText: '<i class="fa-brands fa-github" style="margin-right: 8px;"></i>View on GitHub',
                cancelButtonText: repo.live_url ? '<i class="fa-solid fa-external-link" style="margin-right: 8px;"></i>Live Demo' : 'Close',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: repo.live_url ? '#2563eb' : (isDark ? '#6b7280' : '#9ca3af'),
                background: `linear-gradient(135deg, ${isDark ? 'rgba(13, 17, 23, 0.95)' : 'rgba(248, 250, 252, 0.95)'}, ${isDark ? 'rgba(22, 27, 34, 0.95)' : 'rgba(241, 245, 249, 0.95)'})`,
                color: isDark ? '#e2e8f0' : '#1e293b',
                width: window.innerWidth > 1024 ? '80vw' : '95vw',
                heightAuto: false,
                padding: '2em',
                backdrop: `rgba(0, 0, 0, ${isDark ? '0.8' : '0.6'})`,
                allowOutsideClick: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInUp animate__faster'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutDown animate__faster'
                },
                customClass: {
                    popup: 'glassmorphism-popup',
                    confirmButton: 'glassmorphism-button',
                    cancelButton: 'glassmorphism-button-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(repo.github_url, '_blank');
                } else if (result.dismiss === Swal.DismissReason.cancel && repo.live_url) {
                    window.open(repo.live_url, '_blank');
                }
            });
        }
        
        // Initialize Swiper for project tabs
        let projectSwiper;
        document.addEventListener('DOMContentLoaded', function() {
            projectSwiper = new Swiper('.project-tabs-swiper', {
                allowTouchMove: false,
                speed: 500,
                effect: 'slide'
            });
            
            // No individual project swipers needed for SweetAlert2 modals
        });
        
        // Tab switching function
        window.switchTab = function(tab) {
            const portfolioTab = document.getElementById('portfolio-tab');
            const githubTab = document.getElementById('github-tab');
            
            if (tab === 'portfolio') {
                portfolioTab.className = 'px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 bg-blue-500 text-white shadow-lg';
                githubTab.className = 'px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 text-slate-600 dark:text-slate-300 hover:bg-white/20 dark:hover:bg-white/10';
                projectSwiper.slideTo(0);
            } else {
                githubTab.className = 'px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 bg-blue-500 text-white shadow-lg';
                portfolioTab.className = 'px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 text-slate-600 dark:text-slate-300 hover:bg-white/20 dark:hover:bg-white/10';
                projectSwiper.slideTo(1);
            }
        }
    </script>
    
    <!-- Add Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        .glassmorphism-popup {
            backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 32px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        }
        
        .glassmorphism-button {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
            border: none !important;
            border-radius: 25px !important;
            padding: 12px 24px !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4) !important;
            transition: all 0.3s ease !important;
        }
        
        .glassmorphism-button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6) !important;
        }
        
        .glassmorphism-button-secondary {
            background: rgba(107, 114, 128, 0.8) !important;
            backdrop-filter: blur(10px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 25px !important;
            padding: 12px 24px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }
        
        .glassmorphism-button-secondary:hover {
            background: rgba(107, 114, 128, 1) !important;
            transform: translateY(-2px) !important;
        }
        
        .swiper {
            width: 100%;
            height: 100%;
            position: relative;
        }
        
        .swiper-slide {
            background: transparent;
            width: 100%;
            height: 100%;
        }
        
        .swiper-slide:not(.portfolio-slide) {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
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