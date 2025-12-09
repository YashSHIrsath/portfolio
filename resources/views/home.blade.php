<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yash Shirsath - Home</title>
    
    <!-- JetBrains Mono Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Inline script to apply theme immediately and prevent flash -->
    <script>
        (function() {
            try {
                const theme = localStorage.getItem('theme') || 'dark';
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch(e) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    
    <style>
        body {
            font-family: 'JetBrains Mono', monospace;
        }
        
        /* Blinking caret animation */
        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }
        
        .typing-caret {
            display: inline-block;
            width: 2px;
            height: 1.2em;
            background-color: #58a6ff;
            margin-left: 2px;
            animation: blink 1s infinite;
            vertical-align: baseline;
        }
        
        /* Page blur when modal is open */
        body.is-blurred {
            overflow: hidden;
        }
        
        body.is-blurred main {
            filter: blur(4px);
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-white dark:bg-[#0d1117] text-gray-900 dark:text-[#e6edf3] min-h-screen transition-colors">
    @include('components.navbar')
    
    <main class="min-h-screen flex items-center justify-center px-4 py-12">
        <section class="w-full max-w-6xl">
            <!-- Hero Section -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8 md:gap-12">
                
                <!-- Left: Avatar -->
                <div class="flex-shrink-0">
                    <img 
                        src="https://i.pravatar.cc/300" 
                        alt="Yash Shirsath photo" 
                        class="w-56 h-56 md:w-[220px] md:h-[220px] rounded-full object-cover border-4 border-[#58a6ff] shadow-lg hover:scale-[1.03] transition-transform duration-300"
                    >
                </div>
                
                <!-- Right: Content -->
                <div class="flex-1 text-center md:text-left">
                    <!-- Typing Animation -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                        <span>I am </span>
                        <span class="js-typing inline-block">
                            <span class="js-typing-text"></span>
                            <span class="typing-caret"></span>
                        </span>
                    </h1>
                    
                    <!-- Personal Overview -->
                    <p class="text-lg md:text-xl text-gray-700 dark:text-[#e6edf3]/80 mb-8 max-w-2xl mx-auto md:mx-0 text-justify">
                        Building digital experiences and bringing ideas to life through code and creativity.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-8 justify-center md:justify-start">
                        <button 
                            type="button"
                            class="js-download-cv px-6 py-3 bg-[#58a6ff] text-white dark:text-[#0d1117] font-semibold rounded-lg hover:bg-[#58a6ff]/90 hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#58a6ff] focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-[#0d1117]"
                            aria-label="Download CV"
                        >
                            Download CV
                        </button>
                        
                        <button 
                            type="button"
                            class="js-contact-btn px-6 py-3 bg-transparent border-2 border-[#58a6ff] text-[#58a6ff] font-semibold rounded-lg hover:bg-[#58a6ff] hover:text-white dark:hover:text-[#0d1117] hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#58a6ff] focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-[#0d1117]"
                            aria-label="Contact Me"
                        >
                            Contact Me
                        </button>
                    </div>
                    
                    <!-- Social Icons -->
                    <div class="flex gap-4 justify-center md:justify-start">
                        <a 
                            href="#" 
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 dark:bg-[#21262d] text-gray-700 dark:text-[#e6edf3] hover:bg-[#58a6ff] hover:text-white dark:hover:text-[#0d1117] transition-colors duration-200"
                            aria-label="Instagram"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        
                        <a 
                            href="#" 
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 dark:bg-[#21262d] text-gray-700 dark:text-[#e6edf3] hover:bg-[#58a6ff] hover:text-white dark:hover:text-[#0d1117] transition-colors duration-200"
                            aria-label="LinkedIn"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.386-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        
                        <a 
                            href="#" 
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 dark:bg-[#21262d] text-gray-700 dark:text-[#e6edf3] hover:bg-[#58a6ff] hover:text-white dark:hover:text-[#0d1117] transition-colors duration-200"
                            aria-label="GitHub"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Contact Modal -->
    <div 
        class="js-contact-modal fixed inset-0 z-50 hidden items-center justify-center p-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="contact-modal-title"
    >
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" aria-hidden="true"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-[#161b22] border border-[#30363d] rounded-lg shadow-xl max-w-md w-full p-6">
            <!-- Close Button -->
            <button 
                type="button"
                class="js-contact-close absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#21262d] transition-colors focus:outline-none focus:ring-2 focus:ring-[#58a6ff]"
                aria-label="Close contact modal"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <!-- Modal Header -->
            <h2 id="contact-modal-title" class="text-2xl font-bold mb-6">Get in Touch</h2>
            
            <!-- Contact Details -->
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-[#21262d]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-[#e6edf3]/60">Email</p>
                        <a href="mailto:yashshirsath@gmail.com" class="text-[#58a6ff] hover:underline">
                            yashshirsath@gmail.com
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-[#21262d]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-[#e6edf3]/60">Phone</p>
                        <a href="tel:+1234567890" class="text-[#58a6ff] hover:underline">
                            +1 (234) 567-8900
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('js/theme/theme.js') }}" defer></script>
    <script src="{{ asset('js/navbar/navbar.js') }}" defer></script>
    <script src="{{ asset('js/home/typing.js') }}" defer></script>
    <script src="{{ asset('js/home/contact.js') }}" defer></script>
</body>
</html>
