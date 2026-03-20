@extends('layouts.guest')

@section('title', config('app.name', 'Laravel'))

@section('content')

<header class="w-full sm:max-w-md text-sm mb-6">
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="inline-block px-5 py-1.5 border border-gray-300 rounded-sm text-sm leading-normal
                           text-gray-800 dark:text-gray-200
                           hover:border-gray-400 dark:border-gray-600 dark:hover:border-gray-500"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 border border-transparent rounded-sm text-sm leading-normal
                           text-gray-800 dark:text-gray-200
                           hover:border-gray-300 dark:hover:border-gray-600"
                >
                    Log innnnnnn
                </a>

            @endauth
        </nav>
    @endif
</header>

@endsection
