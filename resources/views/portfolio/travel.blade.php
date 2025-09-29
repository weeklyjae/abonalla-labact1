@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 sm:px-6">
    {{-- Header --}}
    <section class="py-16 sm:py-20 text-center">
        <div class="max-w-4xl mx-auto space-y-4">
            <h1 class="text-4xl sm:text-5xl font-bold">Travel Photos</h1>
            <p class="text-xl text-neutral-600 dark:text-neutral-400">
                Photos from my travels around the world
            </p>
        </div>
    </section>

    {{-- Travel Places with Photos --}}
    @if(isset($categories) && count($categories) > 0)
        <section class="pb-16 sm:pb-20 space-y-16">
            @foreach($categories as $category)
                <div class="space-y-8">
                    {{-- Place Header --}}
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100">
                            {{ $category->name }}
                        </h2>
                        @if($category->description)
                            <p class="mt-2 text-lg text-neutral-600 dark:text-neutral-400">
                                {{ $category->description }}
                            </p>
                        @endif
                    </div>

                    {{-- Photos Grid for this Place --}}
                    @if(count($category->photos) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($category->photos as $photo)
                                <div class="group">
                                    <div class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900 hover:shadow-lg transition-all duration-300">
                                        <img class="h-64 w-full object-cover group-hover:scale-105 transition-transform duration-300" 
                                             src="{{ $photo->url }}" 
                                             alt="{{ $photo->title ?? $photo->original_name }}">
                                        <div class="p-4">
                                            <h3 class="font-medium text-lg">
                                                {{ $photo->title ?? ucwords(str_replace(['-', '_'], ' ', $photo->original_name)) }}
                                            </h3>
                                            @if($photo->description)
                                                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                                                    {{ $photo->description }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="h-16 w-16 mx-auto rounded-full bg-neutral-100 dark:bg-neutral-800 grid place-items-center">
                                <span class="text-2xl">📷</span>
                            </div>
                            <p class="text-neutral-600 dark:text-neutral-400 mt-2">
                                No photos in this place yet.
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach
        </section>
    @else
        {{-- Fallback to old display method --}}
        @if(isset($images) && count($images) > 0)
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
                                        Travel photography
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @else
            {{-- Static guest tiles --}}
            <section class="pb-16 sm:pb-20">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                        <img class="h-64 w-full object-cover" src="/images/bg.JPEG" alt="Beach">
                        <div class="p-4">
                            <h3 class="font-medium text-lg">Beach Getaway</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Sunset and shoreline</p>
                        </div>
                    </div>
                    <div class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                        <img class="h-64 w-full object-cover" src="/images/profile.JPEG" alt="City">
                        <div class="p-4">
                            <h3 class="font-medium text-lg">City Walk</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Street photography</p>
                        </div>
                    </div>
                    <div class="rounded-xl overflow-hidden border border-neutral-200/60 dark:border-neutral-800/60 bg-white dark:bg-neutral-900">
                        <img class="h-64 w-full object-cover" src="/images/taiwan.jpg" alt="Taiwan">
                        <div class="p-4">
                            <h3 class="font-medium text-lg">Taiwan Moments</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Cityscapes and culture</p>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif
</div>
@endsection

