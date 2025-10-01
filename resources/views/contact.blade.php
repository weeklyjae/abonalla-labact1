@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 sm:px-6">
    {{-- Contact Section --}}
    <section class="py-16 sm:py-20">
        <div class="max-w-2xl mx-auto space-y-8">
            <div class="text-center space-y-4">
                <h1 class="text-4xl sm:text-5xl font-bold">Get In Touch</h1>
                <p class="text-lg text-neutral-600 dark:text-neutral-400">
                    Have a project in mind? Let's discuss how I can help bring your ideas to life.
                </p>
            </div>

            <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                <form action="{{ route('contact.submit') }}" method="post" class="space-y-4" id="contactForm" novalidate>
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium mb-1">Name</label>
                        <input id="name" name="name" type="text" placeholder="Your full name" value="{{ old('name') }}" class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                        <div class="mt-2 hidden rounded-md border border-red-300 bg-red-100 px-3 py-2 text-sm text-red-700" data-error-for="name"></div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email</label>
                        <input id="email" name="email" type="email" placeholder="you@example.com" value="{{ old('email') }}" class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                        <div class="mt-2 hidden rounded-md border border-red-300 bg-red-100 px-3 py-2 text-sm text-red-700" data-error-for="email"></div>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium mb-1">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Write your message..." class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('message') }}</textarea>
                        <div class="mt-2 hidden rounded-md border border-red-300 bg-red-100 px-3 py-2 text-sm text-red-700" data-error-for="message"></div>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Send Message
                        </button>
                    </div>
                </form>
                <div id="contactSuccess" class="hidden opacity-0 transition-opacity duration-500 ease-in mt-6 rounded-lg border border-green-500 bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-300">
                    Thank you for your message! I'll get back to you soon.
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20 border-t border-neutral-200/60 dark:border-neutral-800/60">
        <div class="max-w-2xl mx-auto space-y-8">
            <div class="text-center space-y-4">
                <h2 class="text-3xl sm:text-4xl font-bold">Connect With Me</h2>
                <p class="text-lg text-neutral-600 dark:text-neutral-400">
                    Follow me on social media for updates and more content
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-4">
                @if(isset($socials['github']) && $socials['github'])
                    <a href="{{ $socials['github'] }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-neutral-900 dark:bg-white text-white dark:text-neutral-900 rounded-lg hover:opacity-80 transition-opacity">
                        <span>GitHub</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                @endif
                
                @if(isset($socials['linkedin']) && $socials['linkedin'])
                    <a href="{{ $socials['linkedin'] }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <span>LinkedIn</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                @endif
                
                @if(isset($socials['instagram']) && $socials['instagram'])
                    <a href="{{ $socials['instagram'] }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg hover:opacity-80 transition-opacity">
                        <span>Instagram</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                @endif
                
                @if(isset($socials['youtube']) && $socials['youtube'])
                    <a href="{{ $socials['youtube'] }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        <span>YouTube</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('contactForm');
        const successBanner = document.getElementById('contactSuccess');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const fields = ['name', 'email', 'message'];

        const showError = (field, message) => {
            const input = document.getElementById(field);
            const errorBanner = document.querySelector(`[data-error-for="${field}"]`);

            if (!input || !errorBanner) return;

            if (message) {
                errorBanner.textContent = message;
                errorBanner.classList.remove('hidden');
                errorBanner.classList.remove('opacity-100');
                errorBanner.classList.add('opacity-0');

                requestAnimationFrame(() => {
                    errorBanner.classList.remove('opacity-0');
                    errorBanner.classList.add('opacity-100');
                });

                input.classList.add('border-red-500', 'focus:ring-red-500');
            } else {
                errorBanner.textContent = '';
                errorBanner.classList.add('hidden');
                input.classList.remove('border-red-500', 'focus:ring-red-500');
            }
        };

        const clearErrors = () => {
            fields.forEach((field) => showError(field, null));
        };

        const showSuccess = () => {
            successBanner.classList.remove('hidden');
            successBanner.classList.remove('opacity-100');
            successBanner.classList.add('opacity-0');

            requestAnimationFrame(() => {
                successBanner.classList.remove('opacity-0');
                successBanner.classList.add('opacity-100');
            });
        };

        fields.forEach((field) => {
            const input = document.getElementById(field);
            if (!input) return;

            input.addEventListener('input', () => {
                if (input.value.trim().length > 0) {
                    showError(field, null);
                }
            });
        });

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            clearErrors();
            successBanner.classList.add('hidden');

            const formData = new FormData(form);

            setTimeout(() => {
                form.reset();
                clearErrors();
                showSuccess();
            }, 600);
        });
    });
</script>
@endpush

