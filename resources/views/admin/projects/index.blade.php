<x-admin-layout>
    <x-slot name="title">Projects</x-slot>

    <div class="max-w-5xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Projects</h1>
            <a href="{{ route('admin.projects.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold py-2 px-4 rounded shadow-sm transition-colors">
                + Add Project
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800">
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                {{ $project->sort_order }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-slate-100">
                                <div><a href="{{ $project->link ?? '#' }}" target="_blank" class="hover:underline">{{ $project->title }}</a></div>
                                <div class="text-xs text-slate-500 font-normal truncate max-w-xs">{{ Str::limit($project->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                @if(!empty($project->tech_stack) && is_array($project->tech_stack))
                                    @foreach($project->tech_stack as $tech)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400">{{ $tech }}</span>
                                    @endforeach
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
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500 dark:text-slate-400">
                                No projects found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
