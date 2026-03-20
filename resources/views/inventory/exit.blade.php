@extends('layouts.app')

@section('title', 'Salida de Inventario')

@section('content')
<div class="max-w-4xl mx-auto py-8">

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-6">Salida de Producto</h2>

        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-800 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('inventory.exit.store') }}">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="mb-4">
                <label class="block text-sm font-medium">Producto</label>
                <input type="text" disabled value="{{ $product->name }}"
                       class="w-full bg-gray-100 rounded-md">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Motivo</label>
                <select name="movement_reason_id" required class="w-full rounded-md">
                    @foreach($reasons as $reason)
                        <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Cantidad</label>
                <input type="number" name="quantity" min="1" required class="w-full rounded-md">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Observación</label>
                <textarea name="notes" class="w-full rounded-md"></textarea>
            </div>

            <div class="flex justify-end">
                <button class="px-4 py-2 bg-red-600 text-white rounded-md">
                    Registrar Salida
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
