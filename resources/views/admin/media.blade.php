@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    Media & Photography Management
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Manage your YouTube videos and Instagram photography
                </p>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent p-6 lg:p-8">
                <!-- Admin Navigation -->
                <x-admin-nav />

                <!-- Toolbar -->
                <div class="flex justify-end mb-4 gap-2">
                    <a href="{{ route('admin.media.create') }}" class="px-3 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Add Media</a>
                    <a href="{{ route('admin.media.edit', ['id' => 1]) }}" class="px-3 py-2 rounded-md bg-neutral-200 dark:bg-neutral-700 text-neutral-900 dark:text-white hover:bg-neutral-300 dark:hover:bg-neutral-600">Edit Media</a>
                </div>

                <!-- Static list mirroring public /editing -->
                <div class="max-w-5xl mx-auto">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Featured Videos</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
                            <div class="aspect-video w-full mb-3 overflow-hidden rounded-lg">
                                <img src="{{ asset('images/maxresdefault (1).jpg') }}" alt="Editing thumbnail 1" class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-medium text-sm text-gray-800 mb-2">samsung s25 ultra + accessories unboxing 📱✨</h3>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
                            <div class="aspect-video w-full mb-3 overflow-hidden rounded-lg">
                                <img src="{{ asset('images/maxresdefault (2).jpg') }}" alt="Editing thumbnail 2" class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-medium text-sm text-gray-800 mb-2">ust vlogs 🐯 | fun-filled day of in-person classes, playing in the field, food trip 🧑🏻‍💻🏐🍗</h3>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
                            <div class="aspect-video w-full mb-3 overflow-hidden rounded-lg">
                                <img src="{{ asset('images/maxresdefault (3).jpg') }}" alt="Editing thumbnail 3" class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-medium text-sm text-gray-800 mb-2">ust vlogs 🐯 | study + school ganaps (new turnstile!)</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function saveYouTubeSettings() {
    const channel = document.getElementById('youtube_channel').value;
    const videos = document.getElementById('youtube_videos').value;
    
    fetch('{{ route("admin.media.youtube") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            youtube_channel: channel,
            youtube_videos: videos
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('YouTube settings saved successfully!');
            location.reload();
        } else {
            alert('Error saving YouTube settings: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error saving YouTube settings: ' + error.message);
    });
}

function saveInstagramSettings() {
    const username = document.getElementById('instagram_username').value;
    const embed = document.getElementById('instagram_embed').value;
    
    fetch('{{ route("admin.media.instagram") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            instagram_username: username,
            instagram_embed: embed
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Instagram settings saved successfully!');
            location.reload();
        } else {
            alert('Error saving Instagram settings: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error saving Instagram settings: ' + error.message);
    });
}
</script>
@endsection
