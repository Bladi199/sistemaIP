@extends('layouts.app')

@section('title', 'Movimiento de Inventario')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

        <h2 class="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-200">
            Movimiento de Inventario
        </h2>

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('inventory.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            {{-- Producto --}}
            <div>
                <label class="block text-sm font-medium mb-1">Producto</label>
                <input type="text" value="{{ $product->name }}" disabled
                       class="w-full rounded-md bg-gray-100 border-gray-300">
            </div>
            {{-- Tipo de Movimiento --}}
            <div>
                <label class="block text-sm font-medium mb-1">Tipo</label>
                <select name="movement_type_id" required
                        class="w-full rounded-md border-gray-300">
                    <option value="">Seleccione tipo</option>
                    @foreach($movementTypes as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Cantidad --}}
            <div>
                <label class="block text-sm font-medium mb-1">Cantidad</label>
                <input type="number" name="quantity" min="1" required
                       class="w-full rounded-md border-gray-300">
                <p class="text-sm text-gray-500 mt-1">
                    Stock actual: {{ $product->stock_actual }} unidades
                </p>
            </div>

            {{-- Motivo --}}
            <div>
                <label class="block text-sm font-medium mb-1">Motivo</label>
                <select name="movement_reason_id" required
                        class="w-full rounded-md border-gray-300">
                    <option value="">Seleccione un motivo</option>
                    @foreach($reasons as $reason)
                        <option value="{{ $reason->id }}">
                            {{ $reason->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Responsable --}}
            <div>
                <label class="block text-sm font-medium mb-1">Responsable</label>
                <input type="text" value="{{ auth()->user()->name }}" disabled
                       class="w-full rounded-md bg-gray-100 border-gray-300">
            </div>

            {{-- Notas --}}
            <div>
                <label class="block text-sm font-medium mb-1">Notas</label>
                <textarea name="notes" rows="2"
                          class="w-full rounded-md border-gray-300"></textarea>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('inventory.index') }}" class="px-4 py-2 border rounded-md">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800">
                    Registrar Movimiento
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
