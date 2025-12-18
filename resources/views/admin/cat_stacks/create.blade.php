<x-admin-layout>
    <x-slot name="title">Add Cat Stack</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Add Cat Stack Group</h1>
            <a href="{{ route('admin.cat-stacks.index') }}" class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.cat-stacks.store') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label for="key" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Key Name</label>
                        <p class="text-xs text-slate-500 mb-2">This is the JSON key (e.g. "frontend", "tools").</p>
                        <input type="text" name="key" id="key" value="{{ old('key') }}" class="mt-1 block w-full px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="e.g. tools" required>
                    </div>

                    <div>
                        <label for="values" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Values (Comma Separated)</label>
                        <p class="text-xs text-slate-500 mb-2">List items separated by commas.</p>
                        <textarea name="values" id="values" rows="4" class="mt-1 block w-full px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm font-mono" placeholder="e.g. Laravel, Python, PHP, Spring Boot" required>{{ old('values') }}</textarea>
                    </div>

                    <div class="flex justify-between gap-4">
                        <div class="flex-1">
                             <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                             <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="mt-1 block w-full px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="flex-1 flex items-center pt-6">
                            <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded" value="1" checked>
                            <label for="is_active" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Save Stack Group
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
