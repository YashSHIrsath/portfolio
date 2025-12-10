<x-admin-layout>
    <x-slot name="title">Add Typing Text</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Add Typing Text</h1>
            <a href="{{ route('admin.typing-texts.index') }}" class="text-sm text-slate-500 hover:text-slate-700 dark:hover:text-slate-300">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.typing-texts.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Display Text *</label>
                    <input type="text" name="text" value="{{ old('text') }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500" required placeholder="e.g. Web Developer">
                    @error('text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="active" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ old('active', true) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">Active (Visible on homepage)</span>
                    </label>
                    @error('active') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500">
                    @error('sort_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded shadow-sm transition-colors">
                        Create Text
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
