<x-admin-layout>
    <x-slot name="title">Add Contact Info</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="mb-6">
            <a href="{{ route('admin.contact-infos.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-1">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg border border-slate-200 dark:border-slate-800 p-6">
            <h1 class="text-2xl font-bold mb-6 text-slate-800 dark:text-slate-100">Add New Contact Info</h1>

            <form action="{{ route('admin.contact-infos.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Label *</label>
                    <input type="text" name="label" value="{{ old('label') }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. Phone, WhatsApp" required>
                    @error('label') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Value *</label>
                    <input type="text" name="value" value="{{ old('value') }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. +91 9876543210" required>
                    <p class="text-xs text-slate-500 mt-1">This is what gets displayed.</p>
                    @error('value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Link (Optional)</label>
                    <input type="text" name="link" value="{{ old('link') }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. tel:+919876543210 or https://wa.me/...">
                    <p class="text-xs text-slate-500 mt-1">Make the item clickable. Leave empty for text only.</p>
                    @error('link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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

                <div class="mb-4 flex items-center gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-3 py-2 border rounded-md dark:bg-[#0d1117] dark:border-slate-700 dark:text-slate-100 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="flex items-center pt-6">
                        <input type="checkbox" name="active" value="1" id="active" {{ old('active', true) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="active" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                            Active
                        </label>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-colors">
                        Create Contact Info
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
