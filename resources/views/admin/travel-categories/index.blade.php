@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    Travel Places
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Create and manage travel place groups to organize your photos
                </p>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent p-6 lg:p-8">
                <!-- Admin Navigation -->
                <x-admin-nav />
                
                <!-- Add New Place Form -->
                <div class="mb-8">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Create New Travel Place</h2>
                    <form method="POST" action="{{ route('admin.travel-categories.store') }}" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Place Name</label>
                                <input type="text" name="name" id="name" required 
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                       placeholder="e.g., Bangkok Trip, Paris Adventure">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <input type="text" name="description" id="description" 
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                       placeholder="Short description of this place">
                            </div>
                        </div>
                        <div>
                            <button type="submit" 
                                    class="bg-indigo-600 border border-transparent rounded-md py-2 px-4 flex items-center justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create Place
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Places List -->
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Your Travel Places</h2>
                    @if($categories->count() > 0)
                        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($categories as $category)
                                    <li class="px-6 py-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900">
                                                        <span class="text-sm font-medium leading-none text-indigo-800 dark:text-indigo-200">
                                                            {{ strtoupper(substr($category->name, 0, 1)) }}
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {{ $category->name }}
                                                    </div>
                                                    @if($category->description)
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $category->description }}
                                                        </div>
                                                    @endif
                                                    <div class="text-xs text-gray-400 dark:text-gray-500">
                                                        {{ $category->photos->count() }} photos
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <button onclick="editPlace({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')" 
                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Edit
                                                </button>
                                                <form method="POST" action="{{ route('admin.travel-categories.destroy', $category) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            onclick="return confirm('Are you sure you want to delete this place? All photos will also be deleted.')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="h-16 w-16 mx-auto rounded-full bg-gray-100 dark:bg-gray-800 grid place-items-center">
                                <span class="text-2xl">✈️</span>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">No travel places yet</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Create your first travel place to get started organizing your photos.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Place Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Edit Travel Place</h3>
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Place Name</label>
                    <input type="text" name="name" id="edit_name" required 
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
function editPlace(id, name, description) {
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_description').value = description || '';
    document.getElementById('editForm').action = `/admin/travel-categories/${id}`;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endsection
