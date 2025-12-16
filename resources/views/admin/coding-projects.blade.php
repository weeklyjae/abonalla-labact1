@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                            Coding Projects Management
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Upload and manage images of your coding projects
                        </p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.5L8.25 12 15 4.5" />
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent p-6 lg:p-8">
                <!-- Admin Navigation -->
                <x-admin-nav />

                <!-- Static list mirroring public /coding -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($images as $image)
                        <div class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                            <img class="h-48 w-full object-cover" src="{{ $image['url'] }}" alt="{{ $image['name'] }}">
                            <div class="p-4">
                                <h3 class="font-medium text-lg">{{ $image['name'] }}</h3>
                                <p class="mt-2 text-xs text-neutral-500 dark:text-neutral-400">Rename or remove files directly from storage until backend CRUD is implemented.</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">No coding project screenshots yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
