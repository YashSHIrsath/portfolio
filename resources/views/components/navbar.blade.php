<nav class="w-full text-gray-900 dark:text-[#e6edf3]  transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left side: Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold transition-colors" style="font-family: 'JetBrains Mono', monospace;">
                    Yash Shirsath
                </a>
            </div>
            
            <!-- Right side: Navigation menu -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="hover:opacity-80 transition-colors" style="font-family: 'JetBrains Mono', monospace;">
                    Home
                </a>
                <button type="button" class="js-theme-toggle p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle theme">
                    <!-- show sun when theme is dark (clicking will switch to light) -->
                    <svg class="js-icon-sun h-5 w-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                      <circle cx="12" cy="12" r="5"></circle>
                      <line x1="12" y1="1" x2="12" y2="3"></line>
                      <line x1="12" y1="21" x2="12" y2="23"></line>
                      <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                      <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                      <line x1="1" y1="12" x2="3" y2="12"></line>
                      <line x1="21" y1="12" x2="23" y2="12"></line>
                      <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                      <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                  
                    <!-- show moon when theme is light (clicking will switch to dark) -->
                    <svg class="js-icon-moon h-5 w-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                      <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                  </button>
            </div>
        </div>
    </div>
</nav>

