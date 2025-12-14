<x-admin-layout>
    <x-slot name="title">Add Project</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Add Project</h1>
            <a href="{{ route('admin.projects.index') }}" class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label for="experience_ids" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Linked Experiences (Optional)</label>
                        <select name="experience_ids[]" id="experience_ids" multiple class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm h-32">
                            @foreach($experiences as $exp)
                                <option value="{{ $exp->id }}">{{ $exp->position }} at {{ $exp->company }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Hold Ctrl/Cmd to select multiple.</p>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Title</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="e.g. Portfolio V2" required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Brief description of the project..." required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">Work Done</label>
                        <div id="work-done-container" class="space-y-2">
                            <div class="work-done-item flex gap-2">
                                <input type="text" name="work_done[]" class="flex-1 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter work accomplished...">
                                <button type="button" onclick="removeWorkItem(this)" class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" onclick="addWorkItem()" class="mt-3 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium">
                            <i class="fa-solid fa-plus mr-2"></i>Add Work Item
                        </button>
                    </div>

                    <script>
                        function addWorkItem() {
                            const container = document.getElementById('work-done-container');
                            const newItem = document.createElement('div');
                            newItem.className = 'work-done-item flex gap-2';
                            newItem.innerHTML = `
                                <input type="text" name="work_done[]" class="flex-1 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter work accomplished...">
                                <button type="button" onclick="removeWorkItem(this)" class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            `;
                            container.appendChild(newItem);
                        }

                        function removeWorkItem(button) {
                            const container = document.getElementById('work-done-container');
                            if (container.children.length > 1) {
                                button.parentElement.remove();
                            }
                        }
                    </script>

                    <div>
                        <label for="bullet_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Bullet Point Style</label>
                        <select name="bullet_type" id="bullet_type" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="circle">● Circle</option>
                            <option value="square">■ Square</option>
                            <option value="arrow">→ Arrow</option>
                            <option value="check">✓ Check</option>
                            <option value="star">★ Star</option>
                        </select>
                    </div>

                    <div>
                        <label for="link" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Link</label>
                        <input type="url" name="link" id="link" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="https://example.com">
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Duration (e.g. "3 months", "Jan 2023 - Mar 2023")</label>
                        <input type="text" name="duration" id="duration" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Main Project Image</label>
                        <input type="file" name="image" id="image" class="mt-1 block w-full text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div>
                        <label for="images" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Additional Images (for carousel)</label>
                        <input type="file" name="images[]" id="images" multiple class="mt-1 block w-full text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Select multiple images for the project carousel.</p>
                    </div>

                    <div>
                        <label for="tech_stack" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tech Stack (comma separated)</label>
                        <input type="text" name="tech_stack" id="tech_stack" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="e.g. Laravel, Tailwind CSS, Vue.js">
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="sort_order" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="0">
                        </div>
                        <div class="flex items-center pt-6">
                            <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded" value="1" checked>
                            <label for="is_active" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Save Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
