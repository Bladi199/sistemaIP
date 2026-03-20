<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Sistema Inventario'))</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    [x-cloak] { display: none !important; }
</style>

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    @include('layouts.navigation')

    {{-- CONTENT AREA --}}
    <div class="flex-1 flex flex-col">

        {{-- TOP NAVBAR --}}
        @include('layouts.navigation-top')

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 bg-gray-100">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>