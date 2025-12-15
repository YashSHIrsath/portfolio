<x-admin-layout>
    <x-slot name="title">Projects</x-slot>

    <div class="max-w-5xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Projects</h1>
            <a href="{{ route('admin.projects.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold py-2 px-4 rounded shadow-sm transition-colors">
                + Add Project
            </a>
        </div>



        <!-- Desktop Table -->
        <div class="hidden lg:block bg-white dark:bg-[#161b22] shadow rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-[#0d1117]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sort</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Title/Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tech Stack</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Active</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-[#161b22] divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($projects as $project)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $project->sort_order }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-slate-100">
                                <div><a href="{{ $project->link ?? '#' }}" target="_blank" class="hover:underline">{{ $project->title }}</a></div>
                                <div class="text-xs text-slate-500 font-normal truncate max-w-xs">{{ Str::limit($project->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                                @if(!empty($project->tech_stack) && is_array($project->tech_stack))
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400">{{ $tech }}</span>
                                        @endforeach
                                        @if(count($project->tech_stack) > 3)
                                            <span class="text-xs text-slate-400">+{{ count($project->tech_stack) - 3 }}</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ $project->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500 dark:text-slate-400">No projects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="lg:hidden space-y-4">
            @forelse($projects as $project)
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-4 shadow">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="font-medium text-slate-900 dark:text-slate-100">
                                <a href="{{ $project->link ?? '#' }}" target="_blank" class="hover:underline">{{ $project->title }}</a>
                            </h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ Str::limit($project->description, 80) }}</p>
                        </div>
                        <span class="ml-3 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                            {{ $project->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    @if(!empty($project->tech_stack) && is_array($project->tech_stack))
                        <div class="flex flex-wrap gap-1 mb-3">
                            @foreach(array_slice($project->tech_stack, 0, 4) as $tech)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400">{{ $tech }}</span>
                            @endforeach
                            @if(count($project->tech_stack) > 4)
                                <span class="text-xs text-slate-400">+{{ count($project->tech_stack) - 4 }}</span>
                            @endif
                        </div>
                    @endif
                    
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Sort: {{ $project->sort_order }}</span>
                        <div class="flex gap-3">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-8 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">No projects found.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>
