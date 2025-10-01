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
                <a href="{{ route('admin.home') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">← Back to Dashboard</a>
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
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $message->created_at->format('M d, Y h:i A') }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <div class="flex items-center gap-2">
                                                        <button type="button" class="inline-flex items-center px-3 py-1 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/40 rounded-full hover:bg-indigo-100 dark:hover:bg-indigo-900/60 transition" x-data="{}" @click="$dispatch('open-edit', {{ $message->toJson() }})">Edit</button>
                                                        <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/40 rounded-full hover:bg-red-100 dark:hover:bg-red-900/60 transition">Archive</button>
                                                        </form>
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

                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Archived Submissions</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Restore or permanently remove archived messages.</p>
                            </div>

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
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        {{ optional($message->deleted_at)->format('M d, Y h:i A') }}
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap">
                                                        <div class="flex items-center gap-2">
                                                            <form action="{{ route('admin.contact-messages.restore', $message->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/40 rounded-full hover:bg-green-100 dark:hover:bg-green-900/60 transition">Restore</button>
                                                            </form>
                                                            <form action="{{ route('admin.contact-messages.force-delete', $message->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/40 rounded-full hover:bg-red-100 dark:hover:bg-red-900/60 transition">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-6 flex items-center justify-between gap-3 flex-wrap text-sm text-gray-600 dark:text-gray-300">
                                    <div>
                                        Page {{ $archived->currentPage() }} of {{ $archived->lastPage() }}
                                    </div>
                                    <div>
                                        {{ $archived->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
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
<script>
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

