@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    Coding Projects Management
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Upload and manage images of your coding projects
                </p>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent p-6 lg:p-8">
                <!-- Admin Navigation -->
                <x-admin-nav />

                <!-- Toolbar -->
                <div class="flex justify-end mb-4 gap-2">
                    <a href="{{ route('admin.coding.create') }}" class="px-3 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Add Project</a>
                    <a href="{{ route('admin.coding.edit', ['id' => 1]) }}" class="px-3 py-2 rounded-md bg-neutral-200 dark:bg-neutral-700 text-neutral-900 dark:text-white hover:bg-neutral-300 dark:hover:bg-neutral-600">Edit Project</a>
                </div>

                <!-- Static list mirroring public /coding -->
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
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900">
                <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mt-4">Delete Image</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Are you sure you want to delete this project image? This action cannot be undone.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirmDelete" 
                        class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-24 mr-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Delete
                </button>
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentDeleteFilename = '';

function deleteImage(filename) {
    currentDeleteFilename = filename;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    currentDeleteFilename = '';
}

document.getElementById('confirmDelete').addEventListener('click', function() {
    if (currentDeleteFilename) {
        // Create and submit delete form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ route('admin.coding.destroy', ['filename' => 'FILENAME_PLACEHOLDER']) }}`
            .replace('FILENAME_PLACEHOLDER', currentDeleteFilename);
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
    
    closeDeleteModal();
});

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
