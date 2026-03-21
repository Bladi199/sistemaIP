@extends('layouts.app')

@section('title', 'Entrada de Inventario')

@section('content')
<div class="max-w-4xl mx-auto py-8">

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-6">Entrada de Producto</h2>

     <form method="POST" action="{{ route('inventory.entry.store') }}">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <label>Producto</label>
    <input type="text" disabled value="{{ $product->name }}">

    <label>Motivo</label>
    <select name="movement_reason_id" required>
        @foreach($reasons as $reason)
            <option value="{{ $reason->id }}">{{ $reason->name }}</option>
        @endforeach
    </select>

    <label>Cantidad</label>
    <input type="number" name="quantity" min="1" required>

    <label>Observación</label>
    <textarea name="notes"></textarea>

    <button type="submit">Registrar Entrada</button>
</form>




        {{-- FIN FORM --}}
    </div>
</div>
@endsection
