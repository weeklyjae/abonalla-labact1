@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                            Editing & Photography Portfolio
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Manage your content categories and portfolio items
                        </p>
                    </div>
                    <a href="{{ route('admin.media-categories.create') }}" 
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Add New Category
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent p-6 lg:p-8">
                <!-- Admin Navigation -->
                <x-admin-nav />
                
                <!-- Categories List -->
                <div class="mt-8">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Your Content Categories</h2>
                    
                    @if($categories->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($categories as $category)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                                    <div class="p-4">
                                        <div class="flex items-center mb-3">
                                            <span class="text-2xl mr-3">{{ $category->icon }}</span>
                                            <h3 class="font-medium text-gray-900 dark:text-gray-100">{{ $category->name }}</h3>
                                        </div>
                                        @if($category->description)
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $category->description }}</p>
                                        @endif
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $category->mediaItems->count() }} items
                                            </span>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.media-items.create', ['category' => $category->id]) }}" 
                                                   class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 text-sm">
                                                    Add Content
                                                </a>
                                                <a href="{{ route('admin.media-categories.edit', $category) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">
                                                    Edit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="h-16 w-16 mx-auto rounded-full bg-gray-100 dark:bg-gray-800 grid place-items-center">
                                <span class="text-3xl">📁</span>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">No categories yet</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                Create your first content category to organize your portfolio.
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('admin.media-categories.create') }}" 
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    Create First Category
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
