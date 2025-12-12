<x-admin-layout>
    <x-slot name="title">View Message</x-slot>

    <div class="max-w-3xl mx-auto py-8">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.contact-submissions.index') }}" class="flex items-center text-sm text-slate-500 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition-colors">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Inbox
            </a>
            
            <form action="{{ route('admin.contact-submissions.destroy', $contactSubmission) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center text-sm text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 dark:bg-red-900/10 dark:hover:bg-red-900/20 px-3 py-1.5 rounded-md transition-colors">
                    <i class="fa-solid fa-trash mr-2"></i> Delete Message
                </button>
            </form>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg border border-slate-200 dark:border-slate-800 overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 bg-slate-50 dark:bg-[#0d1117] border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-bold text-slate-900 dark:text-white">{{ $contactSubmission->name }}</h1>
                    <a href="mailto:{{ $contactSubmission->email }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">{{ $contactSubmission->email }}</a>
                </div>
                <div class="text-right text-xs text-slate-500 dark:text-slate-400">
                    <p>{{ $contactSubmission->created_at->format('F d, Y') }}</p>
                    <p>{{ $contactSubmission->created_at->format('H:i') }}</p>
                </div>
            </div>

            <!-- Body -->
            <div class="p-6">
                 <!-- Main Message -->
                <div class="mb-8">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Message</h3>
                    <div class="prose dark:prose-invert max-w-none bg-slate-50 dark:bg-white/5 p-4 rounded-lg">
                        <p class="whitespace-pre-wrap text-sm">{{ $contactSubmission->message }}</p>
                    </div>
                </div>

                <!-- Dynamic Payload -->
                @if(!empty($contactSubmission->payload))
                    <div class="mb-8">
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Additional Details</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                            @foreach($contactSubmission->payload as $key => $value)
                                <div>
                                    <dt class="text-xs font-medium text-slate-500 mb-1">{{ ucfirst(str_replace('_', ' ', $key)) }}</dt>
                                    <dd class="text-sm text-slate-900 dark:text-white bg-slate-50 dark:bg-white/5 px-3 py-2 rounded border border-slate-100 dark:border-white/5">
                                        {{ $value }}
                                    </dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endif
                
                <hr class="border-slate-100 dark:border-slate-800 my-6">

                <!-- Metadata -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-slate-500 dark:text-slate-400">
                    <div>
                        <span class="font-medium text-slate-700 dark:text-slate-300">IP Address:</span>
                        {{ $contactSubmission->ip_address ?? 'N/A' }}
                    </div>
                    <div>
                        <span class="font-medium text-slate-700 dark:text-slate-300">User Agent:</span>
                        <div class="truncate" title="{{ $contactSubmission->user_agent }}">
                            {{ $contactSubmission->user_agent ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
