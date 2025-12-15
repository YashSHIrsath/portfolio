<x-admin-layout>
    <x-slot name="title">GitHub Settings</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('GitHub Integration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="mb-6 p-4 rounded-lg {{ $hasToken ? 'bg-green-50 border border-green-200' : 'bg-yellow-50 border border-yellow-200' }}">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if($hasToken)
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium {{ $hasToken ? 'text-green-800' : 'text-yellow-800' }}">
                                    {{ $hasToken ? 'Token Configured' : 'GitHub Token Missing' }}
                                </h3>
                                <div class="mt-2 text-sm {{ $hasToken ? 'text-green-700' : 'text-yellow-700' }}">
                                    <p>
                                        @if($hasToken)
                                            Your <code>GITHUB_TOKEN</code> is correctly set in the <code>.env</code> file.
                                        @else
                                            Please add <code>GITHUB_TOKEN=your_token_here</code> to your <code>.env</code> file to enable API access.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.github-settings.update') }}" method="POST" class="max-w-xl mb-8">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="github_username" class="block text-sm font-medium text-gray-700">GitHub Username</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    github.com/
                                </span>
                                <input type="text" name="github_username" id="github_username" value="{{ old('github_username', $username) }}"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                    placeholder="your-username">
                            </div>
                            <p class="mt-2 text-sm text-gray-500">The username to fetch repositories for.</p>
                            @error('github_username')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                                Save Settings
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('admin.github-settings.sync') }}" method="POST" class="max-w-xl mb-8">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                            Sync Repositories
                        </button>
                    </form>

                    @if($repositories && $repositories->count() > 0)
                        <div class="mt-8">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-blue-800">
                                            {{ $repositories->count() }} Repositories Synced
                                        </h3>
                                        <div class="mt-2 text-sm text-blue-700">
                                            <p>
                                                Your GitHub repositories have been synced successfully. 
                                                <a href="{{ route('admin.github-projects.index') }}" class="font-medium underline hover:text-blue-600">
                                                    Manage repository images and live links here
                                                </a>.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
