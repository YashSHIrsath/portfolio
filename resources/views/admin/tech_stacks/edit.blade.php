<x-admin-layout>
    <x-slot name="title">Edit Tech Stack</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="mb-6">
            <a href="{{ route('admin.tech-stacks.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-1">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg border border-slate-200 dark:border-slate-800 p-6">
            <h1 class="text-2xl font-bold mb-6 text-slate-800 dark:text-slate-100">Edit Tech Stack</h1>

            <form action="{{ route('admin.tech-stacks.update', $techStack) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $techStack->name) }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Icon *</label>
                    
                    <!-- Search Input for Icons -->
                    <input type="text" id="icon-search" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 mb-2 text-sm" placeholder="Search icon (e.g. 'react', 'code')...">
                    
                    <select name="icon_class" id="icon-select" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500 font-mono" size="5">
                        <option value="">Select an icon...</option>
                        @foreach($icons as $class => $label)
                            <option value="{{ $class }}" {{ old('icon_class', $techStack->icon_class) == $class ? 'selected' : '' }} data-label="{{ strtolower($label) }} {{ strtolower($class) }}">
                                {{ $label }} ({{ $class }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-slate-500 mt-1">Select from the list. Use search above to filter.</p>
                    @error('icon_class') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">URL (Optional)</label>
                    <input type="url" name="url" value="{{ old('url', $techStack->url) }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500">
                    @error('url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4 flex items-center gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $techStack->sort_order) }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="flex items-center pt-6">
                        <input type="checkbox" name="active" value="1" id="active" {{ old('active', $techStack->active) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="active" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                            Active
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex gap-4">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-colors">
                        Update Tech Stack
                    </button>
                    <a href="{{ route('admin.tech-stacks.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 font-bold py-2 px-4 rounded text-center transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Simple Icon Filter Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('icon-search');
            const select = document.getElementById('icon-select');
            const originalOptions = Array.from(select.options);

            searchInput.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                
                // Reset options
                select.innerHTML = '';

                // Filter and append
                originalOptions.forEach(opt => {
                    const label = opt.getAttribute('data-label');
                    if (opt.value === "" || (label && label.includes(term))) {
                        select.appendChild(opt);
                    }
                });
            });
        });
    </script>
</x-admin-layout>
