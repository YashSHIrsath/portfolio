<x-admin-layout>
    <x-slot name="title">Social Links</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Social Links</h1>
            <a href="{{ route('admin.social-links.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold py-2 px-4 rounded shadow-sm transition-colors">
                + Add New Link
            </a>
        </div>



        <!-- Desktop Table -->
        <div class="hidden lg:block bg-white dark:bg-[#161b22] shadow rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-[#0d1117]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sort</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Platform</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">URL</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-[#161b22] divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($socialLinks as $link)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                {{ $link->sort_order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-slate-100">
                                <div class="flex items-center gap-2">
                                    @if($link->icon_class)
                                        <i class="{{ $link->icon_class }} text-lg text-slate-500"></i>
                                    @endif
                                    {{ $link->platform }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 dark:text-blue-400">
                                <a href="{{ $link->url }}" target="_blank" class="hover:underline truncate max-w-xs block">{{ $link->url }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.social-links.edit', $link) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this link?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-slate-500 dark:text-slate-400">
                                No social links found. Click "Add New Link" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="lg:hidden space-y-4">
            @forelse($socialLinks as $link)
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-4 shadow">
                    <div class="flex items-center gap-3 mb-3">
                        @if($link->icon_class)
                            <i class="{{ $link->icon_class }} text-lg text-slate-500"></i>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-medium text-slate-900 dark:text-slate-100">{{ $link->platform }}</h3>
                            <a href="{{ $link->url }}" target="_blank" class="text-sm text-blue-600 dark:text-blue-400 hover:underline break-all">{{ $link->url }}</a>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Sort: {{ $link->sort_order }}</span>
                        <div class="flex gap-3">
                            <a href="{{ route('admin.social-links.edit', $link) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this link?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-8 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">No social links found. Click "Add New Link" to create one.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>
