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
            @if($projects->count() > 0 || $githubRepos->count() > 0)
                <div class="space-y-6 animate-fade-in-up">
                    <div class="flex items-center gap-4 py-4">
                        <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
                        <h2 class="text-xl font-bold text-slate-400 uppercase tracking-widest">Projects</h2>
                        <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
                    </div>

                    <!-- Project Tabs -->
                    <div class="flex justify-center mb-8">
                        <div class="bg-white/60 dark:bg-white/5 backdrop-blur-md rounded-2xl p-2 border border-white/30 dark:border-white/10 shadow-lg">
                            <button onclick="window.switchTab('portfolio')" id="portfolio-tab" class="px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 bg-blue-500 text-white shadow-lg">
                                <i class="fa-solid fa-briefcase mr-2"></i>Portfolio Projects
                            </button>
                            <button onclick="window.switchTab('github')" id="github-tab" class="px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 text-slate-600 dark:text-slate-300 hover:bg-white/20 dark:hover:bg-white/10">
                                <i class="fa-brands fa-github mr-2"></i>GitHub Projects
                            </button>
                        </div>
                    </div>

                    <!-- Swiper Container -->
                    <div class="swiper project-tabs-swiper">
                        <div class="swiper-wrapper">
                            <!-- Portfolio Projects Slide -->
                            <div class="swiper-slide">
                                @if($projects->count() > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        @foreach($projects as $project)
                                            <article class="group relative h-full">
                                                <div onclick="showProjectModal({{ $project->id }})" class="cursor-pointer h-full flex flex-col p-6 bg-white dark:bg-[#161b22] rounded-2xl border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                                    <div class="flex items-start justify-between mb-4">
                                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">{{ $project->title }}</h3>
                                                        @if($project->duration)
                                                            <span class="ml-2 px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-medium rounded-full flex-shrink-0">{{ $project->duration }}</span>
                                                        @endif
                                                    </div>
                                                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed flex-1 mb-4" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">{{ $project->description }}</p>
                                                    @if($project->tech_stack && count($project->tech_stack) > 0)
                                                        <div class="flex flex-wrap gap-1 mt-auto">
                                                            @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                                                                <span class="inline-flex items-center px-2 py-0.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-medium rounded-full">{{ $tech }}</span>
                                                            @endforeach
                                                            @if(count($project->tech_stack) > 3)
                                                                <span class="text-xs text-slate-400">+{{ count($project->tech_stack) - 3 }}</span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>


                                            </article>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-12 text-slate-500 dark:text-slate-400">
                                        <i class="fa-solid fa-briefcase text-4xl mb-4"></i>
                                        <p>No portfolio projects available.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- GitHub Projects Slide -->
                            <div class="swiper-slide">
                                @if($githubRepos->count() > 0)
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
                                    <div class="text-center py-12 text-slate-500 dark:text-slate-400">
                                        <i class="fa-brands fa-github text-4xl mb-4"></i>
                                        <p>No GitHub projects available.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif



        </div>
    </div>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Add Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        const repoData = {
            @foreach($githubRepos as $repo)
                {{ $repo->id }}: {
                    name: '{{ addslashes($repo->name) }}',
                    description: '{{ addslashes($repo->description ?? 'No description available.') }}',
                    image: @if($repo->image) '{{ Storage::url($repo->image) }}' @else null @endif,
                    stars: {{ $repo->stargazers_count }},
                    language: @if($repo->language) '{{ $repo->language }}' @else null @endif,
                    updated: '{{ $repo->updated_at->diffForHumans() }}',
                    github_url: '{{ $repo->html_url }}',
                    live_url: @if($repo->live_url) '{{ $repo->live_url }}' @else null @endif
                },
            @endforeach
        };
        
        const projectData = {
            @foreach($projects as $project)
                {{ $project->id }}: {
                    title: '{{ addslashes($project->title) }}',
                    description: '{{ addslashes($project->description) }}',
                    duration: @if($project->duration) '{{ $project->duration }}' @else null @endif,
                    tech_stack: @json($project->tech_stack ?? []),
                    work_done: @json($project->work_done ?? []),
                    bullet_type: '{{ $project->bullet_type ?? 'circle' }}',
                    images: @json($project->images ?? []),
                    image_path: @if($project->image_path) '{{ Storage::url($project->image_path) }}' @else null @endif,
                    live_url: @if($project->link) '{{ $project->link }}' @else null @endif
                },
            @endforeach
        };
        
        let currentImageIndex = 0;
        let currentProject = null;
        
        function showProjectModal(projectId) {
            const project = projectData[projectId];
            currentProject = project;
            currentImageIndex = 0;
            const isDark = document.documentElement.classList.contains('dark');
            
            // Prepare images array
            let allImages = [];
            if (project.image_path) allImages.push(project.image_path);
            if (project.images && project.images.length > 0) {
                project.images.forEach(img => {
                    allImages.push(`/storage/projects/${img}`);
                });
            }
            
            let imagesHtml = '';
            if (allImages.length > 0) {
                if (allImages.length === 1) {
                    imagesHtml = `<div style="position: relative; height: 350px; display: flex; align-items: center; justify-content: center;"><div style="position: relative; border-radius: 20px; overflow: hidden; background: ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.7)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.3)'}; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); width: 100%; height: 100%;"><img src="${allImages[0]}" alt="${project.title}" style="width: 100%; height: 100%; object-fit: contain; display: block;"></div></div>`;
                } else {
                    imagesHtml = `
                        <div style="position: relative; height: 350px; display: flex; align-items: center; justify-content: center;">
                            <div id="carousel-container" style="position: relative; border-radius: 20px; overflow: hidden; background: ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.7)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.3)'}; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); width: 100%; height: 100%;">
                                <img id="carousel-image" src="${allImages[0]}" alt="${project.title}" style="width: 100%; height: 100%; object-fit: contain; display: block; transition: all 0.5s ease;">
                                
                                <button onclick="previousImage()" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.3)'}; backdrop-filter: blur(10px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(255, 255, 255, 0.3)'}; border-radius: 50%; color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; z-index: 10; font-size: 16px;" onmouseover="this.style.background='${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(0, 0, 0, 0.5)'}'; this.style.transform='translateY(-50%) scale(1.1)';" onmouseout="this.style.background='${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.3)'}'; this.style.transform='translateY(-50%) scale(1)';">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                                
                                <button onclick="nextImage()" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.3)'}; backdrop-filter: blur(10px); border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(255, 255, 255, 0.3)'}; border-radius: 50%; color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; z-index: 10; font-size: 16px;" onmouseover="this.style.background='${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(0, 0, 0, 0.5)'}'; this.style.transform='translateY(-50%) scale(1.1)';" onmouseout="this.style.background='${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.3)'}'; this.style.transform='translateY(-50%) scale(1)';">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                                
                                <div style="position: absolute; top: 15px; right: 15px; background: ${isDark ? 'rgba(0, 0, 0, 0.7)' : 'rgba(255, 255, 255, 0.9)'}; backdrop-filter: blur(10px); color: ${isDark ? 'white' : '#1e293b'}; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'}; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);">
                                    <span id="image-counter">1 / ${allImages.length}</span>
                                </div>
                                
                                <div id="dots-container" style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; background: ${isDark ? 'rgba(0, 0, 0, 0.5)' : 'rgba(255, 255, 255, 0.7)'}; backdrop-filter: blur(10px); padding: 8px 16px; border-radius: 20px; border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'}; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);">
                                    ${allImages.map((_, index) => 
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
            if (project.tech_stack && project.tech_stack.length > 0) {
                techStackHtml = `<div style="background: ${isDark ? 'rgba(59, 130, 246, 0.1)' : 'rgba(59, 130, 246, 0.05)'}; backdrop-filter: blur(20px); border: 1px solid ${isDark ? 'rgba(59, 130, 246, 0.2)' : 'rgba(59, 130, 246, 0.15)'}; border-radius: 20px; padding: 24px; box-shadow: 0 8px 32px rgba(59, 130, 246, 0.1); transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 40px rgba(59, 130, 246, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(59, 130, 246, 0.1)';">
                    <h3 style="color: ${isDark ? '#60a5fa' : '#2563eb'}; font-weight: 600; margin: 0 0 16px 0; font-size: 17px; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-layer-group"></i> Tech Stack</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">`;
                project.tech_stack.forEach(tech => {
                    techStackHtml += `<span style="background: linear-gradient(135deg, ${isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.8)'}, ${isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.6)'}); backdrop-filter: blur(10px); color: ${isDark ? '#e2e8f0' : '#475569'}; padding: 8px 14px; border-radius: 25px; font-size: 13px; font-weight: 500; border: 1px solid ${isDark ? 'rgba(255, 255, 255, 0.2)' : 'rgba(0, 0, 0, 0.1)'}; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); transition: all 0.2s ease;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.1)';">${tech}</span>`;
                });
                techStackHtml += `</div></div>`;
            }
            
            let workDoneHtml = '';
            if (project.work_done && project.work_done.length > 0) {
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
                showCancelButton: project.live_url ? true : false,
                confirmButtonText: project.live_url ? '<i class="fa-solid fa-external-link" style="margin-right: 8px;"></i>Live Project' : 'Close',
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
                if (result.isConfirmed && project.live_url) {
                    window.open(project.live_url, '_blank');
                }
            });
        }
        
        function nextImage() {
            if (!currentProject || !currentProject.images || currentProject.images.length <= 1) return;
            let allImages = [];
            if (currentProject.image_path) allImages.push(currentProject.image_path);
            if (currentProject.images && currentProject.images.length > 0) {
                currentProject.images.forEach(img => {
                    allImages.push(`/storage/projects/${img}`);
                });
            }
            currentImageIndex = (currentImageIndex + 1) % allImages.length;
            updateCarousel();
        }
        
        function previousImage() {
            if (!currentProject || !currentProject.images || currentProject.images.length <= 1) return;
            let allImages = [];
            if (currentProject.image_path) allImages.push(currentProject.image_path);
            if (currentProject.images && currentProject.images.length > 0) {
                currentProject.images.forEach(img => {
                    allImages.push(`/storage/projects/${img}`);
                });
            }
            currentImageIndex = currentImageIndex === 0 ? allImages.length - 1 : currentImageIndex - 1;
            updateCarousel();
        }
        
        function goToImage(index) {
            if (!currentProject) return;
            currentImageIndex = index;
            updateCarousel();
        }
        
        function updateCarousel() {
            let allImages = [];
            if (currentProject.image_path) allImages.push(currentProject.image_path);
            if (currentProject.images && currentProject.images.length > 0) {
                currentProject.images.forEach(img => {
                    allImages.push(`/storage/projects/${img}`);
                });
            }
            
            const image = document.getElementById('carousel-image');
            const counter = document.getElementById('image-counter');
            const dots = document.querySelectorAll('.carousel-dot');
            
            if (image) {
                image.style.opacity = '0';
                setTimeout(() => {
                    image.src = allImages[currentImageIndex];
                    image.style.opacity = '1';
                }, 150);
            }
            
            if (counter) {
                counter.textContent = `${currentImageIndex + 1} / ${allImages.length}`;
            }
            
            dots.forEach((dot, index) => {
                dot.style.background = index === currentImageIndex ? '#3b82f6' : 'rgba(255,255,255,0.5)';
            });
        }
        
        function showRepoModal(repoId) {
            const repo = repoData[repoId];
            const isDark = document.documentElement.classList.contains('dark');
            
            Swal.fire({
                title: `<span style="font-family: monospace; color: ${isDark ? '#f8fafc' : '#1e293b'};">${repo.name}</span>`,
                html: `
                    <div style="text-align: left; padding: 20px; background: ${isDark ? '#161b22' : '#ffffff'}; border-radius: 16px; border: 1px solid ${isDark ? '#30363d' : '#e2e8f0'};">
                        ${repo.image ? 
                            `<div style="margin-bottom: 20px;">
                                <img src="${repo.image}" alt="${repo.name}" style="width: 100%; height: 160px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                            </div>` :
                            `<div style="width: 100%; height: 120px; background: linear-gradient(135deg, ${isDark ? '#1e3a8a20' : '#3b82f620'}, ${isDark ? '#7c3aed20' : '#8b5cf620'}); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                <div style="text-align: center;">
                                    <i class="fa-brands fa-github" style="font-size: 2.5rem; color: ${isDark ? '#94a3b8' : '#64748b'}; margin-bottom: 8px;"></i>
                                    <p style="color: ${isDark ? '#cbd5e1' : '#475569'}; font-weight: 600; margin: 0;">${repo.name}</p>
                                </div>
                            </div>`
                        }
                        
                        <div style="background: ${isDark ? '#0d1117' : '#f8fafc'}; padding: 16px; border-radius: 12px; margin-bottom: 16px; border: 1px solid ${isDark ? '#21262d' : '#e2e8f0'};">
                            <p style="color: ${isDark ? '#c9d1d9' : '#475569'}; font-size: 14px; line-height: 1.6; margin: 0;">${repo.description}</p>
                        </div>
                        
                        <div style="display: flex; align-items: center; gap: 20px; padding: 12px 16px; background: ${isDark ? '#21262d' : '#f1f5f9'}; border-radius: 12px; margin-bottom: 16px;">
                            <div style="display: flex; align-items: center; gap: 6px; color: ${isDark ? '#fbbf24' : '#f59e0b'};">
                                <i class="fa-regular fa-star"></i>
                                <span style="font-weight: 600; font-size: 14px;">${repo.stars}</span>
                            </div>
                            ${repo.language ? 
                                `<div style="background: ${isDark ? '#3b82f6' : '#2563eb'}; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    ${repo.language}
                                </div>` : ''
                            }
                            <div style="color: ${isDark ? '#94a3b8' : '#64748b'}; font-size: 12px; margin-left: auto;">
                                Updated ${repo.updated}
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="fa-brands fa-github" style="margin-right: 8px;"></i>View on GitHub',
                cancelButtonText: repo.live_url ? '<i class="fa-solid fa-external-link" style="margin-right: 8px;"></i>Live Demo' : 'Close',
                confirmButtonColor: isDark ? '#374151' : '#1f2937',
                cancelButtonColor: repo.live_url ? '#2563eb' : (isDark ? '#4b5563' : '#6b7280'),
                background: isDark ? '#0d1117' : '#ffffff',
                color: isDark ? '#c9d1d9' : '#1e293b',
                width: '600px',
                padding: '2em',
                backdrop: `rgba(0,0,0,${isDark ? '0.8' : '0.6'})`,
                allowOutsideClick: true,
                customClass: {
                    popup: 'swal-custom-popup',
                    title: 'swal-custom-title',
                    content: 'swal-custom-content'
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
        document.addEventListener('DOMContentLoaded', function() {
            window.projectSwiper = new Swiper('.project-tabs-swiper', {
                allowTouchMove: false,
                speed: 500,
                effect: 'slide'
            });
        });
    </script>
    
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .swal-custom-popup {
            border-radius: 24px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        }
        
        .swal-custom-title {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            margin-bottom: 1rem !important;
        }
        
        .swal-custom-content {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .swal2-html-container {
            margin: 0 !important;
            padding: 0 !important;
        }
        
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
    </style>
</x-app-layout>
