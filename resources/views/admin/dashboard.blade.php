<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-10 animate-fade-in flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white font-heading">Dashboard</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2">Welcome back, {{ auth()->user()->name }}!</p>
            </div>
            <div class="flex items-center gap-3">
                 <span class="px-4 py-2 bg-white dark:bg-[#161b22] rounded-full text-sm font-medium text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/5 shadow-sm">
                    {{ now()->format('l, F j, Y') }}
                </span>
            </div>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Content Links (Collage) -->
            <div class="lg:col-span-2 space-y-8 animate-slide-up">
                
                <!-- Section Header -->
                <div class="flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-shapes text-slate-400"></i>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">Content Management</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Projects Card (Large) -->
                    <a href="{{ route('admin.projects.index') }}" class="group relative md:col-span-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-[2rem] p-8 text-white shadow-xl shadow-indigo-500/20 hover:shadow-indigo-500/30 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                        <div class="relative z-10 flex flex-col h-full justify-between">
                            <div class="flex justify-between items-start">
                                <div class="p-3 bg-white/20 backdrop-blur-md rounded-2xl">
                                    <i class="fa-solid fa-briefcase text-2xl"></i>
                                </div>
                                <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-sm font-medium">
                                    {{ $projectCount ?? 0 }} Projects
                                </span>
                            </div>
                            <div class="mt-8">
                                <h3 class="text-3xl font-bold mb-2">Projects</h3>
                                <p class="text-indigo-100 max-w-md">Manage your portfolio projects, case studies, and work samples.</p>
                            </div>
                        </div>
                        <!-- Decorative Circles -->
                        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
                        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 bg-purple-500/30 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
                    </a>

                    <!-- Experience Card -->
                    <a href="{{ route('admin.experiences.index') }}" class="group relative bg-white dark:bg-[#161b22] rounded-[2rem] p-6 border border-slate-200 dark:border-white/5 hover:border-blue-500/50 hover:shadow-lg transition-all duration-300">
                        <div class="flex flex-col h-full justify-between">
                            <div class="mb-4">
                                <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fa-solid fa-building text-xl"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Experience</h3>
                                <p class="text-slate-500 dark:text-slate-400 text-sm mb-3">{{ $experienceCount ?? 0 }} Roles Listed</p>
                                <div class="flex items-center text-blue-600 dark:text-blue-400 text-sm font-medium">
                                    <span>Manage Timeline</span>
                                    <i class="fa-solid fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                     <!-- Tech Stack Card -->
                    <a href="{{ route('admin.tech-stacks.index') }}" class="group relative bg-white dark:bg-[#161b22] rounded-[2rem] p-6 border border-slate-200 dark:border-white/5 hover:border-emerald-500/50 hover:shadow-lg transition-all duration-300">
                        <div class="flex flex-col h-full justify-between">
                            <div class="mb-4">
                                <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fa-solid fa-layer-group text-xl"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">Tech Stack</h3>
                                <p class="text-slate-500 dark:text-slate-400 text-sm mb-3">{{ $techStackCount ?? 0 }} Technologies</p>
                                <div class="flex items-center text-emerald-600 dark:text-emerald-400 text-sm font-medium">
                                    <span>Update Skills</span>
                                    <i class="fa-solid fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- More Links Row -->
                    <div class="md:col-span-2 grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 p-4 bg-white dark:bg-[#161b22] rounded-2xl border border-slate-200 dark:border-white/5 hover:border-slate-300 dark:hover:border-slate-600 transition-colors">
                            <i class="fa-solid fa-sliders text-slate-400"></i>
                            <span class="font-medium text-slate-700 dark:text-slate-200">Settings</span>
                        </a>
                        <a href="{{ route('admin.social-links.index') }}" class="flex items-center gap-3 p-4 bg-white dark:bg-[#161b22] rounded-2xl border border-slate-200 dark:border-white/5 hover:border-slate-300 dark:hover:border-slate-600 transition-colors">
                            <i class="fa-solid fa-share-nodes text-slate-400"></i>
                             <span class="font-medium text-slate-700 dark:text-slate-200">Socials</span>
                        </a>
                        <div class="flex items-center gap-3 p-4 bg-slate-50 dark:bg-white/5 rounded-2xl border border-transparent text-slate-400 cursor-default">
                             <span class="text-sm">More coming soon...</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Inbox & Quick Stats -->
            <div class="space-y-8 animate-slide-up delay-100">
                
                <!-- Quick Stats Mini Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white dark:bg-[#161b22] p-4 rounded-[1.5rem] border border-slate-200 dark:border-white/5 text-center">
                        <div class="text-2xl font-bold text-slate-900 dark:text-white">{{ $unreadContactsCount ?? 0 }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide mt-1">Inbox</div>
                    </div>
                    <div class="bg-white dark:bg-[#161b22] p-4 rounded-[1.5rem] border border-slate-200 dark:border-white/5 text-center">
                        <div class="text-2xl font-bold text-slate-900 dark:text-white">{{ $typingTextCount ?? 0 }}</div>
                         <div class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide mt-1">Typing</div>
                    </div>
                </div>

                <!-- Recent Inquiries Widget -->
                <div class="bg-white dark:bg-[#161b22] rounded-[2rem] border border-slate-200 dark:border-white/5 overflow-hidden flex flex-col h-full max-h-[600px]">
                    <div class="p-6 border-b border-slate-100 dark:border-white/5 bg-slate-50/50 dark:bg-white/[0.02] flex justify-between items-center">
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white">Recent Inquiries</h3>
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                    </div>

                    <div class="flex-1 overflow-y-auto p-4 space-y-2">
                        @forelse($latestContacts as $contact)
                            <a href="{{ route('admin.contact-submissions.show', $contact) }}" class="block group p-4 rounded-2xl bg-white dark:bg-white/5 border border-slate-100 dark:border-white/5 hover:border-orange-200 dark:hover:border-orange-500/30 transition-colors cursor-pointer">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $contact->name }}</h4>
                                    <span class="text-[0.65rem] font-medium px-2 py-0.5 rounded-full bg-slate-100 dark:bg-white/10 text-slate-500 dark:text-slate-400">
                                        {{ $contact->created_at->diffForHumans(null, true, true) }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 mb-2">
                                    {{ $contact->message }}
                                </p>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] text-slate-400 bg-slate-50 dark:bg-white/5 px-2 py-1 rounded-md">
                                        {{ $contact->email }}
                                    </span>
                                    @if(!$contact->is_read)
                                        <span class="h-1.5 w-1.5 rounded-full bg-orange-500 ml-auto"></span>
                                    @endif
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-slate-50 dark:bg-white/5 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fa-regular fa-envelope-open text-slate-300 dark:text-slate-600 text-2xl"></i>
                                </div>
                                <p class="text-slate-400 dark:text-slate-500 text-sm">No new messages yet.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="p-4 border-t border-slate-100 dark:border-white/5 bg-slate-50/50 dark:bg-white/[0.02]">
                        <a href="{{ route('admin.contact-submissions.index') }}" class="flex items-center justify-center w-full py-3 px-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl text-sm font-bold hover:opacity-90 transition-opacity">
                            View Inbox
                            <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
