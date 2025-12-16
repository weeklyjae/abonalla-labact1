@extends('layouts.app')

@section('content')
{{-- Full Screen Hero Section with Background Photo --}}
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    {{-- Background Photo --}}
    <div class="absolute inset-0 z-0 w-full h-full">
        <img src="{{ asset('images/bg.JPEG') }}" 
             alt="weeklyjae Background" 
             class="h-full w-full object-cover object-center"
             onerror="this.src='https://via.placeholder.com/1920x1080/1E40AF/FFFFFF?text=weeklyjae+Background'">
        {{-- Dark overlay for better text readability --}}
        <div class="absolute inset-0 bg-black/40 dark:bg-black/60"></div>
    </div>
    
    {{-- Hero Content --}}
    <div class="relative z-10 text-center text-white max-w-6xl mx-auto px-4 sm:px-6">
        <div class="space-y-8">
            <div class="space-y-6">
                <h1 class="text-5xl sm:text-7xl lg:text-8xl font-bold leading-tight animate-fade-in">
                    Hi, I'm <span class="text-blue-400">weeklyjae</span>
                </h1>
                <p class="text-xl sm:text-3xl text-blue-100 max-w-3xl mx-auto animate-fade-in-delay">
                    Developer, Video Editor, 
                    Photographer, and Traveller
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-delay-3">
                <a href="#about" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Learn More
                </a>
                <a href="{{ route('contact') }}" class="px-8 py-4 border-2 border-white hover:bg-white hover:text-blue-900 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                    Get In Touch
                </a>
            </div>
        </div>
    </div>
    
    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
        <div class="flex flex-col items-center text-white">
            <span class="text-sm mb-2">Scroll Down</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>

{{-- About Me Section --}}
<section id="about" class="py-16 sm:py-20 bg-white dark:bg-neutral-950">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="bg-neutral-100 dark:bg-neutral-800 rounded-2xl p-8 sm:p-12">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center">
                {{-- Left Side: Profile Photo --}}
                <div class="w-full lg:w-auto">
                    <div class="h-96 w-80 rounded-2xl overflow-hidden mx-auto lg:mx-0">
                        <img src="{{ asset('images/profile.JPEG') }}" 
                             alt="weeklyjae - Jhon Martin Abonalla" 
                             class="h-full w-full object-cover"
                             onerror="this.src='https://via.placeholder.com/320x384/6B7280/FFFFFF?text=Profile+Photo'">
                    </div>
                </div>
                
                {{-- Right Side: Content --}}
                <div class="flex-1 space-y-6">
                    <div class="text-center lg:text-left">
                        <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-neutral-800 dark:text-neutral-200">About me</h2>
                        <p class="text-lg text-neutral-700 dark:text-neutral-300 mb-6">
                        I'm Jhon Martin Abonalla, a fourth-year Information Technology student at the University of Santo Tomas, specializing in Web and Mobile Development. Besides coding, I love editing videos and photography, as well as traveling, which allows me to discover new places and perspectives. These passions inspire me to create projects that combine both technical skill and creativity.
                        </p>
                        
                        {{-- Technology Tags --}}
                        <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
                            {{-- PHP --}}
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-100 dark:bg-purple-900/30 border border-purple-300 dark:border-purple-700 rounded-full">
                                <img src="{{ asset('images/php-logo.png') }}" alt="PHP" class="w-8 h-5 object-contain">
                                <span class="text-sm font-medium text-purple-700 dark:text-purple-300">PHP</span>
                            </div>
                            
                            {{-- C++ --}}
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 dark:bg-blue-900/30 border border-blue-300 dark:border-blue-700 rounded-full">
                                <img src="{{ asset('images/cpp-logo.png') }}" alt="C++" class="w-5 h-5 object-contain">
                                <span class="text-sm font-medium text-blue-700 dark:text-blue-300">C++</span>
                            </div>
                            
                            {{-- ASP.NET --}}
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-100 dark:bg-indigo-900/30 border border-indigo-300 dark:border-indigo-700 rounded-full">
                                <img src="{{ asset('images/aspnet-logo.png') }}" alt="ASP.NET" class="w-5 h-5 object-contain">
                                <span class="text-sm font-medium text-indigo-700 dark:text-indigo-300">ASP.NET</span>
                            </div>
                            
                            {{-- JavaScript --}}
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 border border-yellow-300 dark:border-yellow-700 rounded-full">
                                <img src="{{ asset('images/js-logo.png') }}" alt="JavaScript" class="w-5 h-5 object-contain">
                                <span class="text-sm font-medium text-yellow-700 dark:text-yellow-300">JavaScript</span>
                            </div>
                            
                            {{-- React --}}
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-100 dark:bg-cyan-900/30 border border-cyan-300 dark:border-cyan-700 rounded-full">
                                <img src="{{ asset('images/react-logo.png') }}" alt="React" class="w-5 h-5 object-contain">
                                <span class="text-sm font-medium text-cyan-700 dark:text-cyan-300">React</span>
                            </div>
                            
                            {{-- Kotlin --}}
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-100 dark:bg-orange-900/30 border border-orange-300 dark:border-orange-700 rounded-full">
                                <img src="{{ asset('images/kotlin-logo.png') }}" alt="Kotlin" class="w-5 h-5 object-contain">
                                <span class="text-sm font-medium text-orange-700 dark:text-orange-300">Kotlin</span>
                            </div>
                            
                            {{-- Laravel --}}
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 rounded-full">
                                <img src="{{ asset('images/laravel-logo.png') }}" alt="Laravel" class="w-5 h-5 object-contain">
                                <span class="text-sm font-medium text-red-700 dark:text-red-300">Laravel</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Featured Images --}}
{{-- Featured Work placeholder --}}
<section class="py-16 sm:py-24 bg-neutral-50 dark:bg-neutral-900">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl font-bold mb-4">Featured Work</h2>
        <p class="text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto">
            Highlight recent projects here once the dynamic gallery is ready.
            Pull images from storage or a database and link each card to the
            relevant page.
        </p>
    </div>
</section>

{{-- Quick Links --}}
<section class="py-16 sm:py-24 bg-white dark:bg-neutral-950">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid md:grid-cols-3 gap-8">
            {{-- Coding --}}
            <a href="{{ route('coding') }}" class="group block cursor-pointer">
                <div class="rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 bg-neutral-50/60 dark:bg-neutral-900/60 p-8 hover:shadow-lg transition-all duration-300">
                    <div class="space-y-4">
                        <div class="h-12 w-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 grid place-items-center">
                            <span class="text-2xl">💻</span>
                        </div>
                        <h3 class="text-xl font-semibold">Coding Projects</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">
                            Web applications, mobile apps, and software solutions
                        </p>
                        <div class="flex items-center text-blue-600 dark:text-blue-400 font-medium group-hover:translate-x-1 transition-transform">
                            View Projects
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Editing --}}
            <a href="{{ route('editing') }}" class="group block cursor-pointer">
                <div class="rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 bg-neutral-50/60 dark:bg-neutral-900/60 p-8 hover:shadow-lg transition-all duration-300">
                    <div class="space-y-4">
                        <div class="h-12 w-12 rounded-xl bg-green-100 dark:bg-green-900/30 grid place-items-center">
                            <span class="text-2xl">🎬</span>
                        </div>
                        <h3 class="text-xl font-semibold">Video Editing & Photography</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">
                            Cinematic edits, creative visuals, and captured moments
                        </p>
                        <div class="flex items-center text-green-600 dark:text-green-400 font-medium group-hover:translate-x-1 transition-transform">
                            View Videos & Photos
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Travel --}}
            <a href="{{ route('travel') }}" class="group block cursor-pointer">
                <div class="rounded-2xl border border-neutral-200/60 dark:border-neutral-800/60 bg-neutral-50/60 dark:bg-neutral-900/60 p-8 hover:shadow-lg transition-all duration-300">
                    <div class="space-y-4">
                        <div class="h-12 w-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 grid place-items-center">
                            <span class="text-2xl">✈️</span>
                        </div>
                        <h3 class="text-xl font-semibold">Travels</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">
                            Exploring new places and experiences
                        </p>
                        <div class="flex items-center text-purple-600 dark:text-purple-400 font-medium group-hover:translate-x-1 transition-transform">
                            View Locations & Photos
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- Custom CSS for animations --}}
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }
    
    .animate-fade-in-delay {
        animation: fade-in 1s ease-out 0.3s both;
    }
    
    .animate-fade-in-delay-2 {
        animation: fade-in 1s ease-out 0.6s both;
    }
    
    .animate-fade-in-delay-3 {
        animation: fade-in 1s ease-out 0.9s both;
    }
    
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0) translateX(-50%);
        }
        40% {
            transform: translateY(-10px) translateX(-50%);
        }
        60% {
            transform: translateY(-5px) translateX(-50%);
        }
    }
</style>
@endsection
