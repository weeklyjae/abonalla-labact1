<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" x-data>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'weeklyjae Portfolio') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Theme Script (must be before other scripts) -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>[x-cloak]{display:none!important;}</style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $isAdminSection = request()->routeIs('admin.*');
    $isAdminUser = Auth::check() && Auth::user()->role === 'admin';
@endphp
<body class="font-sans antialiased text-neutral-900 dark:text-neutral-100 {{ $isAdminSection ? 'bg-gradient-to-br from-blue-50 via-white to-sky-100' : 'bg-white dark:bg-neutral-950' }}" x-data="toastComponent()" @notify.window="show($event.detail)" x-init="init($refs.toastTitle, $refs.toastMessage)">
    @if($isAdminSection)
        <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-40 -left-24 h-[28rem] w-[28rem] rounded-full bg-blue-200/60 blur-3xl"></div>
            <div class="absolute top-1/3 right-0 h-[32rem] w-[32rem] translate-x-1/4 rounded-full bg-indigo-200/40 blur-[140px]"></div>
            <div class="absolute bottom-[-10rem] left-1/2 h-[30rem] w-[30rem] -translate-x-1/2 rounded-full bg-sky-200/40 blur-[160px]"></div>
        </div>
    @endif
    <header class="fixed top-0 left-0 right-0 z-[80] transition-all duration-300" id="navbar">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="hover:opacity-80">
                <img src="{{ asset('images/logo.png') }}" alt="weeklyjae Logo" class="h-8 w-auto" id="logoImage" style="filter: invert(1);">
            </a>
            <nav class="hidden sm:flex items-center gap-6 text-sm">
                @if($isAdminSection && $isAdminUser)
                    <a href="{{ route('home') }}" class="hover:opacity-80 transition-opacity font-medium">Home</a>
                    <a href="{{ route('admin.dashboard') }}" class="hover:opacity-80 transition-opacity font-medium {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 dark:text-blue-400' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.site-settings') }}" class="hover:opacity-80 transition-opacity">Site Settings</a>
                    <a href="{{ route('admin.contact-messages.index') }}" class="hover:opacity-80 transition-opacity">Contact Messages</a>
                @else
                    <a href="{{ route('coding') }}" class="hover:opacity-80 transition-opacity">Coding</a>
                    <a href="{{ route('editing') }}" class="hover:opacity-80 transition-opacity">Editing</a>
                    <a href="{{ route('travel') }}" class="hover:opacity-80 transition-opacity">Travel</a>
                    <a href="{{ route('contact') }}" class="hover:opacity-80 transition-opacity">Contact</a>
                @endif

                {{-- Authentication Buttons --}}
                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">Login</a>
                @else
                    @if($isAdminUser && !$isAdminSection)
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 dark:text-blue-400 hover:opacity-80 transition-opacity">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-red-600 border border-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200">Logout</button>
                    </form>
                @endguest

                <button id="themeToggle" class="p-2 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                    <svg id="sunIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg id="moonIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9 9 0 0012 21a9 9 0 009-9 9 9 0 00-1.646-5.646z"></path>
                    </svg>
                </button>
            </nav>
            
            {{-- Mobile Menu Toggle Button --}}
            <button id="mobileMenuToggle" class="sm:hidden p-2 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                <svg id="mobileMenuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        </div>
        
        {{-- Mobile Navigation Menu --}}
        <div class="sm:hidden" id="mobileMenu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white/95 dark:bg-neutral-950/95 backdrop-blur-md border-t border-neutral-200/60 dark:border-neutral-800/60">
                @if($isAdminSection && $isAdminUser)
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Home</a>
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 dark:text-blue-400' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.site-settings') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Site Settings</a>
                    <a href="{{ route('admin.contact-messages.index') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Contact Messages</a>
                @else
                    <a href="{{ route('coding') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Coding</a>
                    <a href="{{ route('editing') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Editing</a>
                    <a href="{{ route('travel') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Travel</a>
                    <a href="{{ route('contact') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Contact</a>
                @endif

                {{-- Mobile Authentication Buttons --}}
                @guest
                    <div class="pt-4 border-t border-neutral-200/60 dark:border-neutral-800/60">
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors">Login</a>
                    </div>
                @else
                    <div class="pt-4 border-t border-neutral-200/60 dark:border-neutral-800/60">
                        @if($isAdminUser && !$isAdminSection)
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-base font-medium text-blue-600 dark:text-blue-400 hover:bg-neutral-800 rounded-md transition-colors">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-base font-medium text-red-600 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Logout</button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <main class="{{ request()->routeIs('home') ? '' : 'pt-16 sm:pt-20' }}">
        @if (session('success'))
            <span x-init="$dispatch('notify', { title: 'Success', message: '{{ session('success') }}' })"></span>
        @endif
        @yield('content')
    </main>

    <footer class="border-t border-neutral-200/60 dark:border-neutral-800/60 py-8 mt-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 text-center text-sm text-neutral-600 dark:text-neutral-400">
            <p>&copy; {{ date('Y') }} Jhon Martin Abonalla (weeklyjae). All rights reserved.</p>
        </div>
    </footer>

    <div class="fixed top-4 right-4 z-[100] pointer-events-none flex flex-col items-end space-y-3">
        <div x-show="visible" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="w-full max-w-xs" x-cloak>
            <div class="pointer-events-auto rounded-xl border border-emerald-200/60 dark:border-emerald-500/40 bg-white dark:bg-emerald-950/80 shadow-2xl shadow-emerald-600/20 backdrop-blur-sm">
                <div class="flex items-start gap-3 px-5 py-4">
                    <div class="mt-0.5 inline-flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 00-1.408-1.42l-6.5 6.444-2.093-2.05a1 1 0 00-1.406 1.422l2.796 2.738a1 1 0 001.406 0l7.205-7.134z" clip-rule="evenodd" />
                            <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-200" x-ref="toastTitle"></p>
                        <p class="mt-1 text-sm text-emerald-600/90 dark:text-emerald-200/90" x-ref="toastMessage"></p>
                    </div>
                    <button type="button" class="text-emerald-500 hover:text-emerald-600 dark:text-emerald-200/80 dark:hover:text-emerald-100 transition" @click="hide()" aria-label="Dismiss notification">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('toastComponent', () => ({
                visible: false,
                timeoutId: null,
                titleEl: null,
                messageEl: null,
                init(titleEl, messageEl) {
                    this.titleEl = titleEl;
                    this.messageEl = messageEl;
                },
                show({ title = 'Success', message = 'Action completed successfully.' } = {}) {
                    if (this.timeoutId) {
                        clearTimeout(this.timeoutId);
                    }
                    if (this.titleEl) this.titleEl.textContent = title;
                    if (this.messageEl) this.messageEl.textContent = message;
                    this.visible = true;
                    this.timeoutId = setTimeout(() => this.hide(), 3500);
                },
                hide() {
                    this.visible = false;
                    if (this.timeoutId) {
                        clearTimeout(this.timeoutId);
                        this.timeoutId = null;
                    }
                }
            }));
        });

        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        const logoImage = document.getElementById('logoImage');

        function updateTheme() {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                document.documentElement.classList.remove('dark');
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
            
            // Logo color is now handled by updateNavbar function
            // to ensure it matches the navbar state
        }

        themeToggle.addEventListener('click', () => {
            if (localStorage.theme === 'dark') {
                localStorage.theme = 'light';
            } else {
                localStorage.theme = 'dark';
            }
            updateTheme();
        });

        // Navbar transparency logic
        function updateNavbar() {
            const navbar = document.getElementById('navbar');
            const scrollY = window.scrollY;
            const isWelcomePage = window.location.pathname === '/';
            
            if (scrollY > 100) {
                // Scrolled down - make navbar solid white/dark
                navbar.classList.remove('bg-transparent', 'backdrop-blur-none');
                navbar.classList.add('bg-white/95', 'dark:bg-neutral-950/95', 'backdrop-blur-md', 'border-b', 'border-neutral-200/60', 'dark:border-neutral-800/60');
                navbar.classList.remove('text-white');
                navbar.classList.add('text-neutral-900', 'dark:text-neutral-100');
                
                // Logo should be black when navbar is solid
                logoImage.style.filter = 'invert(1)';
            } else {
                // At top - check if it's welcome page
                if (isWelcomePage) {
                    // Welcome page - make navbar transparent with white text
                    navbar.classList.remove('bg-white/95', 'dark:bg-neutral-950/95', 'backdrop-blur-md', 'border-b', 'border-neutral-200/60', 'dark:border-neutral-800/60');
                    navbar.classList.add('bg-transparent', 'backdrop-blur-none');
                    navbar.classList.remove('text-neutral-900', 'dark:text-neutral-100');
                    navbar.classList.add('text-white');
                    
                    // Logo should be white when navbar is transparent
                    logoImage.style.filter = 'none';
                } else {
                    // Other pages - make navbar solid with black text from the start
                    navbar.classList.remove('bg-transparent', 'backdrop-blur-none');
                    navbar.classList.add('bg-white/95', 'dark:bg-neutral-950/95', 'backdrop-blur-md', 'border-b', 'border-neutral-200/60', 'dark:border-neutral-800/60');
                    navbar.classList.remove('text-white');
                    navbar.classList.add('text-neutral-900', 'dark:text-neutral-100');
                    
                    // Logo should be black for other pages
                    logoImage.style.filter = 'invert(1)';
                }
            }
            
            // Update mobile menu background to match navbar
            const mobileMenu = document.getElementById('mobileMenu');
            if (mobileMenu) {
                if (scrollY > 100) {
                    mobileMenu.classList.remove('bg-white/95', 'dark:bg-neutral-950/95');
                    mobileMenu.classList.add('bg-white', 'dark:bg-neutral-950');
                } else {
                    if (isWelcomePage) {
                        mobileMenu.classList.remove('bg-white', 'dark:bg-neutral-950');
                        mobileMenu.classList.add('bg-white/95', 'dark:bg-neutral-950/95');
                    } else {
                        mobileMenu.classList.remove('bg-white/95', 'dark:bg-neutral-950/95');
                        mobileMenu.classList.add('bg-white', 'dark:bg-neutral-950');
                    }
                }
            }
        }

        // Initial navbar state
        updateNavbar();
        
        // Update navbar on scroll
        window.addEventListener('scroll', updateNavbar);
        
        // Update navbar on page load
        window.addEventListener('load', updateNavbar);
        
        // Update navbar when page changes (for SPA-like behavior)
        window.addEventListener('popstate', updateNavbar);

        // Initialize theme
        updateTheme();
        
        // Mobile menu functionality
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuIcon = document.getElementById('mobileMenuIcon');
        
        // Initially hide mobile menu
        mobileMenu.style.display = 'none';
        
        mobileMenuToggle.addEventListener('click', () => {
            if (mobileMenu.style.display === 'none') {
                mobileMenu.style.display = 'block';
                // Change icon to close (X)
                mobileMenuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            } else {
                mobileMenu.style.display = 'none';
                // Change icon back to hamburger
                mobileMenuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.style.display = 'none';
                mobileMenuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
            }
        });
    </script>
</body>
</html>
