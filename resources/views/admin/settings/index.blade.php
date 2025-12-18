<x-admin-layout>
    <x-slot name="title">General Settings</x-slot>

    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">General Settings</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2">Manage your public profile details and resume.</p>
        </div>





        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            
            <!-- Left Column: Visuals -->
            <div class="lg:col-span-1 space-y-8 animate-slide-up">
                
                <!-- Profile Image Card -->
                <div class="bg-white dark:bg-[#161b22] p-8 rounded-[2.5rem] border border-slate-200 dark:border-white/5 shadow-sm text-center relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                    
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Profile Photo</h3>
                    
                    <div class="relative inline-block mb-6">
                        @if(isset($settings['profile_image']))
                            <img src="{{ Storage::url($settings['profile_image']) }}" alt="Profile" class="h-40 w-40 rounded-full object-cover border-4 border-slate-50 dark:border-slate-800 shadow-xl">
                        @else
                            <div class="h-40 w-40 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center border-4 border-slate-50 dark:border-slate-800 shadow-xl">
                                <i class="fa-solid fa-user text-4xl text-slate-300"></i>
                            </div>
                        @endif
                        
                        <!-- Camera Icon Overlay -->
                        <label for="profile_image" class="absolute bottom-2 right-2 w-10 h-10 bg-blue-600 hover:bg-blue-500 text-white rounded-full flex items-center justify-center cursor-pointer shadow-lg transition-transform hover:scale-110">
                            <i class="fa-solid fa-camera text-sm"></i>
                        </label>
                    </div>
                    
                    <input type="file" id="profile_image" name="profile_image" class="hidden">
                    <p class="text-xs text-slate-500 dark:text-slate-400">Allowed: jpg, png, jpeg (Max 2MB)</p>
                </div>

                <!-- Resume Card -->
                <div class="bg-white dark:bg-[#161b22] p-8 rounded-[2.5rem] border border-slate-200 dark:border-white/5 shadow-sm relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-24 h-24 bg-purple-500/10 rounded-br-[80px] -ml-6 -mt-6 transition-transform group-hover:scale-110"></div>
                    
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Resume / CV</h3>
                    
                    <div class="bg-slate-50 dark:bg-white/5 rounded-2xl p-6 mb-6 text-center border-2 border-dashed border-slate-200 dark:border-slate-700 group-hover:border-purple-500/50 transition-colors">
                        <i class="fa-solid fa-file-pdf text-4xl text-purple-500 mb-3 block"></i>
                        @if(isset($settings['resume']))
                            <div class="flex items-center justify-center gap-2 mb-2">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Current Resume</span>
                                <i class="fa-solid fa-circle-check text-green-500 text-xs"></i>
                            </div>
                            <a href="{{ Storage::url($settings['resume']) }}" target="_blank" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">View PDF</a>
                        @else
                            <span class="text-sm text-slate-500">No resume uploaded</span>
                        @endif
                    </div>

                    <label class="block">
                        <span class="sr-only">Choose file</span>
                        <input type="file" name="resume" accept="application/pdf" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-wider file:bg-purple-50 dark:file:bg-purple-900/20 file:text-purple-700 dark:file:text-purple-400 hover:file:bg-purple-100 dark:hover:file:bg-purple-900/30 transition-all cursor-pointer">
                    </label>
                </div>
            </div>

            <!-- Right Column: Name & Description -->
            <div class="lg:col-span-2 animate-slide-up delay-100 space-y-8">
                <!-- Name Settings Card -->
                <div class="bg-white dark:bg-[#161b22] p-8 rounded-[2.5rem] border border-slate-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Personal Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">First Name</label>
                            <input type="text" name="first_name" value="{{ $settings['first_name'] ?? '' }}" class="w-full p-4 bg-slate-50 dark:bg-[#0d1117] border-2 border-transparent focus:border-blue-500/50 rounded-xl text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:outline-none transition-all" placeholder="Enter first name">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ $settings['last_name'] ?? '' }}" class="w-full p-4 bg-slate-50 dark:bg-[#0d1117] border-2 border-transparent focus:border-blue-500/50 rounded-xl text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:outline-none transition-all" placeholder="Enter last name">
                        </div>
                    </div>
                </div>
                
                <!-- Description Card -->
                <div class="bg-white dark:bg-[#161b22] p-8 rounded-[2.5rem] border border-slate-200 dark:border-white/5 shadow-sm flex flex-col">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">About Me Description</h3>
                    
                    <div class="flex-1">
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">
                            This description appears in the Hero section. Use the 
                            <span class="inline-block px-2 py-0.5 rounded bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-xs font-bold">Read More</span> 
                             modal to display the full text.
                        </p>
                        
                        <div class="relative group">
                            <textarea name="description" rows="8" class="w-full p-6 bg-slate-50 dark:bg-[#0d1117] border-2 border-transparent focus:border-blue-500/50 rounded-2xl text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:outline-none focus:ring-0 transition-all resize-none shadow-inner leading-relaxed" placeholder="Write something amazing about yourself...">{{ $settings['description'] ?? '' }}</textarea>
                            
                            <!-- Character Count or Icon decoration -->
                            <div class="absolute bottom-4 right-4 text-xs text-slate-400 pointer-events-none">
                                <i class="fa-solid fa-pen-nib"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Description Card -->
                <div class="bg-white dark:bg-[#161b22] p-8 rounded-[2.5rem] border border-slate-200 dark:border-white/5 shadow-sm flex flex-col">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Contact Page Description</h3>
                    
                    <div class="flex-1">
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">
                            This description appears on the contact page below the main heading.
                        </p>
                        
                        <div class="relative group">
                            <textarea name="contact_description" rows="4" class="w-full p-6 bg-slate-50 dark:bg-[#0d1117] border-2 border-transparent focus:border-blue-500/50 rounded-2xl text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:outline-none focus:ring-0 transition-all resize-none shadow-inner leading-relaxed" placeholder="Enter contact page description...">{{ $settings['contact_description'] ?? '' }}</textarea>
                            
                            <!-- Character Count or Icon decoration -->
                            <div class="absolute bottom-4 right-4 text-xs text-slate-400 pointer-events-none">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 dark:border-white/5 flex justify-end">
                        <button type="submit" class="group relative py-3 px-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full text-white font-bold shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 transition-all duration-300">
                            <span class="flex items-center gap-2">
                                Save Changes <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </span>
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
