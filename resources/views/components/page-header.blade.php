@props(['title', 'description'])

<div class="w-full max-w-6xl mx-auto px-4 md:px-0 py-6 animate-fade-in">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tighter mb-4">
            {{ $title }}
        </h1>
        <p class="text-slate-500 dark:text-slate-400 font-medium text-lg max-w-2xl mx-auto">
            {{ $description }}
        </p>
    </div>
</div>