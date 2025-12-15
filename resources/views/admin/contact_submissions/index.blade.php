<x-admin-layout>
    <x-slot name="title">Inbox</x-slot>

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">
                <i class="fa-solid fa-inbox mr-2"></i> Inbox
            </h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Desktop Table -->
        <div class="hidden lg:block bg-white dark:bg-[#161b22] shadow-sm rounded-lg border border-slate-200 dark:border-slate-800 overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800">
                <thead class="bg-slate-50 dark:bg-[#0d1117]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-[#161b22] divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse ($submissions as $submission)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors {{ !$submission->is_read ? 'bg-blue-50/50 dark:bg-blue-900/10' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!$submission->is_read)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">New</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-200">Read</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">{{ $submission->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $submission->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">{{ $submission->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.contact-submissions.show', $submission) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">View</a>
                                <form action="{{ route('admin.contact-submissions.destroy', $submission) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-slate-500 dark:text-slate-400">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="lg:hidden space-y-4">
            @forelse ($submissions as $submission)
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-4 shadow {{ !$submission->is_read ? 'border-blue-200 dark:border-blue-800 bg-blue-50/30 dark:bg-blue-900/10' : '' }}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-medium text-slate-900 dark:text-slate-100">{{ $submission->name }}</h3>
                                @if(!$submission->is_read)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">New</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-200">Read</span>
                                @endif
                            </div>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $submission->email }}</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">{{ $submission->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 text-sm">
                        <a href="{{ route('admin.contact-submissions.show', $submission) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                        <form action="{{ route('admin.contact-submissions.destroy', $submission) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-[#161b22] rounded-lg border border-slate-200 dark:border-slate-800 p-8 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">No messages found.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-4">
            {{ $submissions->links() }}
        </div>
    </div>
</x-admin-layout>
