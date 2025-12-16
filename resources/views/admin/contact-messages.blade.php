@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Contact Submissions</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Review messages sent through the public contact form.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">← Back to Dashboard</a>
                    <a href="{{ route('admin.contact-messages.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Submission
                    </a>
                </div>
            </div>

            <div class="p-6">
                @if ($messages->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">No contact submissions yet.</p>
                    </div>
                @else
                    <div class="space-y-10">
                        <div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Message</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Image</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Received</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($messages as $message)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $message->name }}</div>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <a href="mailto:{{ $message->email }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">{{ $message->email }}</a>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ Str::limit($message->message, 120) }}</p>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    @if($message->images)
                                                        @php
                                                            $images = json_decode($message->images, true);
                                                        @endphp
                                                        @if(is_array($images) && count($images) > 0)
                                                            <div class="flex flex-wrap gap-1">
                                                                @foreach($images as $index => $image)
                                                                    <img src="{{ asset($image) }}" 
                                                                         alt="Uploaded image" 
                                                                         class="h-12 w-12 rounded-lg object-cover border border-gray-200 dark:border-gray-600 hover:opacity-80 transition cursor-pointer"
                                                                         onclick="openImageModal('{{ asset($image) }}', {{ json_encode($images) }}, {{ $index }})">
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <span class="text-xs text-gray-400 dark:text-gray-500">No images</span>
                                                        @endif
                                                    @elseif($message->image_path)
                                                        <img src="{{ asset($message->image_path) }}" 
                                                             alt="Uploaded image" 
                                                             class="h-12 w-12 rounded-lg object-cover border border-gray-200 dark:border-gray-600 hover:opacity-80 transition cursor-pointer"
                                                             onclick="openImageModal('{{ asset($message->image_path) }}', ['{{ $message->image_path }}'], 0)">
                                                    @else
                                                        <span class="text-xs text-gray-400 dark:text-gray-500">No images</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $message->created_at->format('M d, Y h:i A') }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <div class="flex items-center gap-2">
                                                        <button type="button" class="inline-flex items-center px-3 py-1 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/40 rounded-full hover:bg-indigo-100 dark:hover:bg-indigo-900/60 transition" x-data="{}" @click="$dispatch('open-edit', {{ $message->toJson() }})">Edit</button>
                                                        {{-- Soft delete (archive) the message --}}
                                                        <button type="button" onclick="confirmArchive({{ $message->id }})" class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/40 rounded-full hover:bg-red-100 dark:hover:bg-red-900/60 transition">Archive</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6 flex items-center justify-between gap-3 flex-wrap text-sm text-gray-600 dark:text-gray-300">
                                <div>
                                    Page {{ $messages->currentPage() }} of {{ $messages->lastPage() }}
                                </div>
                                <div>
                                    {{ $messages->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Archived Submissions</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Restore or permanently remove archived messages.</p>
                </div>
            </div>

            <div class="p-6">
                @if ($archived->isEmpty())
                    <div class="text-center py-8 border border-dashed border-gray-300 dark:border-gray-600 rounded-lg">
                        <p class="text-gray-500 dark:text-gray-400">No archived submissions.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Message</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Image</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Archived</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($archived as $message)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $message->name }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <a href="mailto:{{ $message->email }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">{{ $message->email }}</a>
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ Str::limit($message->message, 120) }}</p>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            @if($message->images)
                                                @php
                                                    $images = json_decode($message->images, true);
                                                @endphp
                                                @if(is_array($images) && count($images) > 0)
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach($images as $index => $image)
                                                            <img src="{{ asset($image) }}" 
                                                                 alt="Uploaded image" 
                                                                 class="h-12 w-12 rounded-lg object-cover border border-gray-200 dark:border-gray-600 hover:opacity-80 transition cursor-pointer"
                                                                 onclick="openImageModal('{{ asset($image) }}', {{ json_encode($images) }}, {{ $index }})">
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-xs text-gray-400 dark:text-gray-500">No images</span>
                                                @endif
                                            @elseif($message->image_path)
                                                <img src="{{ asset($message->image_path) }}" 
                                                     alt="Uploaded image" 
                                                     class="h-12 w-12 rounded-lg object-cover border border-gray-200 dark:border-gray-600 hover:opacity-80 transition cursor-pointer"
                                                     onclick="openImageModal('{{ asset($message->image_path) }}', ['{{ $message->image_path }}'], 0)">
                                            @else
                                                <span class="text-xs text-gray-400 dark:text-gray-500">No images</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ optional($message->deleted_at)->format('M d, Y h:i A') }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                {{-- Restore the archived message --}}
                                                <button type="button" onclick="confirmRestore({{ $message->id }})" class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/40 rounded-full hover:bg-green-100 dark:hover:bg-green-900/60 transition">Restore</button>
                                                {{-- Permanently delete the archived message --}}
                                                <button type="button" onclick="confirmDelete({{ $message->id }})" class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/40 rounded-full hover:bg-red-100 dark:hover:bg-red-900/60 transition">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @endif

                <div class="mt-6 flex items-center justify-between gap-3 flex-wrap text-sm text-gray-600 dark:text-gray-300">
                    <div>
                        @if ($archived->total() > 0)
                            Showing {{ $archived->firstItem() }} to {{ $archived->lastItem() }} of {{ $archived->total() }} results
                        @else
                            No archived results yet.
                        @endif
                    </div>
                    <div>
                        Page {{ $archived->currentPage() }} of {{ max($archived->lastPage(), 1) }}
                    </div>
                    <div class="flex items-center gap-2">
                        {{ $archived->appends(['page' => request('page')])->onEachSide(2)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div id="imagePreviewModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center p-4 transition-opacity duration-300 ease-in-out">
        <div class="relative max-w-6xl max-h-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-2xl transform transition-all duration-300 ease-in-out scale-95 opacity-0" id="modalContent">
            <!-- Close Button -->
            <button onclick="closeImageModal()" class="absolute top-4 right-4 z-10 text-white hover:text-gray-300 transition-colors duration-200">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Navigation Arrows -->
            <button id="prevBtn" onclick="previousImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 text-white hover:text-gray-300 transition-colors duration-200 bg-black bg-opacity-50 rounded-full p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button id="nextBtn" onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 text-white hover:text-gray-300 transition-colors duration-200 bg-black bg-opacity-50 rounded-full p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            
            <!-- Image Container -->
            <div class="relative">
                <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[80vh] mx-auto rounded-lg transition-opacity duration-300 ease-in-out">
                
                <!-- Image Counter -->
                <div id="imageCounter" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-75 text-white px-3 py-1 rounded-full text-sm">
                    <span id="currentIndex">1</span> / <span id="totalImages">1</span>
                </div>
            </div>
        </div>
    </div>

    <template x-if="true">
        <div
            x-data="contactModal()"
            x-on:open-edit.window="open($event.detail)"
            x-cloak
        >
            <div
                x-show="isOpen"
                x-transition.opacity.duration.200ms
                class="fixed inset-0 z-[60] bg-black/60"
                @click="close()"
            ></div>

            <div
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-8"
                class="fixed inset-0 z-[70] flex items-center justify-center px-4"
                role="dialog"
                aria-modal="true"
            >
                <div class="w-full max-w-2xl overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-2xl">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Edit Submission</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Update the details of the selected contact message.</p>
                        </div>
                        <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" @click="close()" aria-label="Close modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <form :action="action" method="POST" class="px-6 py-5 space-y-5">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="edit-name">Name</label>
                                <input x-model="form.name" type="text" name="name" id="edit-name" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="edit-email">Email</label>
                                <input x-model="form.email" type="email" name="email" id="edit-email" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="edit-message">Message</label>
                            <textarea x-model="form.message" name="message" id="edit-message" rows="5" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required></textarea>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition" @click="close()">Cancel</button>
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Image Modal Variables
    let currentImageIndex = 0;
    let imageArray = [];
    let imageBasePaths = [];

    // Image Modal Functions
    function openImageModal(imageSrc, images, index) {
        imageArray = images;
        imageBasePaths = images.map(img => '{{ asset("") }}' + img);
        currentImageIndex = index;
        
        const modal = document.getElementById('imagePreviewModal');
        const modalContent = document.getElementById('modalContent');
        const modalImage = document.getElementById('modalImage');
        const currentIndexSpan = document.getElementById('currentIndex');
        const totalImagesSpan = document.getElementById('totalImages');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        // Set image source
        modalImage.src = imageSrc;
        
        // Update counter
        currentIndexSpan.textContent = currentImageIndex + 1;
        totalImagesSpan.textContent = imageArray.length;
        
        // Show/hide navigation buttons
        prevBtn.style.display = imageArray.length > 1 ? 'block' : 'none';
        nextBtn.style.display = imageArray.length > 1 ? 'block' : 'none';
        
        // Show modal with fade in animation
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.style.opacity = '1';
            modalContent.style.opacity = '1';
            modalContent.style.transform = 'scale(1)';
        }, 10);
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        const modal = document.getElementById('imagePreviewModal');
        const modalContent = document.getElementById('modalContent');
        
        // Fade out animation
        modal.style.opacity = '0';
        modalContent.style.opacity = '0';
        modalContent.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    function nextImage() {
        if (imageArray.length <= 1) return;
        
        currentImageIndex = (currentImageIndex + 1) % imageArray.length;
        updateModalImage();
    }

    function previousImage() {
        if (imageArray.length <= 1) return;
        
        currentImageIndex = (currentImageIndex - 1 + imageArray.length) % imageArray.length;
        updateModalImage();
    }

    function updateModalImage() {
        const modalImage = document.getElementById('modalImage');
        const currentIndexSpan = document.getElementById('currentIndex');
        
        // Fade out current image
        modalImage.style.opacity = '0';
        
        setTimeout(() => {
            modalImage.src = imageBasePaths[currentImageIndex];
            currentIndexSpan.textContent = currentImageIndex + 1;
            
            // Fade in new image
            modalImage.style.opacity = '1';
        }, 150);
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('imagePreviewModal');
        if (modal.classList.contains('hidden')) return;
        
        switch(e.key) {
            case 'Escape':
                closeImageModal();
                break;
            case 'ArrowLeft':
                previousImage();
                break;
            case 'ArrowRight':
                nextImage();
                break;
        }
    });

    // Close modal when clicking outside
    document.getElementById('imagePreviewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Archive confirmation
    function confirmArchive(messageId) {
        Swal.fire({
            title: 'Archive Message?',
            text: "This message will be moved to archived submissions.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, archive it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create and submit form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('admin.contact-messages.destroy', '__ID__') }}`.replace('__ID__', messageId);
                
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
        });
    }

    // Restore confirmation
    function confirmRestore(messageId) {
        Swal.fire({
            title: 'Restore Message?',
            text: "This message will be moved back to active submissions.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, restore it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create and submit form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('admin.contact-messages.restore', '__ID__') }}`.replace('__ID__', messageId);
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                form.appendChild(csrfToken);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Delete confirmation
    function confirmDelete(messageId) {
        Swal.fire({
            title: 'Permanently Delete?',
            text: "This action cannot be undone! The message will be permanently deleted.",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create and submit form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('admin.contact-messages.force-delete', '__ID__') }}`.replace('__ID__', messageId);
                
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
        });
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('contactModal', () => ({
            isOpen: false,
            action: '',
            form: {
                name: '',
                email: '',
                message: '',
            },
            open(data) {
                this.isOpen = true;
                this.action = `{{ route('admin.contact-messages.update', '__ID__') }}`.replace('__ID__', data.id);
                this.form = {
                    name: data.name ?? '',
                    email: data.email ?? '',
                    message: data.message ?? '',
                };
                document.body.classList.add('overflow-hidden');
            },
            close() {
                this.isOpen = false;
                setTimeout(() => {
                    document.body.classList.remove('overflow-hidden');
                }, 250);
            },
        }));
    });
</script>
@endpush