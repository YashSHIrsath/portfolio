<x-admin-layout>
    <x-slot name="title">Typing Texts</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Typing Animation Texts</h1>
            <a href="{{ route('admin.typing-texts.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold py-2 px-4 rounded shadow-sm transition-colors">
                + Add New Text
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Desktop Table -->
        <div class="hidden lg:block bg-white dark:bg-[#161b22] shadow rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-[#0d1117]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sort</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Text</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-[#161b22] divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($typingTexts as $text)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                {{ $text->sort_order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-slate-100">
                                {{ $text->text }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $text->active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                                    {{ $text->active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.typing-texts.edit', $text) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.typing-texts.destroy', $text) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-slate-500 dark:text-slate-400">
                                No texts found. Click "Add New Text" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="lg:hidden space-y-4">
            @forelse($typingTexts as $text)
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-4 shadow">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="font-medium text-slate-900 dark:text-slate-100 mb-1">{{ $text->text }}</h3>
                            <span class="text-xs text-slate-500 dark:text-slate-400">Sort: {{ $text->sort_order }}</span>
                        </div>
                        <span class="ml-3 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $text->active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                            {{ $text->active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-end gap-3 text-sm">
                        <a href="{{ route('admin.typing-texts.edit', $text) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('admin.typing-texts.destroy', $text) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-8 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">No texts found. Click "Add New Text" to create one.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>
