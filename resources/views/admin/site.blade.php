@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">Site Settings</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update global site information, brand colors, and contact details.</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.5L8.25 12 15 4.5" />
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent p-6 lg:p-8 space-y-6">
                @if(session('success'))
                    <div class="mb-8">
                        <div class="bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <!-- Site Settings Form -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <form action="{{ route('admin.site-settings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Hero Title -->
                        <div>
                            <label for="hero_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Hero Title</label>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                The main title that appears on your homepage
                            </p>
                            <input type="text" name="hero_title" id="hero_title" value="{{ $heroTitle }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                                   placeholder="e.g., Hi, I'm Abonalla">
                        </div>
                
                        <!-- About Text -->
                        <div>
                            <label for="about_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">About Me Text</label>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                Your personal description that appears on the About page
                            </p>
                            <textarea name="about_text" id="about_text" rows="6" required 
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                                      placeholder="Tell visitors about yourself, your skills, and what you do...">{{ $aboutText }}</textarea>
                        </div>
                
                        <!-- Social Links -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Social Media Links</label>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                                Add your social media profiles (leave blank if you don't have one)
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="github" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">GitHub</label>
                                    <input type="url" id="github" name="github" value="{{ $socials['github'] ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                                           placeholder="https://github.com/username">
                                </div>
                                
                                <div>
                                    <label for="linkedin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">LinkedIn</label>
                                    <input type="url" id="linkedin" name="linkedin" value="{{ $socials['linkedin'] ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                                           placeholder="https://linkedin.com/in/username">
                                </div>
                                
                                <div>
                                    <label for="instagram" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Instagram</label>
                                    <input type="url" id="instagram" name="instagram" value="{{ $socials['instagram'] ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                                           placeholder="https://instagram.com/username">
                                </div>
                                
                                <div>
                                    <label for="youtube" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">YouTube</label>
                                    <input type="url" id="youtube" name="youtube" value="{{ $socials['youtube'] ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                                           placeholder="https://youtube.com/@username">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

