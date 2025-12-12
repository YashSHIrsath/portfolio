<x-admin-layout>
    <x-slot name="title">Edit Project</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Edit Project</h1>
            <a href="{{ route('admin.projects.index') }}" class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div>
                        <label for="link" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Link</label>
                        <input type="url" name="link" id="link" value="{{ old('link', $project->link) }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="tech_stack" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tech Stack (comma separated)</label>
                        <input type="text" name="tech_stack" id="tech_stack" value="{{ old('tech_stack', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : '') }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="sort_order" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $project->sort_order) }}" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="flex items-center pt-6">
                            <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded" value="1" {{ $project->is_active ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Update Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
