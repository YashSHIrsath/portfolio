<x-admin-layout>
    <x-slot name="title">Add Bio</x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Add Bio</h1>
            <a href="{{ route('admin.bios.index') }}"
                class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.bios.store') }}" method="POST" id="bioForm">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Bio
                            Content</label>
                        <p class="text-xs text-slate-500 mb-2">This text will be displayed in the "whoami" section of
                            the About page.</p>
                        <textarea name="content" id="content" rows="10"
                            class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="I am a developer..." required></textarea>

                        <!-- Live Preview -->
                        <div
                            class="mt-4 p-4 bg-slate-50 dark:bg-[#0d1117] rounded-md border border-slate-200 dark:border-slate-700">
                            <p class="text-xs text-slate-600 dark:text-slate-400 mb-2 font-medium">Preview (how it will
                                look):</p>
                            <div id="preview"
                                class="bg-gradient-to-r from-slate-700/30 to-transparent border-l-4 border-green-500 pl-5 py-4 rounded-r-lg">
                                <p
                                    class="text-green-400 text-sm leading-relaxed whitespace-pre-wrap break-words font-mono">
                                    {{ $bio->content ?? 'I am a developer...' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center pt-2">
                        <input type="checkbox" name="is_active" id="is_active"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded"
                            value="1" checked>
                        <label for="is_active" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                            Active
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Save Bio
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const textarea = document.getElementById('content');
        const preview = document.getElementById('preview').querySelector('p');

        // Update preview as user types
        textarea.addEventListener('input', function() {
            const lines = this.value.split('\n');
            const trimmedLines = lines.map(line => line.trimStart());
            preview.textContent = trimmedLines.join('\n') || 'I am a developer...';
        });

        // Trim before form submission
        document.getElementById('bioForm').addEventListener('submit', function(e) {
            const lines = textarea.value.split('\n');
            const trimmedLines = lines.map(line => line.trimStart());
            textarea.value = trimmedLines.join('\n');
        });
    </script>
</x-admin-layout>
