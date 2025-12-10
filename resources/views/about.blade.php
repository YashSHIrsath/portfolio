<x-app-layout>
    <x-slot name="title">About</x-slot>

    <div class="max-w-2xl mx-auto animate-fade-in text-center">
        <h1 class="text-2xl font-bold mb-6 text-slate-800 dark:text-slate-100">/about_me</h1>
        
        <!-- Terminal/Code Block Style -->
        <div class="w-full bg-[#1e1e1e] rounded-lg shadow-lg overflow-hidden border border-slate-800 text-left mb-8 mx-auto">
            <div class="flex items-center px-4 py-3 bg-[#252526] border-b border-[#3e3e42]">
                <div class="flex gap-2">
                    <div class="w-3 h-3 rounded-full bg-[#ff5f56]"></div>
                    <div class="w-3 h-3 rounded-full bg-[#ffbd2e]"></div>
                    <div class="w-3 h-3 rounded-full bg-[#27c93f]"></div>
                </div>
                <div class="ml-4 text-xs text-slate-500 font-mono">yash @ portfolio ~ </div>
            </div>
            <div class="p-6 text-xs md:text-sm font-mono leading-relaxed text-slate-300">
                <p class="mb-2">
                    <span class="text-[#27c93f]">➜</span> <span class="text-[#58a6ff]">~</span> <span class="text-[#ffbd2e]">whoami</span>
                </p>
                <p class="mb-6 pl-4 text-slate-400">
                    I am Yash Shirsath, a dedicated full-stack developer. I craft scalable web applications using modern technologies.
                </p>
                
                <p class="mb-2">
                    <span class="text-[#27c93f]">➜</span> <span class="text-[#58a6ff]">~</span> <span class="text-[#ffbd2e]">cat stack.json</span>
                </p>
                <div class="pl-4">
                    <pre class="text-[#a5d6ff]">
{
  <span class="text-[#7ee787]">"frontend"</span>: ["Vue", "React", "Tailwind"],
  <span class="text-[#7ee787]">"backend"</span>: ["Laravel", "Node.js"],
  <span class="text-[#7ee787]">"database"</span>: ["MySQL", "Redis"],
  <span class="text-[#7ee787]">"tools"</span>: ["Git", "Docker"]
}
                    </pre>
                </div>
            </div>
        </div>

        <!-- Minimal Experience List -->
        <div class="text-left max-w-lg mx-auto animate-slide-up delay-100">
            <h3 class="text-xs uppercase tracking-widest text-slate-500 font-semibold mb-4 border-b border-slate-200 dark:border-slate-800 pb-2">Experience</h3>
            <div class="space-y-6">
                <div class="relative pl-4 border-l border-slate-200 dark:border-slate-800">
                    <div class="absolute -left-[3px] top-1.5 w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                    <div class="flex justify-between items-baseline mb-1">
                        <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200">Senior Developer</h4>
                        <span class="text-xs text-slate-400 font-mono">2023-Present</span>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Leading development teams and architecting solutions.</p>
                </div>
                
                <div class="relative pl-4 border-l border-slate-200 dark:border-slate-800">
                    <div class="absolute -left-[3px] top-1.5 w-1.5 h-1.5 rounded-full bg-slate-300 dark:bg-slate-600"></div>
                     <div class="flex justify-between items-baseline mb-1">
                        <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200">Web Developer</h4>
                        <span class="text-xs text-slate-400 font-mono">2021-2023</span>
                    </div>
                     <p class="text-xs text-slate-500 dark:text-slate-400">Full stack development using Laravel and Vue.js.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
