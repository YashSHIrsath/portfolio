@php
    $settings = \App\Models\Setting::pluck('value', 'key');
    // $socialLinks is shared via AppServiceProvider
    $typingTexts = \App\Models\TypingText::where('active', true)->orderBy('sort_order')->pluck('text');

    $firstName = $settings['first_name'] ?? 'John';
    $lastName = $settings['last_name'] ?? 'Doe';
    $fullName = trim($firstName . ' ' . $lastName);
    $profileImage = isset($settings['profile_image'])
        ? Storage::url($settings['profile_image'])
        : 'https://ui-avatars.com/api/?name=' . urlencode($fullName) . '&background=random&size=200';
    $resumeUrl = isset($settings['resume']) ? Storage::url($settings['resume']) : null;
    $description =
        $settings['description'] ??
        'Building digital experiences with code and creativity. Focused on clean, efficient, and scalable web solutions.';

    // Convert typing texts to JS array string
    $typingTextJs = $typingTexts->isEmpty()
        ? "['Web Developer', 'Problem Solver']"
        : $typingTexts->map(fn($t) => "'" . addslashes($t) . "'")->implode(', ');
    $typingTextJs = "[{$typingTextJs}]";
@endphp
<x-app-layout>
    <x-slot name="title">Home</x-slot>

    <!-- Main Container (Bento Grid) -->
    <div
        class="w-full max-w-6xl mx-auto px-4 md:px-0 py-12 animate-fade-in relative z-10 min-h-[85vh] flex flex-col justify-center gap-6">

        <!-- Top Row: Profile & Identity Collage -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 w-full">

            <!-- Mobile: Image + Name Combined -->
            <div class="md:hidden order-1">
                <div
                    class="relative bg-white/80 dark:bg-[#161b22]/80 backdrop-blur-md rounded-[2.5rem] border border-slate-200 dark:border-white/10 p-6 shadow-lg">
                    <div class="flex items-center gap-6">
                        <!-- Left: Circular Image -->
                        <div class="relative group w-20 h-20 flex-shrink-0">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-purple-600/20 blur-lg rounded-full">
                            </div>
                            <div
                                class="relative w-full h-full bg-white dark:bg-[#161b22] rounded-full border-3 border-white dark:border-slate-800 shadow-lg overflow-hidden group-hover:scale-105 transition-all duration-500">
                                <img src="{{ $profileImage }}" alt="Profile"
                                    class="w-full h-full object-cover filter grayscale contrast-125 group-hover:grayscale-0 transition-all duration-700">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60 group-hover:opacity-30 transition-opacity duration-500">
                                </div>
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            </div>
                        </div>

                        <!-- Right: Name + Typing -->
                        <div class="flex-1 space-y-2 mb-6">
                            <p
                                class="text-xs font-bold text-blue-600 dark:text-blue-500 tracking-[0.2em] uppercase mb-4">
                                Hello, I'm</p>

                            <h1 class="text-3xl font-black tracking-wider leading-[1.2] text-white dark:text-white mb-6"
                                style="font-family: 'Playwrite DE Grund', cursive;">
                                <span class="text-lg opacity-50"
                                    style="text-transform: capitalize">{{ $firstName }}</span>
                                <span class="ml-8" style="text-transform: capitalize">{{ $lastName }}</span>
                            </h1>

                            <div
                                class="inline-flex mt-4 items-center gap-2 px-3 py-1.5 bg-white/20 dark:bg-white/10 backdrop-blur-md border border-white/30 dark:border-white/20 rounded-full shadow-sm min-w-[8rem] max-w-xs min-h-[2rem]">
                                <span
                                    class="text-sm font-medium text-slate-600 dark:text-slate-300 typing-text min-h-[1rem]">&nbsp;</span>
                                <span class="typing-cursor w-0.5 h-3 bg-blue-500 hidden"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop: Profile Image (Visual Focus) -->
            <div class="hidden md:block md:col-span-4 relative group perspective-1000" style="max-height: 550px;">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-purple-600/20 blur-2xl rounded-[2.5rem] transform -rotate-1">
                </div>

                <div class="relative h-full w-full bg-white dark:bg-[#161b22] rounded-[2.5rem] border border-slate-200 dark:border-white/10 shadow-2xl overflow-hidden flex items-center justify-center p-2 group-hover:scale-[1.02] transition-all duration-500"
                    style="max-height: 550px;">
                    <img src="{{ $profileImage }}" alt="Profile"
                        class="w-full h-full object-cover rounded-[2rem] filter grayscale contrast-125 group-hover:grayscale-0 transition-all duration-700">

                    <!-- Overlay Effects -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60 group-hover:opacity-30 transition-opacity duration-500 rounded-[2rem]">
                    </div>

                    <!-- Status Badge -->
                    <div
                        class="absolute top-6 left-6 px-4 py-2 bg-white/90 dark:bg-black/80 backdrop-blur-md rounded-full text-xs font-bold uppercase tracking-widest text-slate-800 dark:text-white shadow-lg flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        Open to work
                    </div>
                </div>
            </div>

            <!-- Desktop: Identity & Actions (Functional Focus) -->
            <div class="hidden md:flex md:col-span-8 flex-col gap-4">
                <!-- Typography Card -->
                <div
                    class="relative bg-white/80 dark:bg-[#161b22]/80 backdrop-blur-md rounded-[2.5rem] border border-slate-200 dark:border-white/10 p-10 flex flex-col justify-center flex-grow shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="space-y-4">
                        <p
                            class="text-xs font-bold text-blue-600 dark:text-blue-500 tracking-[0.3em] uppercase animate-slide-up mb-4">
                            Hello, I'm</p>

                        <h1 class="text-6xl md:text-8xl lg:text-8xl font-black tracking-wider leading-[0.85] animate-slide-up delay-75 text-white dark:text-white"
                            style="font-family: 'Playwrite DE Grund', cursive;">
                            <span class="block text-2xl md:text-4xl opacity-50"
                                style="text-transform: capitalize">{{ $firstName }}</span>
                            <span class="block mt-8" style="text-transform: capitalize">{{ $lastName }}</span>
                        </h1>

                        <div class="flex items-center animate-slide-up delay-100 mt-6">
                            <div
                                class="inline-flex items-center gap-3 px-4 py-2 bg-white/20 dark:bg-white/10 backdrop-blur-md border border-white/30 dark:border-white/20 rounded-full shadow-lg min-w-[10rem] max-w-sm min-h-[2.9rem]">
                                <span
                                    class="text-lg font-medium text-slate-600 dark:text-slate-300 typing-text min-h-[1.3rem]"></span>
                                <span class="typing-cursor w-0.5 h-4 bg-blue-500 hidden"></span>
                            </div>
                        </div>


                    </div>

                    <!-- Action Buttons Row (Integrated) -->
                    <div class="mt-8 flex flex-wrap gap-4 animate-slide-up delay-150">
                        <button id="reach-me-trigger"
                            class="px-8 py-4 rounded-full bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-sm font-bold shadow-lg hover:scale-105 transition-all duration-300 flex items-center gap-2 group">
                            Reach Me
                            <i
                                class="fa-solid fa-arrow-right -rotate-45 group-hover:rotate-0 transition-transform duration-300"></i>
                        </button>

                        @if ($resumeUrl)
                            <a href="{{ $resumeUrl }}" download
                                class="px-8 py-4 rounded-full border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white text-sm font-bold hover:bg-slate-50 dark:hover:bg-white/5 transition-all duration-300 flex items-center gap-2">
                                Resume
                                <i class="fa-solid fa-download text-xs opacity-70"></i>
                            </a>
                        @endif

                        <button id="view-cv-btn"
                            class="w-12 h-12 rounded-full border border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 flex items-center justify-center hover:bg-slate-50 dark:hover:bg-white/5 hover:text-blue-500 transition-colors"
                            title="View CV">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Stats Row (New Module) -->
                @if (isset($stats) && $stats->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 animate-slide-up delay-200">
                        @foreach ($stats as $stat)
                            <div
                                class="bg-white dark:bg-[#161b22] p-4 rounded-[2rem] border border-slate-200 dark:border-white/10 flex flex-col items-center justify-center text-center shadow-sm hover:shadow-md transition-all">
                                <span
                                    class="text-2xl font-black text-slate-900 dark:text-white">{{ $stat->value }}</span>
                                <span
                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $stat->key }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Mobile: Action Buttons -->
            <div class="md:hidden order-3">
                <div class="flex gap-2 animate-slide-up delay-150">
                    <button id="reach-me-trigger-mobile"
                        class="flex-1 px-4 py-3 rounded-full bg-gradient-to-r from-slate-900 to-slate-800 dark:from-white dark:to-slate-100 text-white dark:text-slate-900 text-xs font-bold shadow-xl hover:scale-[1.02] transition-all duration-500 flex items-center justify-center gap-2">
                        <span>Reach</span>
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                    </button>

                    @if ($resumeUrl)
                        <a href="{{ $resumeUrl }}" download
                            class="flex-1 px-4 py-3 rounded-full border-2 border-slate-200 dark:border-white/20 text-slate-900 dark:text-white text-xs font-bold hover:bg-slate-50 dark:hover:bg-white/5 transition-all duration-500 flex items-center justify-center gap-2">
                            <span>Resume</span>
                            <i class="fa-solid fa-download text-xs"></i>
                        </a>
                    @endif

                    <button id="view-cv-btn-mobile"
                        class="flex-1 px-4 py-3 rounded-full border-2 border-slate-200 dark:border-white/20 text-slate-500 dark:text-slate-400 text-xs font-bold hover:text-blue-500 transition-all duration-500 flex items-center justify-center gap-2">
                        <span>View</span>
                        <i class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Section 2: Unified Hub & Experience Split -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 w-full animate-slide-up delay-200">

            <!-- Left: Description & Tech Stack (The "About" Module) -->
            <div class="md:col-span-8 flex flex-col gap-6">
                <div
                    class="relative w-full bg-slate-50 dark:bg-[#161b22]/80 backdrop-blur-xl rounded-[2.5rem] border border-slate-200 dark:border-white/10 shadow-xl overflow-hidden p-8 md:p-10 flex flex-col gap-6">
                    <a href="{{ route('about') }}" class="flex items-center gap-4 group cursor-pointer">
                        <div
                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/25 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-user-astronaut text-xl"></i>
                        </div>
                        <h4
                            class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            About Me</h4>
                    </a>

                    <div
                        class="text-sm md:text-base text-slate-600 dark:text-slate-300 leading-relaxed font-light text-justify">
                        @if (Str::length($description) > 300)
                            <span class="opacity-90">{{ Str::limit($description, 300) }}</span>
                            <button id="view-description-btn"
                                class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 font-bold hover:underline decoration-2 underline-offset-4 transition-all mt-2 focus:outline-none text-xs uppercase tracking-wide group/btn">
                                Read Full Bio
                            </button>
                        @else
                            {{ $description }}
                        @endif
                    </div>

                    <div class="h-px w-full bg-slate-200 dark:bg-white/5 my-2"></div>

                    <!-- Tech Stack Mini-Grid -->
                    <div>
                        <h4
                            class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-code text-indigo-500"></i> Tech Stack
                        </h4>
                        <div class="flex flex-wrap gap-3">
                            @if (isset($techStacks) && $techStacks->count() > 0)
                                @foreach ($techStacks as $tech)
                                    <a href="{{ $tech->url ?? '#' }}" target="{{ $tech->url ? '_blank' : '_self' }}"
                                        class="flex items-center justify-center w-10 h-10 rounded-xl bg-white dark:bg-[#0d1117] border border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 hover:text-white hover:bg-gradient-to-br hover:from-blue-500 hover:to-indigo-500 hover:border-transparent shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:scale-110"
                                        title="{{ $tech->name }}">
                                        <i class="{{ $tech->icon_class }} text-base"></i>
                                    </a>
                                @endforeach
                            @else
                                <span class="text-xs text-slate-400 italic">No stack loaded</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Experience Timeline (New Module) -->
            <div class="md:col-span-4 flex flex-col h-full">
                <div
                    class="relative w-full h-full bg-white dark:bg-[#161b22] rounded-[2.5rem] border border-slate-200 dark:border-white/10 shadow-xl p-8 md:p-10 overflow-hidden">
                    <a href="{{ route('experience') }}" class="flex items-center gap-4 mb-8 group cursor-pointer">
                        <div
                            class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-900 dark:text-white border border-slate-200 dark:border-white/10 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-briefcase text-xl"></i>
                        </div>
                        <h4
                            class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            Experience</h4>
                    </a>

                    <div class="space-y-8 relative">
                        <!-- Connecting Line -->
                        <div class="absolute left-[11px] top-3 bottom-3 w-0.5 bg-slate-200 dark:bg-white/5"></div>

                        @if (isset($experiences) && $experiences->count() > 0)
                            @foreach ($experiences->take(2) as $exp)
                                <a href="{{ route('experience.show', $exp->id) }}"
                                    class="relative pl-8 group block cursor-pointer transition-all">
                                    <!-- Dot -->
                                    <div
                                        class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-white dark:bg-[#161b22] border-4 border-blue-500 dark:border-blue-600 z-10 group-hover:scale-110 transition-transform">
                                    </div>

                                    <h5
                                        class="text-lg font-bold text-slate-900 dark:text-white leading-tight group-hover:text-slate-700 dark:group-hover:text-slate-200 transition-colors">
                                        {{ $exp->position }}</h5>
                                    @if ($exp->company)
                                        <p
                                            class="text-sm font-semibold text-blue-600 dark:text-blue-400 mb-1 group-hover:text-blue-500 dark:group-hover:text-blue-300 transition-colors">
                                            {{ $exp->company }}</p>
                                    @endif
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">
                                        {{ $exp->duration }}</p>
                                    <p class="text-sm text-slate-600 dark:text-slate-300 font-light leading-relaxed">
                                        {{ $exp->description }}
                                    </p>
                                </a>
                            @endforeach

                            @if ($experiences->count() > 2)
                                <div class="mt-8 pl-8">
                                    <a href="{{ route('experience') }}"
                                        class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 hover:border-transparent transition-all duration-300 group/more animate-fade-in-up">
                                        View Full Journey
                                        <i
                                            class="fa-solid fa-arrow-right group-hover/more:translate-x-1 transition-transform"></i>
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="pl-8 text-sm text-slate-400 italic">No experience added yet.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modals (Reach Me, CV, Description) - Keeping existing logic -->
    <div id="reach-me-modal"
        class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" id="reach-me-backdrop"></div>
        <div class="relative bg-white dark:bg-[#161b22] rounded-[2.5rem] shadow-2xl p-8 max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300 border border-white/20"
            id="reach-me-content">
            <button id="close-reach-me"
                class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/10 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Get In Touch</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Let's build something amazing together.</p>
            </div>
            <div class="space-y-3">
                @if (isset($contactInfos))
                    @foreach ($contactInfos as $info)
                        <div
                            class="group flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-[#0d1117] border border-transparent hover:border-blue-500/30 hover:shadow-lg hover:shadow-blue-500/5 transition-all duration-300">
                            <div
                                class="w-12 h-12 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform">
                                <i class="{{ $info->icon_class }} text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">
                                    {{ $info->label }}</p>
                                @if ($info->link)
                                    <a href="{{ $info->link }}" target="_blank"
                                        class="block text-sm font-semibold text-slate-900 dark:text-slate-100 truncate hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                        {{ $info->value }}
                                    </a>
                                @else
                                    <p class="text-sm font-semibold text-slate-900 dark:text-slate-100 truncate">
                                        {{ $info->value }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- CV Modal -->
    <div id="cv-modal"
        class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md" id="cv-backdrop"></div>
        <div class="relative bg-white dark:bg-[#161b22] rounded-[2rem] shadow-2xl w-full max-w-5xl h-[85vh] mx-4 transform scale-95 transition-transform duration-300 border border-white/20 flex flex-col overflow-hidden"
            id="cv-content">
            <div
                class="flex justify-between items-center p-6 border-b border-slate-100 dark:border-white/5 bg-white/50 dark:bg-[#161b22]/50 backdrop-blur-sm z-20">
                <h3 class="font-bold text-lg text-slate-900 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-file-pdf text-red-500"></i> Resume Preview
                </h3>
                <button id="close-cv"
                    class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/10 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <div class="flex-1 bg-slate-50 dark:bg-[#0d1117] relative">
                @if ($resumeUrl)
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

    <!-- Description Modal -->
    <div id="description-modal"
        class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" id="description-backdrop"></div>
        <div class="relative bg-white dark:bg-[#161b22] rounded-[2.5rem] shadow-2xl p-8 max-w-2xl w-full mx-4 transform scale-95 transition-transform duration-300 border border-white/20 flex flex-col max-h-[80vh]"
            id="description-content">
            <button id="close-description"
                class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/10 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors z-10">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">About Me</h3>
                <div class="w-12 h-1 bg-blue-500 rounded-full mx-auto mt-2"></div>
            </div>
            <div
                class="overflow-y-auto pr-4 custom-scrollbar text-justify text-slate-600 dark:text-slate-300 leading-8 text-lg space-y-6 font-light">
                {!! nl2br(e($description)) !!}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Typing Animation
            const textElements = document.querySelectorAll('.typing-text');
            const phrases = {!! $typingTextJs !!};
            if (textElements.length > 0 && phrases.length > 0) {
                let phraseIndex = 0;
                let charIndex = 0;
                let isDeleting = false;
                let typeSpeed = 100;

                function type() {
                    const currentPhrase = phrases[phraseIndex];
                    if (isDeleting) {
                        textElements.forEach(el => {
                            el.textContent = currentPhrase.substring(0, charIndex - 1);
                        });
                        charIndex--;
                        typeSpeed = 50;
                    } else {
                        textElements.forEach(el => {
                            el.textContent = currentPhrase.substring(0, charIndex + 1);
                        });
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
            setupModal('reach-me-trigger', 'reach-me-modal', 'close-reach-me', 'reach-me-backdrop',
                'reach-me-content');
            setupModal('reach-me-trigger-mobile', 'reach-me-modal', 'close-reach-me', 'reach-me-backdrop',
                'reach-me-content');
            setupModal('view-cv-btn', 'cv-modal', 'close-cv', 'cv-backdrop', 'cv-content');
            setupModal('view-cv-btn-mobile', 'cv-modal', 'close-cv', 'cv-backdrop', 'cv-content');
            setupModal('view-description-btn', 'description-modal', 'close-description', 'description-backdrop',
                'description-content');
        });
    </script>
</x-app-layout>
