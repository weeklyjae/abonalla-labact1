<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100">
    <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="hover:opacity-80">
                <img src="{{ asset('images/logo.png') }}" alt="weeklyjae Logo" class="h-8 w-auto" id="logoImage" style="filter: invert(1);">
            </a>
            <nav class="hidden sm:flex items-center gap-6 text-sm">
                <a href="{{ route('coding') }}" class="hover:opacity-80 transition-opacity">Coding</a>
                <a href="{{ route('editing') }}" class="hover:opacity-80 transition-opacity">Editing</a>
                <a href="{{ route('travel') }}" class="hover:opacity-80 transition-opacity">Travel</a>
                <a href="{{ route('contact') }}" class="hover:opacity-80 transition-opacity">Contact</a>
                
                {{-- Authentication Buttons --}}
                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">Login</a>
                @else
                                            <a href="{{ route('admin.home') }}" class="text-blue-600 dark:text-blue-400 hover:opacity-80 transition-opacity">Admin</a>
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
                <a href="{{ route('coding') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Coding</a>
                <a href="{{ route('editing') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Editing</a>
                <a href="{{ route('travel') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Travel</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 text-base font-medium text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Contact</a>
                
                {{-- Mobile Authentication Buttons --}}
                @guest
                    <div class="pt-4 border-t border-neutral-200/60 dark:border-neutral-800/60">
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors">Login</a>
                    </div>
                @else
                    <div class="pt-4 border-t border-neutral-200/60 dark:border-neutral-800/60">
                        <a href="{{ route('admin.home') }}" class="block px-3 py-2 text-base font-medium text-blue-600 dark:text-blue-400 hover:bg-neutral-800 rounded-md transition-colors">Admin</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-base font-medium text-red-600 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-md transition-colors">Logout</button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-neutral-200/60 dark:border-neutral-800/60 py-8 mt-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 text-center text-sm text-neutral-600 dark:text-neutral-400">
            <p>&copy; {{ date('Y') }} Jhon Martin Abonalla (weeklyjae). All rights reserved.</p>
        </div>
    </footer>

    <script>
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
