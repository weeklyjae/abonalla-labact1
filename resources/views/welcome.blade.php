<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Abonalla · Portfolio</title>

    {{-- 0) Apply saved theme ASAP (no white flash) --}}
    <script>
      (() => {
        const t = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        document.documentElement.classList.toggle('dark', t ? t === 'dark' : prefersDark);
      })();
    </script>

    {{-- 1) Font: Poppins --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600&display=swap" rel="stylesheet" />

    {{-- 2) Styles/Scripts --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans bg-white text-neutral-900 dark:bg-neutral-950 dark:text-neutral-100">
    {{-- HEADER / NAV --}}
    <header class="border-b border-neutral-200/60 dark:border-neutral-800/60">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-sm tracking-widest font-semibold">
                ABONALLA <span class="opacity-50">·</span> <span class="opacity-70">Portfolio</span>
            </a>

            <nav class="hidden sm:flex items-center gap-6 text-sm">
                <a href="#projects" class="hover:opacity-80">Projects</a>
                <a href="#about" class="hover:opacity-80">About</a>
                <a href="#contact" class="hover:opacity-80">Contact</a>

                {{-- Theme toggle --}}
                <button id="themeToggle"
                        type="button"
                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-neutral-200/60 dark:border-neutral-800/60 hover:bg-neutral-100 dark:hover:bg-neutral-900 transition"
                        aria-label="Toggle theme">
                    {{-- Moon (light mode) --}}
                    <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="currentColor"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    {{-- Sun (dark mode) --}}
                    <svg class="h-4 w-4 hidden dark:block" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4a1 1 0 0 1 1-1h0a1 1 0 1 1-2 0h0a1 1 0 0 1 1 1zm0 17a1 1 0 0 1 1-1h0a1 1 0 1 1-2 0h0a1 1 0 0 1 1 1zm8-9a1 1 0 0 1-1-1h0a1 1 0 1 1 2 0h0a1 1 0 0 1-1 1zM5 12a1 1 0 0 1-1-1h0a1 1 0 1 1 2 0h0a1 1 0 0 1-1 1zM17.31 18.31a1 1 0 0 1 1.41 0h0a1 1 0 1 1-1.41 1.41h0a1 1 0 0 1 0-1.41zM6.28 6.28a1 1 0 0 1 1.41 0h0A1 1 0 1 1 6.28 4.87h0a1 1 0 0 1 0 1.41zM17.72 6.28a1 1 0 0 1 0 1.41h0A1 1 0 1 1 16.31 4.87h0a1 1 0 0 1 1.41 0zM6.28 17.72a1 1 0 0 1 0 1.41h0A1 1 0 1 1 4.87 17.72h0a1 1 0 0 1 1.41 0z"/></svg>
                </button>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 sm:px-6">
        {{-- HERO --}}
        <section class="py-10 sm:py-14">
            <div class="rounded-2xl border border-neutral-200/60 bg-neutral-50/60 p-6 sm:p-8 dark:bg-neutral-900/60 dark:border-neutral-800/60">
                <div class="flex items-start gap-4">
                    <div class="h-12 w-12 shrink-0 rounded-full bg-neutral-200 dark:bg-neutral-800 grid place-items-center">
                        <span class="text-xs">👨‍💻</span>
                    </div>
                    <div class="space-y-2">
                        <h1 class="text-xl sm:text-2xl font-semibold">Hi, I’m Abonalla — Laravel & Tailwind dev.</h1>
                        <p class="text-sm leading-relaxed text-neutral-600 dark:text-neutral-400">
                            I build clean, fast web apps and dashboards for small businesses.
                            Here are a few projects and a bit about me.
                        </p>
                        <div class="flex gap-3 pt-2">
                            <a href="#projects" class="px-4 py-2 rounded-md border border-neutral-200/70 bg-white hover:bg-neutral-100 dark:bg-neutral-950 dark:border-neutral-800/70 dark:hover:bg-neutral-900 text-sm">See Projects</a>
                            <a href="#contact" class="px-4 py-2 rounded-md bg-neutral-900 text-white dark:bg-white dark:text-neutral-900 text-sm">Hire Me</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PROJECTS --}}
        <section id="projects" class="py-6 sm:py-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold tracking-wide uppercase text-neutral-500 dark:text-neutral-400">Projects</h2>
                <a href="#contact" class="text-sm hover:opacity-75">Let’s work together</a>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Card --}}
                <article class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                    <img class="h-36 w-full object-cover" src="https://images.unsplash.com/photo-1556157382-97eda2d62296?q=80&w=1200&auto=format&fit=crop" alt="">
                    <div class="p-4 space-y-2">
                        <h3 class="font-medium">Retail POS (Laravel + Livewire)</h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Inventory, receipts, daily reports for a local shop.</p>
                        <div class="flex flex-wrap gap-2 pt-1">
                            <span class="text-[11px] px-2 py-0.5 rounded border border-neutral-200/70 dark:border-neutral-700/80">Laravel</span>
                            <span class="text-[11px] px-2 py-0.5 rounded border border-neutral-200/70 dark:border-neutral-700/80">Livewire</span>
                            <span class="text-[11px] px-2 py-0.5 rounded border border-neutral-200/70 dark:border-neutral-700/80">Tailwind</span>
                        </div>
                    </div>
                </article>

                <article class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                    <img class="h-36 w-full object-cover" src="https://images.unsplash.com/photo-1526103424300-68a3e33b2b72?q=80&w=1200&auto=format&fit=crop" alt="">
                    <div class="p-4 space-y-2">
                        <h3 class="font-medium">Agency Landing</h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Responsive site with dark mode, blog, and contact form.</p>
                        <div class="flex flex-wrap gap-2 pt-1">
                            <span class="text-[11px] px-2 py-0.5 rounded border border-neutral-200/70 dark:border-neutral-700/80">Blade</span>
                            <span class="text-[11px] px-2 py-0.5 rounded border border-neutral-200/70 dark:border-neutral-700/80">Alpine</span>
                            <span class="text-[11px] px-2 py-0.5 rounded border border-neutral-200/70 dark:border-neutral-700/80">Tailwind</span>
                        </div>
                    </div>
                </article>

                <article class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                    <img class="h-36 w-full object-cover" src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200&auto=format&fit=crop" alt="">
                    <div class="p-4 space-y-2">
                        <h3 class="font-medium">Restaurant Booking</h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Reservations, schedule, and SMS reminders.</p>
                        <div class="flex flex-wrap gap-2 pt-1">
                            <span class="text-[11px] px-2 py-0.5 rounded border border-neutral-200/70 dark:border-neutral-700/80">Laravel</span>
                            <span class="text-[11px] px-2 py-0.5 rounded border border-neutral-200/70 dark:border-neutral-700/80">MySQL</span>
                            <span class="text-[11px] px-2 py-0.5 rounded border border-neutral-200/70 dark:border-neutral-700/80">Twilio</span>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        {{-- ABOUT --}}
        <section id="about" class="py-10 sm:py-12">
            <div class="rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 bg-neutral-50/60 dark:bg-neutral-900/60 p-6 sm:p-8">
                <h2 class="text-base font-semibold mb-2">About me</h2>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    I focus on clean UI and smooth UX. Stack: Laravel, Livewire/Inertia, Blade, Tailwind.
                    I care about accessibility, performance, and maintainable code.
                </p>
            </div>
        </section>

        {{-- CONTACT / CTA --}}
        <section id="contact" class="py-10 sm:py-12">
            <div class="rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 p-6 sm:p-8 flex items-center justify-between gap-4 bg-white dark:bg-neutral-900">
                <div>
                    <h3 class="font-medium">Got a project in mind?</h3>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Let’s build something neat together.</p>
                </div>
                <a href="mailto:hello@example.com" class="px-4 py-2 rounded-md bg-neutral-900 text-white dark:bg-white dark:text-neutral-900 text-sm">Email me</a>
            </div>
        </section>
    </main>

    {{-- MOBILE NAV + THEME TOGGLE (optional) --}}
    <div class="sm:hidden fixed bottom-4 right-4">
        <button id="themeToggleMobile"
                class="inline-flex h-10 w-10 items-center justify-center rounded-full shadow border border-neutral-200/60 dark:border-neutral-800/60 bg-white/90 dark:bg-neutral-900/90 backdrop-blur">
            <span class="sr-only">Toggle theme</span>
            <svg class="h-5 w-5 dark:hidden" viewBox="0 0 24 24" fill="currentColor"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            <svg class="h-5 w-5 hidden dark:block" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4a1 1 0 0 1 1-1h0a1 1 0 1 1-2 0h0a1 1 0 0 1 1 1zm0 17a1 1 0 0 1 1-1h0a1 1 0 1 1-2 0h0a1 1 0 0 1 1 1zm8-9a1 1 0 0 1-1-1h0a1 1 0 1 1 2 0h0a1 1 0 0 1-1 1zM5 12a1 1 0 0 1-1-1h0a1 1 0 1 1 2 0h0a1 1 0 0 1-1 1zM17.31 18.31a1 1 0 0 1 1.41 0h0a1 1 0 1 1-1.41 1.41h0a1 1 0 0 1 0-1.41zM6.28 6.28a1 1 0 0 1 1.41 0h0A1 1 0 1 1 6.28 4.87h0a1 1 0 0 1 0 1.41zM17.72 6.28a1 1 0 0 1 0 1.41h0A1 1 0 1 1 16.31 4.87h0a1 1 0 0 1 1.41 0zM6.28 17.72a1 1 0 0 1 0 1.41h0A1 1 0 1 1 4.87 17.72h0a1 1 0 0 1 1.41 0z"/></svg>
        </button>
    </div>

    {{-- Toggle script --}}
    <script>
      (function () {
        function setTheme(mode) {
          document.documentElement.classList.toggle('dark', mode === 'dark');
          localStorage.setItem('theme', mode);
        }
        function toggle() {
          const isDark = document.documentElement.classList.contains('dark');
          setTheme(isDark ? 'light' : 'dark');
        }
        document.getElementById('themeToggle')?.addEventListener('click', toggle);
        document.getElementById('themeToggleMobile')?.addEventListener('click', toggle);
      })();
    </script>
</body>
</html>
