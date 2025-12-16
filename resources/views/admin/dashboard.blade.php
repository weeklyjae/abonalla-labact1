@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-2xl border border-blue-100 bg-white shadow-xl">
            <div class="relative p-6 lg:p-8">
                <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
                    <div class="absolute -top-24 -left-20 h-48 w-48 rounded-full bg-sky-300/40 blur-[90px]"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-white via-blue-50 to-transparent"></div>
                    <div class="absolute top-1/4 right-16 h-60 w-60 rounded-full bg-blue-200/40 blur-[110px]"></div>
                </div>
                <h1 class="text-2xl font-semibold text-slate-900">
                    Admin Dashboard
                </h1>
                <p class="mt-2 text-sm text-slate-600">Welcome back, <span class="font-semibold text-slate-800">{{ Auth::user()->name }}</span>! Here’s what’s happening today.</p>
            </div>

            <div class="border-t border-blue-100 bg-gradient-to-br from-blue-50/70 via-white to-sky-50/70 p-6 lg:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)] gap-6">
                    <div class="rounded-xl border border-blue-100 bg-white p-6 lg:p-8 shadow-md">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Quick Navigation</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="{{ route('admin.site-settings') }}" class="flex items-center justify-between gap-3 rounded-lg border border-blue-100 bg-blue-50 px-4 py-3 shadow-sm transition hover:border-blue-300 hover:bg-blue-100">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                                        </svg>
                                    </span>
                                <span class="text-sm font-medium text-slate-800">Site Settings</span>
                                </div>
                                <svg class="h-4 w-4 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 12h13.5m0 0l-5.25-5.25M18.75 12l-5.25 5.25" />
                                </svg>
                            </a>

                            <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center justify-between gap-3 rounded-lg border border-blue-100 bg-blue-50 px-4 py-3 shadow-sm transition hover:border-blue-300 hover:bg-blue-100">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-.621-.504-1.125-1.125-1.125H4.125C3.504 7.125 3 7.629 3 8.25v7.5c0 .621.504 1.125 1.125 1.125h15.75c.621 0 1.125-.504 1.125-1.125v-7.5z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25l-9 6-9-6" />
                                        </svg>
                                    </span>
                                <span class="text-sm font-medium text-slate-800">Contact Messages</span>
                                </div>
                                <svg class="h-4 w-4 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 12h13.5m0 0l-5.25-5.25M18.75 12l-5.25 5.25" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-xl border border-blue-100 bg-white p-6 lg:p-8 h-full flex flex-col shadow-md">
                        <h2 class="text-lg font-semibold text-slate-900 mb-2">Messages at a Glance</h2>
                        <p class="text-sm text-slate-600 mb-4">
                            Keep track of incoming messages straight from the dashboard.
                        </p>
                        <div class="flex items-center justify-between rounded-lg border border-blue-100 bg-white px-5 py-4">
                            <div>
                                <p class="text-sm text-slate-600">Unread messages</p>
                                <p class="text-2xl font-semibold text-slate-900">{{ $unreadMessagesCount ?? 0 }}</p>
                            </div>
                            <a href="{{ route('admin.contact-messages.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition">
                                View messages
                            </a>
                        </div>
                    </div>
                </div>

                @php
                    $trafficData = [
                        ['month' => 'Jan', 'visits' => 180],
                        ['month' => 'Feb', 'visits' => 220],
                        ['month' => 'Mar', 'visits' => 260],
                        ['month' => 'Apr', 'visits' => 310],
                        ['month' => 'May', 'visits' => 340],
                        ['month' => 'Jun', 'visits' => 295],
                        ['month' => 'Jul', 'visits' => 360],
                        ['month' => 'Aug', 'visits' => 410],
                        ['month' => 'Sep', 'visits' => 390],
                        ['month' => 'Oct', 'visits' => 430],
                        ['month' => 'Nov', 'visits' => 460],
                        ['month' => 'Dec', 'visits' => 505],
                    ];
                    $trafficCollection = collect($trafficData);
                    $trafficPeak = $trafficCollection->max('visits');
                    $totalVisits = $trafficCollection->sum('visits');
                    $averageVisits = round($trafficCollection->avg('visits'));
                    $bestMonth = $trafficCollection->sortByDesc('visits')->first();
                    $lastMonth = $trafficCollection->last();
                    $previousMonth = $trafficCollection->reverse()->skip(1)->first();
                    $momentum = $previousMonth && $previousMonth['visits'] > 0
                        ? round((($lastMonth['visits'] - $previousMonth['visits']) / $previousMonth['visits']) * 100, 1)
                        : null;
                @endphp

                <div class="mt-8 rounded-xl border border-blue-100 bg-white p-6 lg:p-8 shadow-md">
                    <div class="flex flex-wrap items-end gap-6">
                        <div class="flex-1 min-w-[220px]">
                            <h3 class="text-lg font-semibold text-slate-900">Site Traffic Overview</h3>
                            <p class="text-sm text-slate-600">Monthly visitor trend across the past year</p>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            <span class="inline-flex h-3 w-3 rounded-full bg-blue-400"></span>
                            <span>Monthly visits</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="rounded-lg border border-blue-100 bg-blue-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-wide text-blue-600">Total Visits</p>
                            <p class="text-xl font-semibold text-slate-900">{{ number_format($totalVisits) }}</p>
                        </div>
                        <div class="rounded-lg border border-blue-100 bg-blue-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-wide text-blue-600">Top Month</p>
                            <p class="text-base font-semibold text-slate-900">{{ $bestMonth['month'] }}</p>
                            <p class="text-sm text-slate-600">{{ number_format($bestMonth['visits']) }} visits</p>
                        </div>
                        <div class="rounded-lg border border-blue-100 bg-blue-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-wide text-blue-600">Monthly Average</p>
                            <p class="text-xl font-semibold text-slate-900">{{ number_format($averageVisits) }}</p>
                            @if(!is_null($momentum))
                                <p class="text-xs text-{{ $momentum >= 0 ? 'emerald' : 'rose' }}-500">
                                    {{ $momentum >= 0 ? '+' : '' }}{{ $momentum }}% vs last month
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 flex items-end gap-3 overflow-x-auto pb-4">
                        @foreach ($trafficData as $point)
                            @php
                                $height = ($point['visits'] / max(1, $trafficPeak)) * 160;
                            @endphp
                            <div class="flex flex-col items-center justify-end gap-2 text-xs text-slate-500">
                                <div class="flex h-[180px] w-10 items-end rounded-lg bg-blue-100/50">
                                    <div class="w-full rounded-t-lg bg-gradient-to-t from-blue-500 via-sky-400 to-sky-200 transition-all duration-500" style="height: {{ number_format($height, 0) }}px"></div>
                                </div>
                                <span class="font-medium text-slate-700">{{ $point['month'] }}</span>
                                <span class="text-slate-600">{{ number_format($point['visits']) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
