@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 py-16">
    <a href="{{ url()->previous() }}" class="text-sm text-blue-600 hover:underline">← Back</a>

    <div class="mt-4">
        <h1 class="text-3xl font-bold mb-2">Sample Post Title</h1>
        <p class="text-neutral-600 dark:text-neutral-400 mb-8">Published on Sep 1, 2025</p>

        <div class="prose dark:prose-invert max-w-none">
            <p>This is a static post detail page for the user role. Replace this content with your real post data later.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.</p>
        </div>
    </div>
</div>
@endsection


