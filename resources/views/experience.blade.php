<x-app-layout>
    <x-slot name="title">Experience</x-slot>

    <x-page-header 
        title="/professional_journey" 
        description="A timeline of my career, projects, and growth." 
    />

    <div class="w-full max-w-6xl mx-auto px-4 md:px-0 pb-12 animate-fade-in">

        <!-- Timeline Container -->
        <div class="relative w-full min-h-[500px]" id="timeline-container">
            
            <!-- Continuous Connector Path (SVG) -->
            <!-- Placed absolutely behind the content -->
            <svg class="absolute inset-0 w-full h-full pointer-events-none z-0" aria-hidden="true">
                <path id="timeline-path" d="" fill="none" class="stroke-slate-200 dark:stroke-slate-800" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

            <!-- Experience Items List -->
            <!-- Relative z-10 to sit above the SVG -->
                @forelse($experiences as $index => $exp)
                    
                    <!-- Unified Grid Row -->
                    <!-- Mobile: 2 cols [3rem(Line) | 1fr(Content)] -->
                    <!-- Desktop: 3 cols [1fr(Left) | 4rem(Line) | 1fr(Right)] -->
                    <div class="group relative w-full grid grid-cols-[3rem_1fr] md:grid-cols-[1fr_4rem_1fr] gap-x-0 items-center experience-row" data-index="{{ $index }}">
                        
                        <!-- LEFT CONTENT (Desktop Only: Even Index) -->
                        <div class="hidden md:block {{ $index % 2 == 0 ? 'col-start-1 pr-8 text-right' : '' }}">
                            @if($index % 2 == 0)
                                <div class="relative bg-white/90 dark:bg-[#161b22]/90 backdrop-blur-md p-6 rounded-[2rem] border border-white/20 dark:border-white/5 shadow-xl hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02] group/card ring-1 ring-slate-900/5 dark:ring-white/10">
                                    <div class="flex flex-wrap justify-end gap-2 mb-3">
                                        <span class="inline-block px-3 py-1 rounded-full bg-blue-100/50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold uppercase tracking-wide border border-blue-200/50 dark:border-blue-800/50">
                                            {{ $exp->duration }}
                                        </span>
                                        @if($exp->company)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100/50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-300 text-xs font-bold border border-slate-200/50 dark:border-slate-700/50">
                                                <i class="fa-solid fa-building text-blue-500/70 mr-1.5"></i> {{ $exp->company }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <h3 class="text-xl md:text-2xl font-black text-slate-900 dark:text-white mb-4 group-hover/card:text-blue-600 transition-colors font-mono tracking-tight leading-tight break-words">
                                        {{ $exp->position }}
                                    </h3>

                                    <div class="bg-slate-50/80 dark:bg-slate-800/40 rounded-2xl p-4 mb-4 backdrop-blur-sm border border-slate-100/50 dark:border-slate-700/30">
                                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm font-medium line-clamp-3">
                                            {{ Str::limit($exp->description, 150) }}
                                        </p>
                                    </div>
                                    
                                    <a href="{{ route('experience.show', $exp) }}" class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-sm font-bold hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors group/link w-full md:w-auto">
                                        See Detail <i class="fa-solid fa-arrow-right ml-2 transition-transform group-hover/link:translate-x-1"></i>
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- CENTER LINE / DOT COLUMN -->
                        <div class="col-start-1 md:col-start-2 h-full relative flex justify-center items-center pointer-events-none">
                            <!-- Mobile Straight Line Guide (Visual only) -->
                            <div class="md:hidden absolute top-0 bottom-0 left-[1.5rem] w-0.5 bg-slate-200 dark:bg-slate-800 -z-10 transform -translate-x-1/2"></div>
                            
                            <!-- The DOT -->
                            <div class="timeline-dot w-5 h-5 md:w-6 md:h-6 rounded-full border-4 border-white dark:border-[#0d1117] bg-blue-500 dark:bg-blue-600 shadow-[0_0_15px_rgba(59,130,246,0.5)] z-20 group-hover:scale-125 transition-transform duration-300">
                            </div>
                        </div>

                        <!-- RIGHT CONTENT -->
                        <!-- Mobile: Col 2 (Always). Desktop: Col 3 (Odd Index) -->
                        <div class="col-start-2 md:col-start-3 pl-4 md:pl-0 {{ $index % 2 != 0 ? 'md:pl-8' : '' }}">
                             <!-- Show on Mobile (Always) OR Desktop (Odd) -->
                             <div class="{{ $index % 2 == 0 ? 'md:hidden' : 'block' }}">
                                <div class="relative bg-white/90 dark:bg-[#161b22]/90 backdrop-blur-md p-6 rounded-[2rem] border border-white/20 dark:border-white/5 shadow-xl hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02] group/card ring-1 ring-slate-900/5 dark:ring-white/10">
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        <span class="inline-block px-3 py-1 rounded-full bg-blue-100/50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold uppercase tracking-wide border border-blue-200/50 dark:border-blue-800/50">
                                            {{ $exp->duration }}
                                        </span>
                                        @if($exp->company)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100/50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-300 text-xs font-bold border border-slate-200/50 dark:border-slate-700/50">
                                                <i class="fa-solid fa-building text-blue-500/70 mr-1.5"></i> {{ $exp->company }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <h3 class="text-xl md:text-2xl font-black text-slate-900 dark:text-white mb-4 group-hover/card:text-blue-600 transition-colors font-mono tracking-tight leading-tight break-words">
                                        {{ $exp->position }}
                                    </h3>

                                    <div class="bg-slate-50/80 dark:bg-slate-800/40 rounded-2xl p-4 mb-4 backdrop-blur-sm border border-slate-100/50 dark:border-slate-700/30">
                                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm font-medium line-clamp-3">
                                            {{ Str::limit($exp->description, 150) }}
                                        </p>
                                    </div>
                                    
                                    <a href="{{ route('experience.show', $exp) }}" class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-sm font-bold hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors group/link w-full md:w-auto">
                                        See Detail <i class="fa-solid fa-arrow-right ml-2 transition-transform group-hover/link:translate-x-1"></i>
                                    </a>
                                </div>
                             </div>
                        </div>

                    </div>
                @empty
                    <div class="text-center text-slate-400 py-12">
                        No experience entries found.
                    </div>
                @endforelse
            </div>
        </div>
        
    </div>

    <!-- Timeline JS: Calculates the smooth SVG path connecting the dots -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('timeline-container');
            const svgPath = document.getElementById('timeline-path');
            
            function updatePath() {
                const dots = document.querySelectorAll('.timeline-dot');
                if (dots.length < 2) return;

                const containerRect = container.getBoundingClientRect();
                let pathD = "";

                // Get all dot positions relative to container
                const points = Array.from(dots).map(dot => {
                    const rect = dot.getBoundingClientRect();
                    return {
                        x: rect.left - containerRect.left + (rect.width / 2),
                        y: rect.top - containerRect.top + (rect.height / 2)
                    };
                });

                points.forEach((point, index) => {
                    if (index === 0) {
                        pathD += `M ${point.x} ${point.y}`;
                    } else {
                        const prev = points[index - 1];
                        
                        // Vertical distance
                        const distY = point.y - prev.y;
                        
                        // Check if we are in "mobile/straight" mode or "desktop/curvy" mode
                        // If X is roughly same, it's a straight drop.
                        // If X differs, we need an S-curve.
                        const isVertical = Math.abs(point.x - prev.x) < 2;

                        if (isVertical) {
                            // Straight line logic (Mobile)
                            pathD += ` L ${point.x} ${point.y}`;
                        } else {
                            // Curvy logic (Desktop)
                            // We use a fixed tension for the curve relative to vertical distance
                            const tension = 0.5;
                            const cp1x = prev.x;
                            const cp1y = prev.y + (distY * tension);
                            const cp2x = point.x;
                            const cp2y = point.y - (distY * tension);
                            
                            pathD += ` C ${cp1x} ${cp1y}, ${cp2x} ${cp2y}, ${point.x} ${point.y}`;
                        }
                    }
                });

                svgPath.setAttribute('d', pathD);
            }

            // Initial calculation
            setTimeout(updatePath, 100);
            setTimeout(updatePath, 500); 

            // Efficient Resize Handling
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                updatePath(); // Instant update
                resizeTimer = setTimeout(updatePath, 100); // Debounce final correction
            });
        });
    </script>
</x-app-layout>
