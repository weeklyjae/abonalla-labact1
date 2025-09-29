@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                            Portfolio Content
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Manage your YouTube videos, Instagram content, and photography
                        </p>
                    </div>
                    <a href="{{ route('admin.media-items.create') }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Add New Content
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent p-6 lg:p-8">
                <!-- Admin Navigation -->
                <x-admin-nav />
                
                <!-- Content List -->
                <div class="mt-8">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Your Portfolio Items</h2>
                    
                    @if($mediaItems->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($mediaItems as $item)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                                    <div class="p-4">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                                {{ ucfirst(str_replace('_', ' ', $item->type)) }}
                                            </span>
                                            <span class="text-xs text-gray-400">{{ $item->category->name }}</span>
                                        </div>
                                        <h3 class="font-medium text-gray-900 dark:text-gray-100 mb-2">{{ $item->title }}</h3>
                                        @if($item->description)
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $item->description }}</p>
                                        @endif
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ Str::limit($item->content, 30) }}
                                            </span>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.media-items.edit', $item) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.media-items.destroy', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="h-16 w-16 mx-auto rounded-full bg-gray-100 dark:bg-gray-800 grid place-items-center">
                                <span class="text-3xl">🎬</span>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">No content yet</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                Add your first portfolio item to showcase your work.
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('admin.media-items.create') }}" 
                                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    Add First Item
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
