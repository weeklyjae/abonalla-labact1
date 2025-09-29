@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 py-16">
    <h1 class="text-2xl font-bold mb-6">Add Travel Item (Static)</h1>
    <form action="#" method="post" class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-1">Place</label>
            <input type="text" class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 px-3 py-2" placeholder="e.g., Taiwan" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea rows="4" class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 px-3 py-2" placeholder="Short description..."></textarea>
        </div>
        <button type="button" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save</button>
    </form>
</div>
@endsection





