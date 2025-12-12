<x-admin-layout>
    <x-slot name="title">Edit Experience</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Edit Experience</h1>
            <a href="{{ route('admin.experiences.index') }}" class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.experiences.update', $experience) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label for="position" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Position</label>
                        <input type="text" name="position" id="position" value="{{ old('position', $experience->position) }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Company</label>
                        <input type="text" name="company" id="company" value="{{ old('company', $experience->company) }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Duration</label>
                        <input type="text" name="duration" id="duration" value="{{ old('duration', $experience->duration) }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $experience->description) }}</textarea>
                    </div>

                    @php
                        // Get currently selected repo names to verify checked state
                        $currentRepos = $experience->github_repos ?? [];
                        // Handle potential corrupted data (strings instead of arrays)
                        $currentRepoNames = array_map(function($r) {
                            $r = is_string($r) ? json_decode($r, true) : (array)$r;
                            return $r['name'] ?? null;
                        }, $currentRepos);
                    @endphp

                    <div>
                        <label for="github_repos" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Linked GitHub Repositories</label>
                        <div class="mt-1 max-h-48 overflow-y-auto border border-slate-300 dark:border-slate-700 rounded-md p-2 dark:bg-[#0d1117]">
                            @if(count($githubRepos) > 0)
                                @foreach($githubRepos as $repo)
                                    <div class="flex items-center gap-2 mb-2 p-1 hover:bg-slate-50 dark:hover:bg-slate-800 rounded">
                                        <input type="checkbox" name="github_repos[]" id="repo_{{ $repo['name'] }}" value="{{ json_encode($repo) }}" 
                                            {{ in_array($repo['name'], $currentRepoNames) ? 'checked' : '' }}
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded">
                                        <label for="repo_{{ $repo['name'] }}" class="flex-1 text-sm text-slate-700 dark:text-slate-300 cursor-pointer grid grid-cols-[1fr,auto]">
                                            <span class="font-medium font-mono">{{ $repo['name'] }}</span>
                                            <span class="text-xs text-slate-500">{{ $repo['language'] ?? 'N/A' }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-xs text-slate-500 p-2">No GitHub repos available. configure API first.</p>
                            @endif
                        </div>
                        <p class="mt-1 text-xs text-slate-500">Select repositories relevant to this experience.</p>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="sort_order" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $experience->sort_order) }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="flex items-center pt-6">
                            <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded" value="1" {{ $experience->is_active ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Update Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
