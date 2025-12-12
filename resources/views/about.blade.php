@php
    $bio = \App\Models\Bio::where('is_active', true)->latest()->first();
    $catStacks = \App\Models\CatStack::where('is_active', true)->orderBy('sort_order')->get();
    $bio = \App\Models\Bio::where('is_active', true)->latest()->first();
    $catStacks = \App\Models\CatStack::where('is_active', true)->orderBy('sort_order')->get();
@endphp

<x-app-layout main-class="flex-grow flex flex-col">
    <x-slot name="title">About Me</x-slot>

    <div class="w-full max-w-6xl mx-auto px-4 md:px-0 py-6 animate-fade-in relative z-10 flex flex-col justify-center gap-6">

        <!-- Vertical Stack Layout -->
        <div class="flex flex-col gap-12 w-full">
            <!-- Action/Nav Hints -->
            <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                <div class="flex items-center gap-3 bg-slate-100 dark:bg-white/5 px-4 py-1.5 rounded-full border border-slate-200 dark:border-white/5">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <p class="text-xs font-mono text-slate-500 dark:text-slate-400 font-bold tracking-wide">
                        ONLINE
                    </p>
                </div>
            </div>
            
            <!-- Section 1: Terminal (Bio & Stack) - Full Width -->
            <div class="w-full">
                <div class="relative w-full bg-[#1e1e1e] rounded-[1.5rem] border border-slate-800 shadow-2xl overflow-hidden transform hover:scale-[1.005] transition-all duration-500">
                    <!-- Terminal Header -->
                    <div class="flex items-center px-6 py-4 bg-[#252526] border-b border-[#3e3e42]">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-[#ff5f56]"></div>
                            <div class="w-3 h-3 rounded-full bg-[#ffbd2e]"></div>
                            <div class="w-3 h-3 rounded-full bg-[#27c93f]"></div>
                        </div>
                        <div class="ml-4 text-xs text-slate-500 font-mono">yash @ portfolio ~ </div>
                    </div>

                    <!-- Terminal Body -->
                    <div class="p-8 font-mono text-sm leading-relaxed text-slate-300">
                        
                        <!-- Command 1: whoami -->
                        <div class="mb-10">
                            <p class="mb-3 font-bold">
                                <span class="text-[#27c93f]">➜</span> <span class="text-[#58a6ff]">~</span> <span class="text-[#ffbd2e]">whoami</span>
                            </p>
                            <div class="pl-6 border-l-2 border-slate-700 ml-1 text-slate-400 whitespace-pre-wrap leading-8 text-base">
{{ $bio->content ?? 'I am a dedicated full-stack developer crafting scalable web applications.' }}
                            </div>
                        </div>

                        <!-- Command 2: cat stack.json -->
                        <div>
                            <p class="mb-3 font-bold">
                                <span class="text-[#27c93f]">➜</span> <span class="text-[#58a6ff]">~</span> <span class="text-[#ffbd2e]">cat stack.json</span>
                            </p>
                            <div class="pl-4 ml-1 bg-[#252526] p-6 rounded-xl border border-slate-700/50 shadow-inner">
                                <pre class="text-[#a5d6ff] font-mono text-sm md:text-base leading-7">{
@foreach($catStacks as $stack)
  <span class="text-[#7ee787]">"{{ $stack->key }}"</span>: [
    <span class="text-[#ce9178]">{{ collect($stack->values)->map(fn($v) => '"'.$v.'"')->join(', ') }}</span>
  ]{{ $loop->last ? '' : ',' }}
@endforeach
}</pre>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>
</x-app-layout>
