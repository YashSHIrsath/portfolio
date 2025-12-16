<x-app-layout>
    <x-slot name="title">Contact</x-slot>

    <x-page-header title="/contact"
        description="Let's connect and discuss opportunities, collaborations, or just say hello." />



    <!-- Modern Glassmorphic Contact Section -->
    <div class="relative pt-8 pb-16 min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-4 md:px-0 w-full">
            
            <!-- Success Message -->
            @if (session('success'))
                <div class="fixed top-8 right-8 z-50 bg-emerald-500/20 dark:bg-emerald-400/20 backdrop-blur-2xl border border-emerald-500/30 dark:border-emerald-400/30 text-emerald-600 dark:text-emerald-400 px-8 py-4 rounded-full shadow-2xl animate-bounce" role="alert" id="success-message">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-emerald-500 to-green-500 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fa-solid fa-check text-white text-sm"></i>
                        </div>
                        <span class="font-bold text-lg">{{ session('success') }}</span>
                    </div>
                </div>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('success-message');
                        if (msg) {
                            msg.style.transform = 'translateX(400px)';
                            msg.style.opacity = '0';
                            setTimeout(() => msg.remove(), 300);
                        }
                    }, 5000);
                </script>
            @endif

            <!-- Main Contact Container -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-16 items-center">
                
                <!-- Left Side - Contact Info -->
                <div class="space-y-10">
                    <!-- Header -->
                    <div class="space-y-8">
                        <div class="inline-flex items-center gap-4 px-6 py-3 bg-gradient-to-r from-blue-500/10 to-blue-600/10 backdrop-blur-2xl border border-white/20 dark:border-white/10 rounded-full shadow-2xl">
                            <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full shadow-lg"></div>
                            <span class="text-blue-600 dark:text-blue-400 font-bold text-sm">Available for opportunities</span>
                        </div>
                        
                        <h1 class="text-3xl lg:text-4xl font-black text-slate-900 dark:text-white leading-tight">
                            Let's create something
                            <span class="bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">extraordinary</span>
                            together
                        </h1>
                        
                        <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed font-medium">
                            Ready to bring your vision to life? Let's connect and make something incredible happen.
                        </p>
                    </div>

                    <!-- Dynamic Contact Methods -->
                    @php
                        $contactInfos = \App\Models\ContactInfo::where('active', true)->orderBy('sort_order')->get();
                        $colors = ['blue', 'emerald', 'purple', 'orange', 'pink', 'cyan', 'indigo', 'rose'];
                    @endphp
                    
                    <div class="grid gap-6">
                        @forelse($contactInfos as $index => $contact)
                            @php
                                $color = $colors[$index % count($colors)];
                            @endphp
                            <div class="group relative">
                                @if($contact->link)
                                    <a href="{{ $contact->type === 'email' ? 'mailto:' . $contact->value : $contact->link }}" target="_blank" class="flex items-center gap-6 p-6 bg-white/10 dark:bg-white/5 backdrop-blur-2xl border border-white/20 dark:border-white/10 rounded-3xl hover:bg-white/20 dark:hover:bg-white/10 transition-all duration-500 group-hover:scale-105 group-hover:shadow-2xl group-hover:shadow-{{ $color }}-500/25">
                                @else
                                    <div class="flex items-center gap-6 p-6 bg-white/10 dark:bg-white/5 backdrop-blur-2xl border border-white/20 dark:border-white/10 rounded-3xl hover:bg-white/20 dark:hover:bg-white/10 transition-all duration-500 group-hover:scale-105 group-hover:shadow-2xl group-hover:shadow-{{ $color }}-500/25">
                                @endif
                                    <div class="w-16 h-16 bg-gradient-to-br from-{{ $color }}-500/20 to-{{ $color }}-600/30 backdrop-blur-xl rounded-2xl flex items-center justify-center group-hover:from-{{ $color }}-500/40 group-hover:to-{{ $color }}-600/50 transition-all duration-500 shadow-lg">
                                        <i class="{{ $contact->icon_class }} text-{{ $color }}-600 dark:text-{{ $color }}-400 text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold text-lg text-slate-900 dark:text-white mb-1">{{ $contact->label }}</p>
                                        <p class="text-slate-600 dark:text-slate-400 text-sm font-medium">{{ $contact->value }}</p>
                                    </div>
                                    @if($contact->link)
                                        <div class="w-8 h-8 bg-white/20 dark:bg-white/10 backdrop-blur-xl rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <i class="fa-solid fa-external-link text-{{ $color }}-600 dark:text-{{ $color }}-400 text-sm"></i>
                                        </div>
                                    @endif
                                @if($contact->link)
                                    </a>
                                @else
                                    </div>
                                @endif
                            </div>
                        @empty
                            <!-- Fallback contact info -->
                            <div class="flex items-center gap-6 p-6 bg-white/10 dark:bg-white/5 backdrop-blur-2xl border border-white/20 dark:border-white/10 rounded-3xl">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500/20 to-blue-600/30 backdrop-blur-xl rounded-2xl flex items-center justify-center">
                                    <i class="fa-solid fa-envelope text-blue-600 dark:text-blue-400 text-2xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-lg text-slate-900 dark:text-white mb-1">Email</p>
                                    <p class="text-slate-600 dark:text-slate-400 text-sm">contact@example.com</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Right Side - Contact Form -->
                <div class="relative">
                    <!-- Glassmorphic Form Container -->
                    <div class="relative bg-black dark:bg-black border border-slate-800 rounded-[3rem] p-8 shadow-2xl">
                        <!-- Noise Texture Overlay -->
                        <div class="absolute inset-0 rounded-[3rem] opacity-30 mix-blend-overlay" style="background-image: url('data:image/svg+xml,%3Csvg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.9" numOctaves="4" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)" opacity="0.4"/%3E%3C/svg%3E');"></div>
                        
                        <form action="{{ route('contact.store') }}" method="POST" class="relative z-10 space-y-8">
                            @csrf

                            <!-- Dynamic Form Fields -->
                            <div class="grid gap-6">
                                @foreach ($fields as $field)
                                    <div class="space-y-3">
                                        <label for="{{ $field['name'] }}" class="block text-sm font-bold text-slate-300 ml-4">
                                            {{ $field['label'] }} 
                                            @if (!empty($field['required']))
                                                <span class="text-red-500 text-sm">*</span>
                                            @endif
                                        </label>

                                        @if ($field['type'] === 'textarea')
                                            <textarea 
                                                id="{{ $field['name'] }}" 
                                                name="{{ $field['name'] }}" 
                                                class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-2xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300 resize-none h-24 text-sm" 
                                                placeholder="Share your thoughts..." 
                                                {{ !empty($field['required']) ? 'required' : '' }}
                                            ></textarea>
                                        @else
                                            <input 
                                                type="{{ $field['type'] }}" 
                                                id="{{ $field['name'] }}" 
                                                name="{{ $field['name'] }}" 
                                                class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-full text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300 text-sm" 
                                                placeholder="Enter your {{ strtolower($field['label']) }}..." 
                                                {{ !empty($field['required']) ? 'required' : '' }}
                                            >
                                        @endif

                                        @error($field['name'])
                                            <p class="text-red-500 text-sm ml-4 flex items-center gap-2 font-semibold">
                                                <i class="fa-solid fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-8 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-blue-500/50 flex items-center justify-center gap-3 group text-sm">
                                <span>Send Message</span>
                                <i class="fa-solid fa-paper-plane group-hover:translate-x-1 transition-all duration-300 text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Enhanced glassmorphic effects */
        .backdrop-blur-2xl {
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
        }
        
        /* Success message animation */
        #success-message {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        

        
        /* Button enhanced glow */
        button[type="submit"]:hover {
            box-shadow: 0 25px 50px -12px rgba(147, 51, 234, 0.6), 0 0 0 1px rgba(147, 51, 234, 0.3);
        }
        
        /* Animated background gradients */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .animate-pulse {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        /* Responsive grid adjustments */
        @media (max-width: 1280px) {
            .grid.xl\:grid-cols-2 {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
        }
        
        /* Enhanced noise texture */
        .mix-blend-overlay {
            mix-blend-mode: overlay;
        }
    </style>
</x-app-layout>
