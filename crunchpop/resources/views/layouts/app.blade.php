<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'CrunchPop Candy') — Field &amp; Pantry</title>
    <meta name="description" content="@yield('meta_description', 'CrunchPop Candy — bright, crunchy freeze-dried candy with a bigger purpose. The fun first step of Field & Pantry LLC, building toward South Florida hurricane preparedness.')">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=baloo-2:600,700,800|nunito:400,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-cream text-ink antialiased"
      @if(session('scroll_to')) data-scroll-to="{{ session('scroll_to') }}" @endif>

    @include('partials.header')

    @include('partials.flash')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
