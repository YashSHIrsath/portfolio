<x-admin-layout>
    <x-slot name="title">GitHub Projects</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white">GitHub Projects</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2">Manage images and live links for your GitHub repositories</p>
            </div>
            <a href="{{ route('admin.github-settings.edit') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-cog mr-2"></i>GitHub Settings
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-green-700 dark:text-green-300">
                <i class="fa-solid fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(!$username)
            <div class="text-center py-24 space-y-8">
                <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto">
                    <i class="fa-brands fa-github text-3xl text-slate-400"></i>
                </div>
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">No GitHub Username Set</h3>
                    <p class="text-slate-600 dark:text-slate-400 max-w-md mx-auto">
                        Please configure your GitHub username in settings to manage GitHub projects.
                    </p>
                    <a href="{{ route('admin.github-settings.edit') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-colors">
                        <i class="fa-solid fa-cog"></i>
                        Configure GitHub Settings
                    </a>
                </div>
            </div>
        @elseif($repositories->count() === 0)
            <div class="text-center py-24 space-y-8">
                <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto">
                    <i class="fa-brands fa-github text-3xl text-slate-400"></i>
                </div>
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">No Repositories Found</h3>
                    <p class="text-slate-600 dark:text-slate-400 max-w-md mx-auto">
                        No GitHub repositories found for username: <strong>{{ $username }}</strong>
                    </p>
                    <a href="{{ route('admin.github-settings.edit') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-colors">
                        <i class="fa-solid fa-sync"></i>
                        Sync Repositories
                    </a>
                </div>
            </div>
        @else
            <div class="hidden lg:block bg-white dark:bg-[#161b22] shadow rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                    <thead class="bg-slate-50 dark:bg-[#0d1117]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Repository</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Stats</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Live URL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-[#161b22] divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($repositories as $repo)
                            <tr>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center gap-3">
                                        <i class="fa-brands fa-github text-slate-400"></i>
                                        <div>
                                            <h4 class="font-medium text-slate-900 dark:text-slate-100">{{ $repo->name }}</h4>
                                            <p class="text-slate-500 dark:text-slate-400 text-xs">{{ Str::limit($repo->description, 50) ?: 'No description' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                                    <div class="flex items-center gap-4">
                                        <span class="flex items-center gap-1">
                                            <i class="fa-regular fa-star text-xs"></i>
                                            {{ $repo->stargazers_count }}
                                        </span>
                                        @if($repo->language)
                                            <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded-full text-xs">{{ $repo->language }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($repo->live_url)
                                        <a href="{{ $repo->live_url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                                            {{ Str::limit($repo->live_url, 30) }}
                                        </a>
                                    @else
                                        <span class="text-slate-400">Not set</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($repo->image)
                                        <div class="flex items-center gap-2">
                                            <img src="{{ Storage::url($repo->image) }}" alt="{{ $repo->name }}" class="w-8 h-8 rounded object-cover">
                                            <span class="text-green-600 dark:text-green-400 text-xs">Set</span>
                                        </div>
                                    @else
                                        <span class="text-slate-400">Not set</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <button onclick="openEditModal({{ $repo->id }}, '{{ $repo->name }}', '{{ $repo->live_url }}', {{ $repo->image ? 'true' : 'false' }})" 
                                        class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 font-medium">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="lg:hidden space-y-4">
                @foreach($repositories as $repo)
                    <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-4 shadow">
                        <div class="flex items-start gap-3 mb-3">
                            <i class="fa-brands fa-github text-slate-400 mt-1"></i>
                            <div class="flex-1">
                                <h4 class="font-medium text-slate-900 dark:text-slate-100">{{ $repo->name }}</h4>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">{{ $repo->description ?: 'No description' }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Live URL:</span>
                                @if($repo->live_url)
                                    <a href="{{ $repo->live_url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                                        {{ Str::limit($repo->live_url, 25) }}
                                    </a>
                                @else
                                    <span class="text-slate-400 text-sm">Not set</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Image:</span>
                                @if($repo->image)
                                    <div class="flex items-center gap-2">
                                        <img src="{{ Storage::url($repo->image) }}" alt="{{ $repo->name }}" class="w-6 h-6 rounded object-cover">
                                        <span class="text-green-600 dark:text-green-400 text-sm">Set</span>
                                    </div>
                                @else
                                    <span class="text-slate-400 text-sm">Not set</span>
                                @endif
                            </div>
                        </div>
                        
                        <button onclick="openEditModal({{ $repo->id }}, '{{ $repo->name }}', '{{ $repo->live_url }}', {{ $repo->image ? 'true' : 'false' }})" 
                            class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
                            Edit Repository
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-md">
        <div class="bg-white dark:bg-[#161b22] rounded-2xl shadow-2xl max-w-md w-full border border-slate-200 dark:border-slate-800">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white" id="modalTitle">Edit Repository</h3>
            </div>
            
            <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Live Project URL</label>
                    <input type="url" name="live_url" id="liveUrl" 
                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="https://example.com">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Repository Image</label>
                    <input type="file" name="image" accept="image/*" 
                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-slate-500 mt-1">Upload a new image to replace the current one</p>
                </div>
                
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeEditModal()" 
                        class="px-4 py-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        Update Repository
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, liveUrl, hasImage) {
            document.getElementById('modalTitle').textContent = `Edit ${name}`;
            document.getElementById('editForm').action = `/admin/github-projects/${id}`;
            document.getElementById('liveUrl').value = liveUrl || '';
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }

        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</x-admin-layout>