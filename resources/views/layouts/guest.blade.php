<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'PRETENFORT') }}</title>

    {{-- Fonts: Inter es más moderna para sistemas de gestión que Figtree --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Suavizado de transiciones para el toggle y botones */
        .transition-all { transition-duration: 300ms; }
    </style>
</head>

<body class="antialiased bg-white text-slate-900">
    
    {{-- 
        Eliminamos los contenedores restrictivos (max-w-md, bg-gray-100) 
        para permitir que el diseño de pantalla dividida ocupe todo el ancho.
    --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

</body>
</html>