@extends('layouts.guest')

@section('title', 'Recuperar Contraseña')

@section('content')
<div class="max-w-md mx-auto mt-10">

    <h2 class="text-xl font-bold mb-4 text-center">
        Recuperar contraseña
    </h2>

    <p class="text-sm text-gray-600 mb-4 text-center">
        Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label>Email</label>
            <input type="email" name="email" required
                class="w-full border rounded p-2 mt-1">
        </div>

        <button type="submit"
            class="mt-4 w-full bg-black text-white py-2 rounded">
            Enviar enlace
        </button>
    </form>

</div>
@endsection
