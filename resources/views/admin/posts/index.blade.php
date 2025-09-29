@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 sm:px-6 py-16">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="px-3 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Add Post</a>
    </div>

    <div class="overflow-hidden rounded-lg border border-neutral-200 dark:border-neutral-800">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
            <thead class="bg-neutral-50 dark:bg-neutral-900">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium">ID</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Title</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
                @for($i = 1; $i <= 5; $i++)
                <tr>
                    <td class="px-4 py-3 text-sm">{{ $i }}</td>
                    <td class="px-4 py-3 text-sm">Sample Post {{ $i }}</td>
                    <td class="px-4 py-3 text-sm">
                        <a href="{{ route('admin.posts.edit', ['id' => $i]) }}" class="text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection


