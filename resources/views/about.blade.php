@php
    $bio = \App\Models\Bio::where('is_active', true)->latest()->first();
    $catStacks = \App\Models\CatStack::where('is_active', true)->orderBy('sort_order')->get();
    $experiences = \App\Models\Experience::where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
@endphp

<x-app-layout>
    <x-slot name="title">About Me</x-slot>

    <div class="w-full max-w-6xl mx-auto px-4 md:px-0 py-12 animate-fade-in relative z-10 min-h-[85vh] flex flex-col justify-center gap-6">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tighter mb-4">
                /about_me
            </h1>
            <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">
                System status: <span class="text-green-500 font-bold">ONLINE</span>
            </p>
        </div>

        <!-- Vertical Stack Layout -->
        <div class="flex flex-col gap-12 w-full">
            
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

            <!-- Section 2: Detailed Experience Timeline - Full Width -->
            <div class="w-full">
                <div class="flex items-center gap-4 mb-8">
                     <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                        <i class="fa-solid fa-briefcase text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Professional Journey</h2>
                </div>

                <div class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:h-full before:w-0.5 before:-translate-x-px before:bg-gradient-to-b before:from-blue-500 before:via-slate-300 before:to-transparent dark:before:via-slate-700 md:before:mx-auto md:before:translate-x-0">
                    
                    @forelse($experiences as $index => $exp)
                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                             
                             <!-- Icon / Dot -->
                            <div class="absolute left-0 h-10 w-10 shrink-0 flex items-center justify-center rounded-full border-4 border-white bg-blue-500 dark:border-[#161b22] dark:bg-blue-600 shadow md:order-1 md:left-1/2 md:-translate-x-1/2 group-hover:scale-110 transition-transform z-10">
                                <i class="fa-solid fa-check text-white text-xs"></i>
                            </div>
                            
                            <!-- Content Card -->
                            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white dark:bg-[#161b22] p-6 rounded-[2rem] border border-slate-200 dark:border-white/10 shadow-lg hover:shadow-xl transition-all duration-300">
                                <div class="flex flex-col sm:flex-row justify-between items-start gap-2 mb-4">
                                    <div>
                                        <h3 class="font-bold text-xl text-slate-900 dark:text-white">{{ $exp->position }}</h3>
                                        @if($exp->company)
                                            <span class="text-blue-600 dark:text-blue-400 font-semibold">{{ $exp->company }}</span>
                                        @endif
                                    </div>
                                    <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wide border border-slate-200 dark:border-white/10">
                                        {{ $exp->duration }}
                                    </span>
                                </div>
                                <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm">
                                    {{ $exp->description }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="pl-8 text-sm text-slate-400 italic">No experience added yet.</div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
