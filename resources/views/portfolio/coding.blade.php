@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 sm:px-6">
    {{-- Header --}}
    <section class="py-16 sm:py-20 text-center">
        <div class="max-w-4xl mx-auto space-y-4">
            <h1 class="text-4xl sm:text-5xl font-bold">Coding Projects</h1>
            <p class="text-xl text-neutral-600 dark:text-neutral-400">
                Web applications, mobile apps, and software solutions I've built
            </p>
        </div>
    </section>

    {{-- Projects Grid --}}
    @if(count($images) > 0)
        <section class="pb-16 sm:pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($images as $image)
                    <div class="group">
                        <div class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900 hover:shadow-lg transition-all duration-300">
                            <img class="h-64 w-full object-cover group-hover:scale-105 transition-transform duration-300" 
                                 src="{{ $image['url'] }}" 
                                 alt="{{ $image['name'] }}">
                            <div class="p-4">
                                <h3 class="font-medium text-lg">{{ ucwords(str_replace(['-', '_'], ' ', $image['name'])) }}</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                                    Coding project showcase
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @else
        {{-- Static guest showcase --}}
        <section class="pb-16 sm:pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                    <img class="h-48 w-full object-contain p-6" src="/images/laravel-logo.png" alt="Laravel">
                    <div class="p-4">
                        <h3 class="font-medium text-lg">Laravel Portfolio Site</h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Authentication, admin panel, media galleries</p>
                    </div>
                </div>
                <div class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                    <img class="h-48 w-full object-contain p-6" src="/images/react-logo.png" alt="React">
                    <div class="p-4">
                        <h3 class="font-medium text-lg">React Dashboard</h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Charts, tables, and responsive layout</p>
                    </div>
                </div>
                <div class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                    <img class="h-48 w-full object-contain p-6" src="/images/js-logo.png" alt="JavaScript">
                    <div class="p-4">
                        <h3 class="font-medium text-lg">Vanilla JS Mini Apps</h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Todo, weather, and calculator widgets</p>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
@endsection

