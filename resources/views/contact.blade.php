<x-app-layout>
    <x-slot name="title">Contact</x-slot>

    <x-page-header title="/contact"
        description="Let's connect and discuss opportunities, collaborations, or just say hello." />

    <!--
      Wrapper: .contact-page-wrapper
      This wrapper centers the card and provides the dark backdrop.
    -->
    <div class="contact-page-wrapper">
        <div class="glass-card">


            @if (session('success'))
                <div class="success-message" role="alert" id="success-message">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('success-message');
                        if (msg) {
                            msg.classList.add('fade-out');
                            setTimeout(() => msg.remove(), 300);
                        }
                    }, 3000);
                </script>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                @csrf

                @foreach ($fields as $field)
                    <div class="form-group">
                        <label for="{{ $field['name'] }}" class="form-label">
                            {{ $field['label'] }} @if (!empty($field['required']))
                                <span class="required-mark" aria-hidden="true">*</span>
                            @endif
                        </label>

                        @if ($field['type'] === 'textarea')
                            <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-input textarea" placeholder=" "
                                {{ !empty($field['required']) ? 'required' : '' }} aria-label="{{ $field['label'] }}"></textarea>
                        @else
                            <input type="{{ $field['type'] }}" id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                class="form-input" placeholder=" " {{ !empty($field['required']) ? 'required' : '' }}
                                aria-label="{{ $field['label'] }}">
                        @endif

                        @error($field['name'])
                            <span class="error-message" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <button type="submit" class="submit-btn">
                    <span>SEND MESSAGE</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <style>
        /* Theme Variables */
        :root {
            /* Fonts */
            --font-mono: 'JetBrains Mono', monospace;

            /* Colors */
            --bg-dark: #050505;
            --accent-primary: #3b82f6;
            /* Blue 500 */
            --accent-glow: rgba(59, 130, 246, 0.5);
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --danger: #ef4444;
            --success-bg: rgba(34, 197, 94, 0.1);
            --success-text: #4ade80;

            /* Glass Card */
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.06);
            --input-bg: rgba(0, 0, 0, 0.3);

            /* Dimensions - Compact */
            --card-radius: 12px;
            --input-radius: 8px;
            --pad-section: 12px;
            --pad-input: 10px;
            --max-width: 550px;
        }

        /* Import JetBrains Mono */
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&display=swap');

        /* Layout & Reset Overrides for this component */
        .contact-page-wrapper {
            font-family: var(--font-mono);
            background-color: transparent;
            color: var(--text-main);
            width: 100%;
            max-width: 1152px;
            margin: 0 auto;
            padding: 3rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        @media (min-width: 768px) {
            .contact-page-wrapper {
                padding: 0rem 0;
            }
        }

        /* Background Ambience */
        .contact-page-wrapper::before {
            content: '';
            position: absolute;
            width: 80%;
            height: 80%;
            background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.08), transparent 70%);
            z-index: -1;
            pointer-events: none;
        }

        /* Glass Card */
        .glass-card {
            width: 100%;
            max-width: var(--max-width);
            background: transparent;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 1.5rem 1.5rem;
            /* Reduced Padding */
            animation: cardEnter 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .card-header {
            text-align: center;
            margin-bottom: 1.25rem;
            /* Reduced Margin */
        }

        .form-title {
            font-size: 1.5rem;
            /* Reduced Title */
            font-weight: 700;
            margin-bottom: 0.25rem;
            letter-spacing: -0.05em;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-subtitle {
            color: var(--text-muted);
            font-size: 0.8rem;
            /* Reduced Subtitle */
        }

        /* Form Elements */
        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            /* Reduced Gap */
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            /* Reduced Gap */
            position: relative;
        }

        .form-label {
            font-size: 0.7rem;
            /* Reduced Label */
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-left: 0.25rem;
            font-weight: 500;
        }

        .required-mark {
            color: var(--danger);
        }

        .form-input {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--input-radius);
            padding: var(--pad-input) 0.75rem;
            color: var(--text-main);
            font-family: var(--font-mono);
            font-size: 0.85rem;
            /* Reduced Input Text */
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input.textarea {
            min-height: 80px;
            /* Reduced Textarea Height */
            resize: none;
            /* Prevent resize scroll */
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            background: rgba(0, 0, 0, 0.5);
            transform: translateY(-1px);
        }

        /* Error & Success Messages */
        .error-message {
            color: var(--danger);
            font-size: 0.7rem;
            margin-left: 0.5rem;
            margin-top: 0.1rem;
        }

        .success-message {
            background: rgba(34, 197, 94, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            animation: slideInFade 0.3s ease-out;
        }

        @keyframes slideInFade {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-message.fade-out {
            animation: slideOutFade 0.3s ease-in forwards;
        }

        @keyframes slideOutFade {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        /* Submit Button */
        .submit-btn {
            margin-top: 0.5rem;
            width: 100%;
            padding: 0.8rem;
            /* Reduced Button Padding */
            border: none;
            border-radius: var(--input-radius);
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px var(--accent-glow);
            filter: brightness(1.1);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Animations */
        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsiveness */
        @media (max-width: 640px) {
            .glass-card {
                padding: 1.25rem 1rem;
            }

            .form-title {
                font-size: 1.25rem;
            }
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</x-app-layout>
