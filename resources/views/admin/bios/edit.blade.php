<x-admin-layout>
    <x-slot name="title">Edit Bio</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Edit Bio</h1>
            <a href="{{ route('admin.bios.index') }}" class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.bios.update', $bio) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Bio Content</label>
                         <p class="text-xs text-slate-500 mb-2">This text will be displayed in the "whoami" section of the About page.</p>
                        <textarea name="content" id="content" rows="10" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('content', $bio->content) }}</textarea>
                    </div>

                    <div class="flex items-center pt-2">
                        <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded" value="1" {{ $bio->is_active ? 'checked' : '' }}>
                        <label for="is_active" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                            Active
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Update Bio
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
