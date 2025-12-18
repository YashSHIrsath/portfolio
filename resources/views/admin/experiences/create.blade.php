<x-admin-layout>
    <x-slot name="title">Add Experience</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Add Experience</h1>
            <a href="{{ route('admin.experiences.index') }}" class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                &larr; Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-[#161b22] shadow rounded-lg p-6 border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.experiences.store') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label for="position" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Position</label>
                        <input type="text" name="position" id="position" class="mt-1 block w-full px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="e.g. Senior Developer" required>
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Company</label>
                        <input type="text" name="company" id="company" class="mt-1 block w-full px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="e.g. Google">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Start Date</label>
                            <div class="grid grid-cols-3 gap-2">
                                <select name="start_day" id="start_day" class="px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="">Day</option>
                                    @for($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="start_month" id="start_month" class="px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="">Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <select name="start_year" id="start_year" class="px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="">Year</option>
                                    @for($i = date('Y'); $i >= 1990; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">End Date</label>
                            <div class="grid grid-cols-3 gap-2">
                                <select name="end_day" id="end_day" class="px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Day</option>
                                    @for($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="end_month" id="end_month" class="px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <select name="end_year" id="end_year" class="px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Year</option>
                                    @for($i = date('Y'); $i >= 1990; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Leave empty if currently working</p>
                        </div>
                    </div>
                    <input type="hidden" name="start_date" id="start_date">
                    <input type="hidden" name="end_date" id="end_date">
                    <input type="hidden" name="duration" id="duration">

                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Brief description of your role..."></textarea>
                    </div>

                    <div>
                        <label for="github_repos" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Linked GitHub Repositories</label>
                        <div class="mt-1 max-h-48 overflow-y-auto border border-slate-300 dark:border-slate-700 rounded-md p-2 dark:bg-[#0d1117]">
                            @if(count($githubRepos) > 0)
                                @foreach($githubRepos as $repo)
                                    <div class="flex items-center gap-2 mb-2 p-1 hover:bg-slate-50 dark:hover:bg-slate-800 rounded">
                                        <input type="checkbox" name="github_repos[]" id="repo_{{ $repo['name'] }}" value="{{ json_encode($repo) }}" 
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded">
                                        <label for="repo_{{ $repo['name'] }}" class="flex-1 text-sm text-slate-700 dark:text-slate-300 cursor-pointer grid grid-cols-[1fr,auto]">
                                            <span class="font-medium font-mono">{{ $repo['name'] }}</span>
                                            <span class="text-xs text-slate-500">{{ $repo['language'] ?? 'N/A' }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-xs text-slate-500 p-2">No GitHub repos available. configure API first.</p>
                            @endif
                        </div>
                        <p class="mt-1 text-xs text-slate-500">Select repositories relevant to this experience.</p>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="sort_order" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="mt-1 block w-full px-3 py-2 rounded-md border-slate-300 dark:border-slate-700 dark:bg-[#0d1117] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="0">
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
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Save Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDay = document.getElementById('start_day');
            const startMonth = document.getElementById('start_month');
            const startYear = document.getElementById('start_year');
            const endDay = document.getElementById('end_day');
            const endMonth = document.getElementById('end_month');
            const endYear = document.getElementById('end_year');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const durationInput = document.getElementById('duration');
            
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            
            function updateDates() {
                // Update start_date hidden input
                if (startDay.value && startMonth.value && startYear.value) {
                    const startDate = `${startYear.value}-${startMonth.value.padStart(2, '0')}-${startDay.value.padStart(2, '0')}`;
                    startDateInput.value = startDate;
                } else {
                    startDateInput.value = '';
                }
                
                // Update end_date hidden input
                if (endDay.value && endMonth.value && endYear.value) {
                    const endDate = `${endYear.value}-${endMonth.value.padStart(2, '0')}-${endDay.value.padStart(2, '0')}`;
                    endDateInput.value = endDate;
                } else {
                    endDateInput.value = '';
                }
                
                updateDuration();
                validateDates();
            }
            
            function updateDuration() {
                if (startDay.value && startMonth.value && startYear.value) {
                    const startFormatted = `${months[parseInt(startMonth.value) - 1]} ${startYear.value}`;
                    
                    if (endDay.value && endMonth.value && endYear.value) {
                        const endFormatted = `${months[parseInt(endMonth.value) - 1]} ${endYear.value}`;
                        durationInput.value = startFormatted + ' - ' + endFormatted;
                    } else {
                        durationInput.value = startFormatted + ' - Present';
                    }
                }
            }
            
            function validateDates() {
                if (startDateInput.value && endDateInput.value) {
                    const startDate = new Date(startDateInput.value);
                    const endDate = new Date(endDateInput.value);
                    
                    if (startDate >= endDate) {
                        endYear.setCustomValidity('End date must be after start date');
                    } else {
                        endYear.setCustomValidity('');
                    }
                } else {
                    endYear.setCustomValidity('');
                }
            }
            
            // Add event listeners to all dropdowns
            [startDay, startMonth, startYear, endDay, endMonth, endYear].forEach(element => {
                element.addEventListener('change', updateDates);
            });
        });
    </script>
</x-admin-layout>
