@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    Add Photos to Travel Places
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Upload photos and organize them by travel place
                </p>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent p-6 lg:p-8">
                <!-- Admin Navigation -->
                <x-admin-nav />
                
                <!-- Upload New Photo Form -->
                <div class="mb-8">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Upload New Photo</h2>
                    <form method="POST" action="{{ route('admin.travel-photos.store') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label for="travel_category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Travel Place</label>
                                <select name="travel_category_id" id="travel_category_id" required 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a place</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title (Optional)</label>
                                <input type="text" name="title" id="title" 
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                       placeholder="Photo title">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description (Optional)</label>
                                <input type="text" name="description" id="description" 
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                       placeholder="Photo description">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" 
                                        class="w-full bg-indigo-600 border border-transparent rounded-md py-2 px-4 flex items-center justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Upload Photo
                                </button>
                            </div>
                        </div>
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo File</label>
                            <input type="file" name="photo" id="photo" required accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300">
                        </div>
                    </form>
                </div>

                <!-- Photos by Place -->
                <div class="space-y-8">
                    @foreach($categories as $category)
                        @if($category->photos->count() > 0)
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                    {{ $category->name }} ({{ $category->photos->count() }} photos)
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($category->photos as $photo)
                                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                                            <img src="{{ $photo->url }}" alt="{{ $photo->title ?? $photo->original_name }}" 
                                                 class="w-full h-48 object-cover">
                                            <div class="p-4">
                                                <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $photo->title ?? ucwords(str_replace(['-', '_'], ' ', $photo->original_name)) }}
                                                </h4>
                                                @if($photo->description)
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                        {{ $photo->description }}
                                                    </p>
                                                @endif
                                                <div class="mt-3 flex space-x-2">
                                                    <button onclick="editPhoto({{ $photo->id }})" 
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">
                                                        Edit
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.travel-photos.destroy', $photo) }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-sm"
                                                                onclick="return confirm('Are you sure you want to delete this photo?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                @if($photos->count() == 0)
                    <div class="text-center py-8">
                        <div class="h-16 w-16 mx-auto rounded-full bg-gray-100 dark:bg-gray-800 grid place-items-center">
                            <span class="text-2xl">📷</span>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">No photos yet</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Upload your first photo to get started.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Edit Photo Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Edit Photo</h3>
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Travel Place</label>
                    <select name="travel_category_id" id="edit_category" required 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="edit_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" id="edit_title" 
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="edit_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <input type="text" name="description" id="edit_description" 
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>
                <div class="flex space-x-3">
                    <button type="submit" 
                            class="flex-1 bg-indigo-600 border border-transparent rounded-md py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update
                    </button>
                    <button type="button" onclick="closeEditModal()" 
                            class="flex-1 bg-gray-300 border border-transparent rounded-md py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editPhoto(photoId) {
    // Fetch photo data and populate form
    fetch(`/admin/travel-photos/${photoId}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_category').value = data.travel_category_id;
            document.getElementById('edit_title').value = data.title || '';
            document.getElementById('edit_description').value = data.description || '';
            
            document.getElementById('editForm').action = `/admin/travel-photos/${photoId}`;
            document.getElementById('editModal').classList.remove('hidden');
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endsection
