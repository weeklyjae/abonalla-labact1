@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Media Library</h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    The media library management tools are currently disabled while the section remains static.
                </p>
            </div>

            <div class="p-8 text-center text-sm text-gray-500 dark:text-gray-400">
                <p>When you’re ready to manage media dynamically, re-enable this module from the routes.</p>
            </div>
        </div>
    </div>
</div>

<script>
function saveYouTubeSettings() {
    const channel = document.getElementById('youtube_channel').value;
    const videos = document.getElementById('youtube_videos').value;
    
    fetch('{{ route("admin.media-library.youtube") }}', {
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
            alert('Error saving YouTube settings: ' + (data.message || 'Unknown error.'));
        }
    })
    .catch(error => {
        alert('Error saving YouTube settings: ' + error.message);
    });
}

function saveInstagramSettings() {
    const username = document.getElementById('instagram_username').value;
    const embed = document.getElementById('instagram_embed').value;
    
    fetch('{{ route("admin.media-library.instagram") }}', {
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
            alert('Error saving Instagram settings: ' + (data.message || 'Unknown error.'));
        }
    })
    .catch(error => {
        alert('Error saving Instagram settings: ' + error.message);
    });
}
</script>
@endsection
