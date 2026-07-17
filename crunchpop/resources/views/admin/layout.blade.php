<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — CrunchPop</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=baloo-2:600,700,800|nunito:400,600,700,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-berry-50 text-ink antialiased">
@php
    $links = [
        ['admin.dashboard', '📊 Dashboard', 'admin.dashboard'],
        ['admin.products.index', '🍬 Products', 'admin.products.*'],
        ['admin.orders.index', '📦 Orders', 'admin.orders.*'],
        ['admin.custom-orders.index', '🎉 Custom Orders', 'admin.custom-orders.*'],
        ['admin.early-list.index', '📝 Early List', 'admin.early-list.*'],
        ['admin.contacts.index', '💌 Messages', 'admin.contacts.*'],
    ];
@endphp

<div class="flex min-h-screen flex-col lg:flex-row">
    {{-- Sidebar --}}
    <aside class="flex flex-col border-b border-berry-100 bg-white lg:w-64 lg:border-b-0 lg:border-r">
        <div class="flex items-center justify-between p-5">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <span class="grid h-9 w-9 place-items-center rounded-xl bg-berry-500 text-xl">🍬</span>
                <span class="font-display text-lg font-extrabold text-berry-600">CrunchPop</span>
            </a>
            <button type="button" data-nav-toggle aria-label="Menu" class="grid h-10 w-10 place-items-center rounded-full ring-1 ring-berry-100 lg:hidden">☰</button>
        </div>
        <nav data-nav-menu class="hidden flex-col gap-1 p-3 lg:flex">
            @foreach ($links as [$route, $label, $pattern])
                <a href="{{ route($route) }}"
                   class="rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs($pattern) ? 'bg-berry-500 text-white shadow' : 'text-ink/70 hover:bg-berry-50' }}">
                    {{ $label }}
                </a>
            @endforeach
            <a href="{{ route('home') }}" target="_blank" class="mt-2 rounded-2xl px-4 py-3 text-sm font-bold text-ink/50 hover:bg-berry-50">🔗 View site</a>
        </nav>
        <div class="mt-auto hidden border-t border-berry-100 p-3 lg:block">
            <p class="px-4 text-xs text-ink/50">{{ auth()->user()->name }}</p>
            <form action="{{ route('admin.logout') }}" method="POST">@csrf
                <button class="mt-1 w-full rounded-2xl px-4 py-2.5 text-left text-sm font-bold text-berry-600 hover:bg-berry-50">↩ Sign out</button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1">
        @if (session('success') || session('error'))
            <div class="px-6 pt-6">
                @if (session('success'))
                    <div data-flash class="rounded-2xl bg-lime-500 px-5 py-3 font-bold text-white shadow">✅ {{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div data-flash class="rounded-2xl bg-berry-500 px-5 py-3 font-bold text-white shadow">⚠️ {{ session('error') }}</div>
                @endif
            </div>
        @endif

        @if ($errors->any())
            <div class="px-6 pt-6">
                <div class="rounded-2xl bg-tangerine-500 px-5 py-3 text-white shadow">
                    <ul class="list-inside list-disc text-sm font-semibold">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            </div>
        @endif

        <main class="p-6 lg:p-10">
            <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                <h1 class="font-display text-3xl font-extrabold text-ink">@yield('heading', 'Admin')</h1>
                @yield('actions')
            </div>
            @yield('content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
