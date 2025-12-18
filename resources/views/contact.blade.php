<x-app-layout>
    <x-slot name="title">Contact</x-slot>

    <x-page-header title="/contact"
        description="Let's connect and discuss opportunities, collaborations, or just say hello." />

    <!-- Contact Section -->
    <div class="relative pt-16 pb-24 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            <!-- Success Message -->
            @if (session('success'))
                <div class="fixed top-8 right-8 z-50 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg animate-bounce"
                    role="alert" id="success-message">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-check"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('success-message');
                        if (msg) {
                            msg.style.transform = 'translateX(400px)';
                            msg.style.opacity = '0';
                            setTimeout(() => msg.remove(), 300);
                        }
                    }, 5000);
                </script>
            @endif

            <!-- Main Contact Container -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

                <!-- Left Side - Contact Info -->
                <div class="space-y-12 contact-info">
                    <!-- Header -->
                    <div class="space-y-6">
                        <div
                            class="inline-flex items-center gap-3 px-4 py-2 bg-slate-100 dark:bg-slate-800 rounded-full">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-slate-700 dark:text-slate-300 font-medium text-sm">Available for
                                opportunities</span>
                        </div>

                        <h1 class="text-4xl lg:text-5xl font-black text-slate-900 dark:text-white leading-tight">
                            Let's work
                            <span class="text-slate-600 dark:text-slate-400">together</span>
                        </h1>

                        <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                            {{ \App\Models\Setting::where('key', 'contact_description')->value('value') ?? 'Ready to bring your vision to life? Let\'s connect and create something amazing.' }}
                        </p>
                    </div>

                    <!-- Contact Methods -->
                    @php
                        $contactInfos = \App\Models\ContactInfo::where('active', true)->orderBy('sort_order')->get();
                    @endphp

                    <div class="space-y-4">
                        @forelse($contactInfos as $contact)
                            <div class="contact-item group">
                                @if ($contact->type === 'email' || $contact->link)
                                    <a href="#" {{ $contact->type !== 'email' ? 'target="_blank"' : '' }}
                                        class="flex items-center gap-4 p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 transition-all duration-300 hover:shadow-lg">
                                    @else
                                        <div
                                            class="flex items-center gap-4 p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                                @endif
                                <div
                                    class="w-12 h-12 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center justify-center group-hover:bg-slate-200 dark:group-hover:bg-slate-600 transition-colors duration-300">
                                    <i
                                        class="{{ $contact->icon_class }} text-slate-600 dark:text-slate-400 text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-900 dark:text-white">{{ $contact->label }}</p>
                                    <p class="text-slate-600 dark:text-slate-400 text-sm">{{ $contact->value }}</p>
                                </div>

                                @if ($contact->type === 'email' || $contact->link)
                                    </a>
                                @else
                            </div>
                        @endif
                    </div>
                @empty
                    <div
                        class="flex items-center gap-4 p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                        <div
                            class="w-12 h-12 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-envelope text-slate-600 dark:text-slate-400 text-lg"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-white">Email</p>
                            <p class="text-slate-600 dark:text-slate-400 text-sm">contact@example.com</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Side - Contact Form -->
            <div class="contact-form">
                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-8 shadow-xl">
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        @foreach ($fields as $field)
                            <div class="form-group">
                                <label for="{{ $field['name'] }}"
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    {{ $field['label'] }}
                                    @if (!empty($field['required']))
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>

                                @if ($field['type'] === 'textarea')
                                    <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                        class="form-input w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300 resize-none h-32"
                                        placeholder="Your message..." {{ !empty($field['required']) ? 'required' : '' }}></textarea>
                                @else
                                    <input type="{{ $field['type'] }}" id="{{ $field['name'] }}"
                                        name="{{ $field['name'] }}"
                                        class="form-input w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300"
                                        placeholder="Enter your {{ strtolower($field['label']) }}..."
                                        {{ !empty($field['required']) ? 'required' : '' }}>
                                @endif

                                @error($field['name'])
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-2">
                                        <i class="fa-solid fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        @endforeach

                        <button type="submit"
                            class="submit-btn w-full bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-semibold py-4 px-6 rounded-lg hover:bg-slate-800 dark:hover:bg-slate-100 transition-all duration-300 flex items-center justify-center gap-3 group">
                            <span>Send Message</span>
                            <i
                                class="fa-solid fa-paper-plane group-hover:translate-x-1 transition-transform duration-300"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <style>
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-info {
            animation: slideInLeft 0.8s ease-out;
        }

        .contact-form {
            animation: slideInRight 0.8s ease-out;
        }

        .contact-item {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .contact-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .contact-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .contact-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .contact-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-group {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.2s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(5) {
            animation-delay: 0.4s;
        }

        .submit-btn {
            animation: fadeInUp 0.6s ease-out 0.5s;
            animation-fill-mode: both;
        }

        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
    </style>
</x-app-layout>
