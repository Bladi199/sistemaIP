@extends('layouts.guest')

@section('title', 'Restablecer Contraseña')

@section('content')
<div class="max-w-md mx-auto mt-10">

    <h2 class="text-xl font-bold mb-4 text-center">
        Nueva contraseña
    </h2>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ request()->email }}" required
                class="w-full border rounded p-2 mt-1">
        </div>

        <div class="mt-3">
            <label>Contraseña</label>
            <input type="password" name="password" required
                class="w-full border rounded p-2 mt-1">
        </div>

        <div class="mt-3">
            <label>Confirmar contraseña</label>
            <input type="password" name="password_confirmation" required
                class="w-full border rounded p-2 mt-1">
        </div>

        <button type="submit"
            class="mt-4 w-full bg-black text-white py-2 rounded">
            Cambiar contraseña
        </button>
    </form>

</div>
@endsection
