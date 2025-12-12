<x-app-layout>
    <!-- 
    NOTE: 
    To use this Center Timeline layout instead of the SVG version:
    1. Replace the existing timeline-dot logic in your main blade file with the `.timeline-column` structure below.
    2. Copy the CSS styles into your stylesheet or main blade file.
    -->

    <style>
        :root {
            /* Theme Variables */
            --accent: #3b82f6; /* Blue-500 */
            --accent-glow: rgba(59, 130, 246, 0.4);
            --muted: #64748b; /* Slate-500 */
            --card-bg-light: rgba(255, 255, 255, 0.9);
            --card-bg-dark: rgba(22, 27, 34, 0.9);
            --border-light: rgba(255, 255, 255, 0.2);
            --border-dark: rgba(255, 255, 255, 0.05);

            /* Spacing & Sizes */
            --gap: clamp(1rem, 4vw, 3rem);
            --card-radius: 16px;
            --timeline-width: 4px;
            --dot-size: 1.25rem;
        }

        /* Timeline Layout Grid */
        .timeline-wrapper {
            display: grid;
            grid-template-columns: 1fr var(--gap) 1fr; /* 3-column grid */
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 1rem;
            position: relative;
        }

        /* Responsive Mobile Layout (<900px) */
        @media (max-width: 900px) {
            .timeline-wrapper {
                grid-template-columns: 1fr; /* Single column */
                padding-left: 2rem; /* Make room for gutter timeline */
            }
            /* Vertical Line moves to left */
            .timeline-column {
                left: 0.5rem !important;
                right: auto !important;
            }
            .timeline-card {
                margin-left: 1.5rem;
            }
            /* All cards align left */
            .timeline-row .timeline-card {
                grid-column: 1 / -1 !important;
                text-align: left !important;
            }
            /* Hide empty spacers */
            .timeline-spacer {
                display: none;
            }
        }

        /* Central Vertical Line */
        .timeline-column {
            grid-column: 2;
            position: relative;
            display: flex;
            justify-content: center;
        }
        
        .timeline-line {
            position: absolute;
            top: 0;
            bottom: 0;
            width: var(--timeline-width);
            background: var(--border-light); /* Default light theme */
            border-radius: 99px;
            z-index: 0;
        }
        :is(.dark .timeline-line) {
            background: var(--border-dark);
        }

        /* Timeline Cards */
        .timeline-row {
            display: contents; /* Allows children to sit on the main grid */
        }

        .timeline-card {
            background: var(--card-bg-light);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-light);
            border-radius: var(--card-radius);
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            position: relative;
            margin-bottom: var(--gap);
        }

        :is(.dark .timeline-card) {
            background: var(--card-bg-dark);
            border-color: var(--border-dark);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
        }

        /* Hover & Focus State */
        .timeline-card:hover,
        .timeline-card:focus-within {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04), 0 0 0 1px var(--accent-glow);
            border-color: var(--accent);
            z-index: 10;
        }

        /* Grid Alignment Logic */
        .timeline-row:nth-child(odd) .timeline-card {
            grid-column: 1;
            text-align: right; /* Right align content for left cards */
        }
        .timeline-row:nth-child(even) .timeline-card {
            grid-column: 3;
            text-align: left;
        }
        
        /* Flex Alignment for Chips inside Cards */
        .timeline-row:nth-child(odd) .card-header-meta {
            justify-content: flex-end;
        }
        .timeline-row:nth-child(even) .card-header-meta {
            justify-content: flex-start;
        }

        /* Typography */
        h3 {
            font-size: clamp(1.25rem, 2vw, 1.75rem);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            color: #1e293b; /* Slate-800 */
        }
        :is(.dark h3) { color: #f8fafc; }

        p {
            font-size: clamp(0.9rem, 1.5vw, 1rem);
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        :is(.dark p) { color: #94a3b8; }

        /* Chips & Badges */
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 99px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: #eff6ff;
            color: var(--accent);
        }
        :is(.dark .chip) { background: rgba(59, 130, 246, 0.15); }

        /* Details / Expandable */
        details {
            margin-top: 1rem;
            border-top: 1px solid rgba(0,0,0,0.05);
            padding-top: 1rem;
        }
        :is(.dark details) { border-top-color: rgba(255,255,255,0.05); }

        summary {
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--accent);
            list-style: none; /* Hide default triangle */
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.2s;
        }
        summary:hover {
            text-decoration: underline;
        }
        summary::-webkit-details-marker { display: none; } /* Chrome hide marker */

        /* Animated Content */
        .details-content {
            margin-top: 1rem;
            opacity: 0;
            transform: translateY(-5px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        details[open] .details-content {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Tech Stack Chips */
        .tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.75rem;
        }
        .tech-pill {
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 4px;
            background: #f1f5f9;
            color: #475569;
        }
        :is(.dark .tech-pill) { background: #1e293b; color: #cbd5e1; }

        /* Dot on the line */
        .dot {
            width: var(--dot-size);
            height: var(--dot-size);
            background: var(--accent);
            border: 3px solid #fff;
            border-radius: 50%;
            position: sticky; /* Keeps dot visible in viewport if desired, or absolute */
            top: 20vh; /* Arbitrary sticky position, or just static in flow */
            z-index: 5;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }
        :is(.dark .dot) { border-color: #0f172a; }

    </style>

    <div class="min-h-screen bg-slate-50 dark:bg-[#0d1117] py-12">
        <section class="timeline-wrapper" aria-label="Professional Experience Timeline">
            
            <!-- Central Line Guide -->
            <div class="timeline-column" aria-hidden="true">
                <div class="timeline-line"></div>
            </div>

            <!-- Card 1 (Left) -->
            <div class="timeline-row">
                <article class="timeline-card" tabindex="0">
                    <header>
                        <div class="card-header-meta flex flex-wrap gap-2 mb-3">
                            <span class="chip">2023 - Present</span>
                            <span class="chip">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                                TechNova Inc.
                            </span>
                        </div>
                        <h3>Senior Full Stack Engineer</h3>
                        <p class="role-subtitle font-bold text-slate-500 dark:text-slate-400">Team Lead & Architect</p>
                    </header>
                    
                    <p>Designed and implemented a scalable microservices architecture that reduced system latency by 40%.</p>

                    <details>
                        <summary>Show Key Achievements</summary>
                        <div class="details-content">
                            <ul class="list-disc list-inside text-sm text-slate-600 dark:text-slate-400 space-y-1 mb-3">
                                <li>Led a team of 5 developers.</li>
                                <li>Migrated legacy monolith to AWS Lambda.</li>
                                <li>Improved CI/CD deployment time by 60%.</li>
                            </ul>
                            <div class="tech-stack">
                                <span class="tech-pill">Laravel</span>
                                <span class="tech-pill">Vue.js</span>
                                <span class="tech-pill">AWS</span>
                                <span class="tech-pill">Docker</span>
                            </div>
                        </div>
                    </details>
                    
                    <footer class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                         <a href="#" class="text-sm font-bold text-blue-500 hover:text-blue-400 transition-colors">See Detail &rarr;</a>
                    </footer>
                </article>
                
                <!-- Spacer for Grid Logic (keeps 3rd column empty) -->
                <div class="timeline-spacer"></div> 
            </div>

            <!-- Card 2 (Right) -->
            <div class="timeline-row">
                 <!-- Spacer for Grid Logic (keeps 1st column empty) -->
                <div class="timeline-spacer"></div>

                <article class="timeline-card" tabindex="0">
                    <header>
                        <div class="card-header-meta flex flex-wrap gap-2 mb-3">
                            <span class="chip">2021 - 2023</span>
                            <span class="chip">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                                Creative Solutions
                            </span>
                        </div>
                        <h3>Backend Developer</h3>
                        <p class="role-subtitle font-bold text-slate-500 dark:text-slate-400">API Specialist</p>
                    </header>
                    
                    <p>Built robust RESTful APIs serving 100k+ daily users, ensuring 99.9% uptime and data integrity.</p>

                    <details>
                        <summary>Show Key Achievements</summary>
                        <div class="details-content">
                            <ul class="list-disc list-inside text-sm text-slate-600 dark:text-slate-400 space-y-1 mb-3">
                                <li>Optimized SQL queries reducing load by 30%.</li>
                                <li>Implemented OAuth2 authentication flow.</li>
                            </ul>
                            <div class="tech-stack">
                                <span class="tech-pill">Node.js</span>
                                <span class="tech-pill">PostgreSQL</span>
                                <span class="tech-pill">Redis</span>
                            </div>
                        </div>
                    </details>
                    
                    <footer class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                         <a href="#" class="text-sm font-bold text-blue-500 hover:text-blue-400 transition-colors">See Detail &rarr;</a>
                    </footer>
                </article>
            </div>

            <!-- Card 3 (Left) -->
            <div class="timeline-row">
                <article class="timeline-card" tabindex="0">
                    <header>
                        <div class="card-header-meta flex flex-wrap gap-2 mb-3">
                            <span class="chip">2019 - 2021</span>
                            <span class="chip">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                                StartUp Hub
                            </span>
                        </div>
                        <h3>Junior Web Developer</h3>
                        <p class="role-subtitle font-bold text-slate-500 dark:text-slate-400">Frontend Focus</p>
                    </header>
                    
                    <p>Collaborated with designers to translate Figma mockups into pixel-perfect responsive web pages.</p>

                    <details>
                        <summary>Show Key Achievements</summary>
                        <div class="details-content">
                            <ul class="list-disc list-inside text-sm text-slate-600 dark:text-slate-400 space-y-1 mb-3">
                                <li>Developed main marketing site.</li>
                                <li>Integrated Stripe payment gateway.</li>
                            </ul>
                            <div class="tech-stack">
                                <span class="tech-pill">HTML/CSS</span>
                                <span class="tech-pill">JavaScript</span>
                                <span class="tech-pill">React</span>
                            </div>
                        </div>
                    </details>
                    
                     <footer class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                         <a href="#" class="text-sm font-bold text-blue-500 hover:text-blue-400 transition-colors">See Detail &rarr;</a>
                    </footer>
                </article>
                 <div class="timeline-spacer"></div>
            </div>

        </section>
    </div>
</x-app-layout>
