<x-app-layout>
    <x-slot name="title">Home Settings</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 text-slate-800 dark:text-slate-100">Home Page Settings</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- General Settings Form -->
        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 mb-8 border border-slate-200 dark:border-slate-800">
            <h2 class="text-lg font-semibold mb-4 text-slate-700 dark:text-slate-200">Content</h2>
            <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Profile Image</label>
                    <input type="file" name="profile_image" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @if(isset($settings['profile_image']))
                        <div class="mt-2">
                            <img src="{{ Storage::url($settings['profile_image']) }}" alt="Current Profile" class="h-20 w-20 rounded-full object-cover">
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Typing Text (e.g., Web Developer)</label>
                    <input type="text" name="typing_text" value="{{ $settings['typing_text'] ?? '' }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500">{{ $settings['description'] ?? '' }}</textarea>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save Changes
                </button>
            </form>
        </div>

        <!-- Social Links Management -->
        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <h2 class="text-lg font-semibold mb-4 text-slate-700 dark:text-slate-200">Social Links</h2>
            
            <!-- Add New Link Form -->
            <form action="{{ route('admin.social-links.store') }}" method="POST" class="mb-6 bg-slate-50 dark:bg-[#0d1117] p-4 rounded-md">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="text" name="platform" placeholder="Platform (e.g. GitHub)" class="px-3 py-2 border rounded-md dark:bg-[#161b22] dark:border-slate-700 dark:text-slate-100" required>
                    <input type="url" name="url" placeholder="URL" class="px-3 py-2 border rounded-md dark:bg-[#161b22] dark:border-slate-700 dark:text-slate-100" required>
                    <input type="text" name="icon_class" placeholder="Icon SVG/Class (Optional)" class="px-3 py-2 border rounded-md dark:bg-[#161b22] dark:border-slate-700 dark:text-slate-100">
                    <input type="number" name="sort_order" placeholder="Sort Order" value="0" class="px-3 py-2 border rounded-md dark:bg-[#161b22] dark:border-slate-700 dark:text-slate-100">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded col-span-1 md:col-span-2">Add Link</button>
                </div>
            </form>

            <!-- List Existing Links -->
            <ul class="space-y-2">
                @foreach($socialLinks as $link)
                    <li class="flex items-center justify-between bg-slate-50 dark:bg-[#0d1117] p-3 rounded-md border border-slate-200 dark:border-slate-700">
                        <div class="flex items-center gap-4">
                            <span class="font-medium text-slate-700 dark:text-slate-200">{{ $link->platform }}</span>
                            <a href="{{ $link->url }}" target="_blank" class="text-sm text-blue-600 hover:underline truncate max-w-xs">{{ $link->url }}</a>
                            <span class="text-xs text-slate-500">Sort: {{ $link->sort_order }}</span>
                        </div>
                        <form action="{{ route('admin.social-links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
