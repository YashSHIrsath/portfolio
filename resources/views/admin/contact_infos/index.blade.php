<x-admin-layout>
    <x-slot name="title">Contact Info</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Contact Info</h1>
            <a href="{{ route('admin.contact-infos.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold py-2 px-4 rounded shadow-sm transition-colors">
                + Add New Info
            </a>
        </div>



        <!-- Desktop Table -->
        <div class="hidden lg:block bg-white dark:bg-[#161b22] shadow rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-[#0d1117]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sort</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Label</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Value</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Active</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-[#161b22] divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($contactInfos as $info)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                {{ $info->sort_order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-slate-100">
                                <div class="flex items-center gap-2">
                                    <i class="{{ $info->icon_class }} text-slate-400"></i>
                                    {{ $info->label }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                {{ Str::limit($info->value, 30) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $info->active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ $info->active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.contact-infos.edit', $info) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.contact-infos.destroy', $info) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500 dark:text-slate-400">
                                No contact info found. Click "Add New Info" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="lg:hidden space-y-4">
            @forelse($contactInfos as $info)
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-4 shadow">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center gap-3 flex-1">
                            <i class="{{ $info->icon_class }} text-slate-400"></i>
                            <div>
                                <h3 class="font-medium text-slate-900 dark:text-slate-100">{{ $info->label }}</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $info->value }}</p>
                            </div>
                        </div>
                        <span class="ml-3 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $info->active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                            {{ $info->active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Sort: {{ $info->sort_order }}</span>
                        <div class="flex gap-3">
                            <a href="{{ route('admin.contact-infos.edit', $info) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.contact-infos.destroy', $info) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-8 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">No contact info found. Click "Add New Info" to create one.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>
