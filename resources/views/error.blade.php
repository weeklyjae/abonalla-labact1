@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white dark:bg-neutral-950">
    <div class="max-w-md mx-auto px-4 text-center">
        <div class="mb-8">
            <h1 class="text-6xl font-bold text-red-500 mb-4">Error</h1>
            <h2 class="text-2xl font-semibold text-neutral-800 dark:text-neutral-200 mb-6">
                Something went wrong
            </h2>
            
            @if(session('error'))
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                    <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
                </div>
            @endif
            
            <div class="space-y-4">
                <a href="{{ route('home') }}" 
                   class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    Go Home
                </a>
                
                <button onclick="history.back()" 
                        class="inline-block px-6 py-3 border border-neutral-300 dark:border-neutral-600 hover:border-blue-500 text-neutral-700 
                        dark:text-neutral-300 hover:text-blue-600 rounded-lg font-medium transition-colors ml-4">
                    Go Back
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
