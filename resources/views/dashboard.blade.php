<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Welcome back, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">
                    Manage your portfolio, travel photos, and site content from here.
                </p>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-3xl">🖼️</span>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Photos</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ \Storage::disk('public')->exists('gallery') ? count(\Storage::disk('public')->allFiles('gallery')) : 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-3xl">✈️</span>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Travel Categories</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ \App\Models\TravelCategory::count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-3xl">📸</span>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Travel Photos</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ \App\Models\TravelPhoto::count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                                            <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span class="text-3xl">📊</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Items</div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ \App\Models\TravelCategory::count() + \App\Models\TravelPhoto::count() }}
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <!-- Admin Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Gallery Management -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="text-2xl mr-3">🖼️</span>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Gallery Management</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Upload, organize, and manage photos across all your portfolios.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('admin.gallery') }}" 
                               class="block w-full text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                Manage Gallery
                            </a>
                            <a href="{{ route('admin.coding') }}" 
                               class="block w-full text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors">
                                Manage Coding Projects
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Travel Categories -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="text-2xl mr-3">✈️</span>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Travel Categories</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Organize your travel photos by trip categories like "Bangkok Trip", "Taiwan Trip".
                        </p>
                        <a href="{{ route('admin.travel') }}" 
                           class="block w-full text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors">
                            Manage Travel Photos
                        </a>
                    </div>
                </div>

                <!-- Site Settings -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="text-2xl mr-3">⚙️</span>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Site Settings</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Update your about page, social media links, and site information.
                        </p>
                        <a href="{{ route('admin.site') }}" 
                           class="block w-full text-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition-colors">
                            Site Settings
                        </a>
                    </div>
                </div>

                <!-- View Site -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="text-2xl mr-3">🌐</span>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">View Site</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            See how your portfolio looks to visitors.
                        </p>
                        <a href="{{ route('home') }}" 
                           class="block w-full text-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors">
                            Visit Homepage
                        </a>
                    </div>
                </div>

                <!-- Profile Settings -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="text-2xl mr-3">👤</span>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Update your account settings and profile information.
                        </p>
                        <a href="{{ route('profile.show') }}" 
                           class="block w-full text-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg font-medium transition-colors">
                            Profile Settings
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Recent Activity</h3>
                    <div class="space-y-3">
                        @php
                            $recentCategories = \App\Models\TravelCategory::latest()->take(3)->get();
                            $recentPhotos = \App\Models\TravelPhoto::with('category')->latest()->take(3)->get();
                        @endphp
                        
                        @if($recentCategories->count() > 0 || $recentPhotos->count() > 0)
                            @foreach($recentCategories as $category)
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <span class="text-green-500 mr-2">✓</span>
                                    <span>Created travel category "{{ $category->name }}"</span>
                                    <span class="ml-auto text-xs">{{ $category->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                            
                            @foreach($recentPhotos as $photo)
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <span class="text-blue-500 mr-2">📸</span>
                                    <span>Added photo to "{{ $photo->category->name ?? 'Unknown' }}"</span>
                                    <span class="ml-auto text-xs">{{ $photo->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 dark:text-gray-400 text-sm">No recent activity. Start by creating some travel categories!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
