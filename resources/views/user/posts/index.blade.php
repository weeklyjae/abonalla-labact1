@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-5xl px-4 sm:px-6 py-16">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Posts</h1>
        <a href="{{ route('user.posts.create') }}" class="px-3 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">New Post</a>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @for($i = 1; $i <= 6; $i++)
        <a href="{{ route('user.posts.show', ['id' => $i]) }}" class="block rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:bg-neutral-50 dark:hover:bg-neutral-900">
            <h2 class="text-lg font-semibold">Sample Post {{ $i }}</h2>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Click to view details</p>
        </a>
        @endfor
    </div>
</div>
@endsection


