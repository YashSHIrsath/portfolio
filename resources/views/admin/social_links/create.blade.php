<x-admin-layout>
    <x-slot name="title">Add Social Link</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Add Social Link</h1>
            <a href="{{ route('admin.social-links.index') }}" class="text-sm text-slate-500 hover:text-slate-700 dark:hover:text-slate-300">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.social-links.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Platform Name *</label>
                    <input type="text" name="platform" value="{{ old('platform') }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500" required placeholder="GitHub">
                    @error('platform') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">URL *</label>
                    <input type="url" name="url" value="{{ old('url') }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500" required placeholder="https://github.com/username">
                    @error('url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Icon *</label>
                    <select name="icon_class" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500 font-mono">
                        <option value="">Select an icon...</option>
                        @foreach($icons as $class => $label)
                            <option value="{{ $class }}" {{ old('icon_class') == $class ? 'selected' : '' }}>
                                {{ $label }} ({{ $class }})
                            </option>
                        @endforeach
                    </select>
                    @error('icon_class') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500">
                    @error('sort_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow-sm transition-colors">
                        Create Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
