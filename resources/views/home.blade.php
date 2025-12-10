@php
    $settings = \App\Models\Setting::pluck('value', 'key');
    // $socialLinks is shared via AppServiceProvider
    $typingTexts = \App\Models\TypingText::where('active', true)->orderBy('sort_order')->pluck('text');
    
    $profileImage = isset($settings['profile_image']) ? Storage::url($settings['profile_image']) : 'https://ui-avatars.com/api/?name=Yash+Shirsath&background=random&size=200';
    $resumeUrl = isset($settings['resume']) ? Storage::url($settings['resume']) : null;
    $description = $settings['description'] ?? 'Building digital experiences with code and creativity. Focused on clean, efficient, and scalable web solutions.';
    
    // Convert typing texts to JS array string
    $typingTextJs = $typingTexts->isEmpty() ? "['Web Developer', 'Problem Solver']" : $typingTexts->map(fn($t) => "'".addslashes($t)."'")->implode(', ');
    $typingTextJs = "[{$typingTextJs}]";
@endphp
<x-app-layout>
    <x-slot name="title">Home</x-slot>

    <!-- Main Container -->
    <div class="flex flex-col items-center justify-center min-h-[80vh] w-full max-w-4xl mx-auto px-4 md:px-0 animate-fade-in relative z-10">
        
        <!-- Profile Section -->
        <div class="flex flex-col items-center text-center space-y-8 w-full">
            
            <!-- Image with Unique Hover Animation -->
            <div class="relative group cursor-pointer perspective-1000">
                <!-- Rotating/Pulsing Glow -->
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 rounded-full blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                
                <!-- Main Image Container -->
                <div class="relative w-40 h-40 md:w-56 md:h-56 p-1 bg-white dark:bg-[#0d1117] rounded-full ring-1 ring-slate-900/5 dark:ring-white/10 shadow-2xl transition-all duration-500 ease-out group-hover:scale-[1.02] overflow-hidden">
                    <img src="{{ $profileImage }}" alt="Profile" class="w-full h-full rounded-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110 group-hover:rotate-3">
                    
                    <!-- Shine Effect overlay -->
                    <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-white/0 via-white/20 to-white/0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none transform -translate-x-full group-hover:translate-x-full"></div>
                </div>
            </div>

            <!-- Typography & Content -->
            <div class="space-y-6 max-w-3xl relative">
                <p class="text-xs md:text-sm font-bold text-blue-600 dark:text-blue-500 tracking-[0.3em] uppercase mb-2 animate-fade-in">Hello, I'm</p>
                
                <!-- Trendy Modern Name -->
                <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-slate-900 via-slate-700 to-slate-900 dark:from-white dark:via-slate-200 dark:to-slate-400 font-sans leading-[0.9] drop-shadow-sm animate-slide-up">
                    Yash Shirsath
                </h1>
                
                <h3 class="text-xl md:text-2xl font-light text-slate-500 dark:text-slate-400 h-10 flex items-center justify-center gap-3 animate-slide-up delay-75">
                    <span class="typing-text bg-clip-text text-transparent bg-gradient-to-r from-slate-700 to-slate-900 dark:from-slate-100 dark:to-slate-400 font-medium"></span>
                    <span class="typing-cursor w-0.5 h-8 bg-blue-500 block animate-pulse"></span>
                </h3>
                
                <!-- Bio Card -->
                <div class="relative p-8 bg-slate-50 dark:bg-white/5 backdrop-blur-sm rounded-[2.5rem] border border-slate-200 dark:border-white/5 shadow-sm text-left animate-slide-up delay-100 overflow-hidden group hover:shadow-lg transition-all duration-300">
                    <!-- Decorative Gradient -->
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-blue-500/20 to-purple-500/20 blur-2xl rounded-full"></div>
                    
                    <div class="flex flex-col md:flex-row gap-6 items-start relative z-10">
                        <!-- Visual Anchor Icon -->
                        <div class="flex-shrink-0 hidden md:block">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/25 transform rotate-3 group-hover:rotate-6 transition-transform duration-300">
                                <i class="fa-solid fa-user-astronaut text-2xl"></i>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1 space-y-2">
                            <h4 class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest flex items-center gap-2">
                                <i class="fa-solid fa-bolt md:hidden"></i> About Me
                            </h4>
                            <div class="text-sm md:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                                 @if(Str::length($description) > 185)
                                    {{ Str::limit($description, 185) }}
                                    <button id="view-description-btn" class="inline-flex items-center gap-1 text-slate-900 dark:text-white font-bold hover:text-blue-600 dark:hover:text-blue-400 transition-colors ml-1 focus:outline-none text-xs uppercase tracking-wide group/btn">
                                        Read More 
                                        <i class="fa-solid fa-arrow-right text-[10px] transform group-hover/btn:translate-x-1 transition-transform"></i>
                                    </button>
                                @else
                                    {{ $description }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons (Pill Shapes) -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-4 animate-slide-up delay-100 w-full">
                <!-- Resume Group -->
                @if($resumeUrl)
                    <div class="flex items-center p-1 bg-slate-100 dark:bg-slate-800/50 rounded-full border border-slate-200 dark:border-slate-700/50">
                        <a href="{{ $resumeUrl }}" download class="px-6 py-3 rounded-full bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-sm font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                            <span>Download CV</span>
                            <i class="fa-solid fa-download"></i>
                        </a>
                        <button id="view-cv-btn" class="px-6 py-3 rounded-full text-slate-600 dark:text-slate-300 text-sm font-bold hover:text-slate-900 dark:hover:text-white transition-colors flex items-center gap-2">
                            <span>View</span>
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                @endif
                
                <!-- Primary Action -->
                <button id="reach-me-trigger" class="px-8 py-4 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 transition-all duration-300 min-w-[160px]">
                    Reach Me
                </button>
            </div>
            
            <!-- Tech Stack Floating Dock -->
            <div class="pt-12 w-full max-w-3xl animate-slide-up delay-200">
                <div class="flex flex-col items-center">
                    <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-6">Tech Stack & Tools</p>
                    
                    <div class="flex flex-wrap justify-center gap-4 p-4 rounded-[2rem] bg-white dark:bg-white/5 border border-slate-200 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none backdrop-blur-md">
                        @if(isset($techStacks) && $techStacks->count() > 0)
                            @foreach($techStacks as $tech)
                                <div class="group relative transition-all duration-300 hover:-translate-y-2">
                                    <a href="{{ $tech->url ?? '#' }}" target="{{ $tech->url ? '_blank' : '_self' }}" class="flex items-center justify-center w-12 h-12 rounded-full bg-slate-50 dark:bg-white/10 text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-white dark:hover:bg-white/20 hover:shadow-lg transition-all" title="{{ $tech->name }}">
                                        <i class="{{ $tech->icon_class }} text-xl"></i>
                                    </a>
                                    <!-- Tooltip Pill -->
                                    <span class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-[10px] font-bold py-1 px-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap shadow-lg pointer-events-none translate-y-2 group-hover:translate-y-0">
                                        {{ $tech->name }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-slate-400 text-xs py-2 px-4">Add your tech stack in Admin Panel</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Reach Me Modal (Pill & Premium) -->
    <div id="reach-me-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" id="reach-me-backdrop"></div>
        <div class="relative bg-white dark:bg-[#161b22] rounded-[2.5rem] shadow-2xl p-8 max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300 border border-white/20" id="reach-me-content">
            <button id="close-reach-me" class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/10 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
            
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Get In Touch</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Let's build something amazing together.</p>
            </div>
            
            <div class="space-y-3">
                @if(isset($contactInfos))
                    @foreach($contactInfos as $info)
                        <div class="group flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-[#0d1117] border border-transparent hover:border-blue-500/30 hover:shadow-lg hover:shadow-blue-500/5 transition-all duration-300">
                            <div class="w-12 h-12 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform">
                                <i class="{{ $info->icon_class }} text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">{{ $info->label }}</p>
                                @if($info->link)
                                    <a href="{{ $info->link }}" target="_blank" class="block text-sm font-semibold text-slate-900 dark:text-slate-100 truncate hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                        {{ $info->value }}
                                    </a>
                                @else
                                    <p class="text-sm font-semibold text-slate-900 dark:text-slate-100 truncate">{{ $info->value }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- CV Modal (Pill & Large) -->
    <div id="cv-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md" id="cv-backdrop"></div>
        <div class="relative bg-white dark:bg-[#161b22] rounded-[2rem] shadow-2xl w-full max-w-5xl h-[85vh] mx-4 transform scale-95 transition-transform duration-300 border border-white/20 flex flex-col overflow-hidden" id="cv-content">
            <div class="flex justify-between items-center p-6 border-b border-slate-100 dark:border-white/5 bg-white/50 dark:bg-[#161b22]/50 backdrop-blur-sm z-20">
                <h3 class="font-bold text-lg text-slate-900 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-file-pdf text-red-500"></i> Resume Preview
                </h3>
                <button id="close-cv" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/10 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <div class="flex-1 bg-slate-50 dark:bg-[#0d1117] relative">
                @if($resumeUrl)
                    <iframe src="{{ $resumeUrl }}" class="w-full h-full border-none" title="Resume PDF"></iframe>
                @else
                    <div class="flex flex-col items-center justify-center h-full text-slate-400 gap-4">
                        <i class="fa-regular fa-file-pdf text-4xl opacity-50"></i>
                        <p>No Resume Uploaded</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Description Modal (Justified Text) -->
    <div id="description-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" id="description-backdrop"></div>
        <div class="relative bg-white dark:bg-[#161b22] rounded-[2.5rem] shadow-2xl p-8 max-w-2xl w-full mx-4 transform scale-95 transition-transform duration-300 border border-white/20 flex flex-col max-h-[80vh]" id="description-content">
            <button id="close-description" class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/10 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors z-10">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
            
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">About Me</h3>
                <div class="w-12 h-1 bg-blue-500 rounded-full mx-auto mt-2"></div>
            </div>
            
            <div class="overflow-y-auto pr-4 custom-scrollbar text-justify text-slate-600 dark:text-slate-300 leading-8 text-lg space-y-6 font-light">
                {!! nl2br(e($description)) !!}
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Typing Animation
            const textElement = document.querySelector('.typing-text');
            const phrases = {!! $typingTextJs !!};
            
            if (textElement && phrases.length > 0) {
                let phraseIndex = 0;
                let charIndex = 0;
                let isDeleting = false;
                let typeSpeed = 100;
                
                function type() {
                    const currentPhrase = phrases[phraseIndex];
                    if (isDeleting) {
                        textElement.textContent = currentPhrase.substring(0, charIndex - 1);
                        charIndex--;
                        typeSpeed = 50;
                    } else {
                        textElement.textContent = currentPhrase.substring(0, charIndex + 1);
                        charIndex++;
                        typeSpeed = 100;
                    }
                    if (!isDeleting && charIndex === currentPhrase.length) {
                        isDeleting = true;
                        typeSpeed = 2000; 
                    } else if (isDeleting && charIndex === 0) {
                        isDeleting = false;
                        phraseIndex = (phraseIndex + 1) % phrases.length;
                        typeSpeed = 500;
                    }
                    setTimeout(type, typeSpeed);
                }
                type();
            }

            // Modal Logic
            function setupModal(triggerId, modalId, closeId, backdropId, contentId) {
                const trigger = document.getElementById(triggerId);
                const modal = document.getElementById(modalId);
                const close = document.getElementById(closeId);
                const backdrop = document.getElementById(backdropId);
                const content = document.getElementById(contentId);

                if (!trigger || !modal) return;

                function openModal() {
                    modal.classList.remove('hidden');
                    // Small delay to allow display:block to apply before opacity transition
                    requestAnimationFrame(() => {
                        modal.classList.remove('opacity-0');
                        content.classList.remove('scale-95');
                        content.classList.add('scale-100');
                    });
                }

                function closeModal() {
                    modal.classList.add('opacity-0');
                    content.classList.remove('scale-100');
                    content.classList.add('scale-95');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 300);
                }

                trigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    openModal();
                });

                close.addEventListener('click', closeModal);
                backdrop.addEventListener('click', closeModal);
            }

            setupModal('reach-me-trigger', 'reach-me-modal', 'close-reach-me', 'reach-me-backdrop', 'reach-me-content');
            setupModal('view-cv-btn', 'cv-modal', 'close-cv', 'cv-backdrop', 'cv-content');
            setupModal('view-description-btn', 'description-modal', 'close-description', 'description-backdrop', 'description-content');
        });
    </script>
</x-app-layout>
