@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 sm:px-6">
    {{-- Main Header --}}
    <section class="py-16 sm:py-20 text-center">
        <div class="max-w-4xl mx-auto space-y-4">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-800">video editing + photography</h1>
            <p class="text-xl text-gray-700">
                Cinematic edits, vlogs, and creative content I've produced
            </p>
        </div>
    </section>

    {{-- Personal YouTube Channel Section --}}
    @if($mediaSettings->where('name', 'like', '%youtube%')->count() > 0)
        @php $youtubeCategory = $mediaSettings->where('name', 'like', '%youtube%')->first(); @endphp
        <section class="py-16 sm:py-20 mb-8">
            <div class="max-w-4xl mx-auto px-6">
                <div class="mb-8">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">personal yt channel</h2>
                    <p class="text-lg text-gray-700">i do vlogs and tech contents in here</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($youtubeCategory->mediaItems as $item)
                        @if($item->type === 'youtube_video')
                            @php
                                // Extract YouTube video ID from various URL formats
                                $videoId = null;
                                $url = $item->content;
                                
                                // Handle different YouTube URL formats
                                if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
                                    $videoId = $matches[1];
                                } elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
                                    $videoId = $matches[1];
                                } elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
                                    $videoId = $matches[1];
                                }
                                
                                // Generate a better title if the current title is just a video ID
                                $displayTitle = $item->title;
                                if (strlen($item->title) === 11 && preg_match('/^[a-zA-Z0-9_-]{11}$/', $item->title)) {
                                    // If title is exactly 11 characters (YouTube ID length), use description or generate title
                                    if ($item->description && !empty(trim($item->description))) {
                                        $displayTitle = $item->description;
                                    } else {
                                        $displayTitle = 'Video ' . substr($videoId, 0, 8) . '...';
                                    }
                                }
                            @endphp
                            
                            <div class="bg-gray-100 rounded-xl p-4 hover:shadow-lg transition-shadow">
                                @if($videoId)
                                    <div class="aspect-video w-full mb-3">
                                        <img src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg" 
                                             alt="{{ $displayTitle }}" 
                                             class="w-full h-full object-cover rounded-lg">
                                    </div>
                                @endif
                                <h3 class="font-medium text-sm text-gray-800 mb-2">{{ $displayTitle }}</h3>
                                @if($item->description && $item->description !== $displayTitle)
                                    <p class="text-xs text-gray-600">{{ $item->description }}</p>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Instagram Section --}}
    @if($mediaSettings->where('name', 'like', '%instagram%')->count() > 0)
        @php $instagramCategory = $mediaSettings->where('name', 'like', '%instagram%')->first(); @endphp
        <section class="py-16 sm:py-20 mb-8">
            <div class="max-w-4xl mx-auto px-6">
                <div class="mb-8">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">instagram</h2>
                    <p class="text-lg text-gray-700">i do fan edits before</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($instagramCategory->mediaItems as $item)
                        @if($item->type === 'instagram_embed')
                            <div class="bg-gray-100 rounded-xl p-4 hover:shadow-lg transition-shadow">
                                <div class="flex justify-center mb-3">
                                    {!! $item->content !!}
                                </div>
                                <h3 class="font-medium text-sm text-gray-800 mb-2">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="text-xs text-gray-600">{{ $item->description }}</p>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Photographs Section --}}
    @if($mediaSettings->where('name', 'like', '%photo%')->count() > 0)
        @php $photoCategory = $mediaSettings->where('name', 'like', '%photo%')->first(); @endphp
        <section class="py-16 sm:py-20 mb-8">
            <div class="max-w-4xl mx-auto px-6">
                <div class="mb-8">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">photographs</h2>
                    <p class="text-lg text-gray-700">using canon eos 5d mark iii</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($photoCategory->mediaItems as $item)
                        <div class="bg-gray-100 rounded-xl p-4 hover:shadow-lg transition-shadow">
                            @if($item->type === 'image')
                                <img src="{{ $item->content }}" alt="{{ $item->title }}" class="w-full h-32 object-cover rounded-lg mb-3">
                            @endif
                            <h3 class="font-medium text-sm text-gray-800 mb-2">{{ $item->title }}</h3>
                            @if($item->description)
                                <p class="text-xs text-gray-600">{{ $item->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Show all available categories for debugging --}}
    @if($mediaSettings->count() > 0)
        <section class="py-16 sm:py-20 mb-8">
            <div class="max-w-4xl mx-auto px-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">All Available Content</h2>
                @foreach($mediaSettings as $category)
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">{{ $category->name }}</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($category->mediaItems as $item)
                                <div class="bg-gray-100 rounded-xl p-4 hover:shadow-lg transition-shadow">
                                    @if($item->type === 'youtube_video')
                                        @php
                                            $videoId = null;
                                            $url = $item->content;
                                            
                                            if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
                                                $videoId = $matches[1];
                                            } elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
                                                $videoId = $matches[1];
                                            } elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
                                                $videoId = $matches[1];
                                            }
                                            
                                            // Generate a better title if the current title is just a video ID
                                            $displayTitle = $item->title;
                                            if (strlen($item->title) === 11 && preg_match('/^[a-zA-Z0-9_-]{11}$/', $item->title)) {
                                                // If title is exactly 11 characters (YouTube ID length), use description or generate title
                                                if ($item->description && !empty(trim($item->description))) {
                                                    $displayTitle = $item->description;
                                                } else {
                                                    $displayTitle = 'Video ' . substr($videoId, 0, 8) . '...';
                                                }
                                            }
                                        @endphp
                                        
                                        @if($videoId)
                                            <div class="aspect-video w-full mb-3">
                                                <img src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg" 
                                                     alt="{{ $displayTitle }}" 
                                                     class="w-full h-full object-cover rounded-lg">
                                            </div>
                                        @endif
                                    @elseif($item->type === 'image')
                                        <img src="{{ $item->content }}" alt="{{ $item->title }}" class="w-full h-32 object-cover rounded-lg mb-3">
                                    @endif
                                    
                                    <h4 class="font-medium text-sm text-gray-800 mb-2">{{ $displayTitle ?? $item->title }}</h4>
                                    @if($item->description && $item->description !== ($displayTitle ?? $item->title))
                                        <p class="text-xs text-gray-600">{{ $item->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @else
        {{-- Static guest cards --}}
        <section class="pb-16 sm:pb-20">
            <div class="max-w-4xl mx-auto px-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-100 rounded-xl p-4">
                        <div class="aspect-video w-full mb-3 overflow-hidden rounded-lg">
                            <img src="{{ asset('images/maxresdefault (1).jpg') }}" alt="Editing thumbnail 1" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-medium text-sm text-gray-800 mb-2">samsung s25 ultra + accessories unboxing 📱✨</h3>
                        <p class="text-xs text-gray-600">Cinematic shots and B-roll</p>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-4">
                        <div class="aspect-video w-full mb-3 overflow-hidden rounded-lg">
                            <img src="{{ asset('images/maxresdefault (2).jpg') }}" alt="Editing thumbnail 2" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-medium text-sm text-gray-800 mb-2">ust vlogs 🐯 | fun-filled day of in-person classes, playing in the field, food trip 🧑🏻‍💻🏐🍗</h3>
                        <p class="text-xs text-gray-600">Natural light portraits</p>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-4">
                        <div class="aspect-video w-full mb-3 overflow-hidden rounded-lg">
                            <img src="{{ asset('images/maxresdefault (3).jpg') }}" alt="Editing thumbnail 3" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-medium text-sm text-gray-800 mb-2">ust vlogs 🐯 | study + school ganaps (new turnstile!)</h3>
                        <p class="text-xs text-gray-600">Short-form verticals</p>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
@endsection

