@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    Travel Photos Management
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Upload and organize travel photos by places
                </p>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent p-6 lg:p-8">
                <!-- Admin Navigation -->
                <x-admin-nav />

                <!-- Toolbar -->
                <div class="flex justify-end mb-4 gap-2">
                    <a href="{{ route('admin.travel.create') }}" class="px-3 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Add Travel</a>
                    <a href="{{ route('admin.travel.edit', ['id' => 1]) }}" class="px-3 py-2 rounded-md bg-neutral-200 dark:bg-neutral-700 text-neutral-900 dark:text-white hover:bg-neutral-300 dark:hover:bg-neutral-600">Edit Travel</a>
                </div>

                <!-- Static list mirroring public /travel -->
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
            </div>
        </div>
    </div>
</div>

<!-- Photos Modal -->
<div id="photosModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" id="modalTitle">Travel Photos</h3>
                <button onclick="closePhotosModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="photosGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Photos will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function viewPhotos(categoryId) {
    // This would typically fetch photos via AJAX
    // For now, just show the modal
    document.getElementById('photosModal').classList.remove('hidden');
    document.getElementById('modalTitle').textContent = 'Loading photos...';
    
    // You can implement AJAX loading here
    // fetch(`/admin/travel/${categoryId}/photos`)
    //     .then(response => response.json())
    //     .then(data => {
    //         // Populate photos grid
    //     });
}

function closePhotosModal() {
    document.getElementById('photosModal').classList.add('hidden');
}

function deleteCategory(categoryId) {
    if (confirm('Are you sure you want to delete this travel place and all its photos?')) {
        // Create and submit delete form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ route('admin.travel.destroy', ['category' => 'CATEGORY_PLACEHOLDER']) }}`
            .replace('CATEGORY_PLACEHOLDER', categoryId);
        
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
}

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const newPlaceName = document.getElementById('new_place_name').value;
    const newPlaceDescription = document.getElementById('new_place_description').value;
    const existingCategory = document.getElementById('travel_category_id').value;
    
    // Require either new place details OR existing category
    if (!newPlaceName && !existingCategory) {
        e.preventDefault();
        alert('Please either create a new travel place or select an existing one.');
        return false;
    }
    
    if (newPlaceName && !newPlaceDescription) {
        e.preventDefault();
        alert('Please provide a description for the new travel place.');
        return false;
    }
});
</script>
@endsection
