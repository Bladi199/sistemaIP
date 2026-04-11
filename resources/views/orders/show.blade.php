@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto p-6 bg-white rounded-2xl shadow space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center border-b pb-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">
                Sistema Inventario
            </h1>
            <p class="text-xs text-slate-500">
                Pedido / Factura
            </p>
        </div>

        <div class="text-right">
            <h2 class="text-xl font-black">
                Pedido #{{ $order->id }}
            </h2>
            <p class="text-xs text-slate-500">
                Fecha: {{ \Carbon\Carbon::parse($order->fecha_pedido)->format('d/m/Y H:i') }}
            </p>
            <p class="text-xs text-slate-500">
                Estado: <span class="font-semibold text-teal-600">{{ $order->estado }}</span>
            </p>
        </div>
    </div>


    {{-- CLIENTE --}}
    <div class="grid grid-cols-2 gap-6 text-sm">

        <div>
            <h3 class="font-bold text-slate-700 mb-2">Datos del Cliente</h3>

            <p><strong>Nombre:</strong> {{ $order->customer->name }}</p>
            <p><strong>Razón Social:</strong> {{ $order->customer->razon_social ?? '-' }}</p>
            <p><strong>NIT:</strong> {{ $order->customer->nit ?? '-' }}</p>
        </div>

        <div>
            <h3 class="font-bold text-slate-700 mb-2">Contacto</h3>

            <p><strong>Teléfono:</strong> {{ $order->customer->telefono ?? '-' }}</p>
            <p><strong>Dirección:</strong> {{ $order->customer->direccion ?? '-' }}</p>
            <p><strong>Atendido por:</strong> {{ $order->user->name }}</p>
        </div>

    </div>


    {{-- TABLA PRODUCTOS --}}
    <div class="mt-4">
        <table class="w-full border border-slate-200 rounded-xl overflow-hidden">

            <thead class="bg-slate-100 text-xs text-slate-600 uppercase">
                <tr>
                    <th class="p-3 text-left">Producto</th>
                    <th class="p-3 text-center">Cantidad</th>
                    <th class="p-3 text-right">Precio Unit.</th>
                    <th class="p-3 text-right">Subtotal</th>
                </tr>
            </thead>

            <tbody class="text-sm">

                @foreach($order->details as $d)
                <tr class="border-t">
                    <td class="p-3">{{ $d->product->name }}</td>
                    <td class="p-3 text-center">{{ $d->cantidad }}</td>
                    <td class="p-3 text-right">Bs {{ number_format($d->precio_unitario, 2) }}</td>
                    <td class="p-3 text-right font-semibold">
                        Bs {{ number_format($d->subtotal, 2) }}
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>
    </div>


    {{-- TOTALES --}}
    <div class="flex justify-end mt-4">
        <div class="w-64 space-y-2 text-sm">

            <div class="flex justify-between">
                <span>Subtotal:</span>
                <span>Bs {{ number_format($order->total, 2) }}</span>
            </div>

            <div class="flex justify-between">
                <span>Descuento:</span>
                <span>Bs {{ number_format($order->descuento ?? 0, 2) }}</span>
            </div>

            <div class="flex justify-between border-t pt-2 font-bold text-lg">
                <span>Total:</span>
                <span>Bs {{ number_format($order->total, 2) }}</span>
            </div>

        </div>
    </div>


    {{-- OBSERVACIONES --}}
    @if($order->observaciones)
    <div class="mt-4 text-sm">
        <h3 class="font-bold text-slate-700 mb-1">Observaciones</h3>
        <p class="text-slate-600">
            {{ $order->observaciones }}
        </p>
    </div>
    @endif


    {{-- FOOTER --}}
    <div class="text-center text-xs text-slate-400 mt-6 border-t pt-4">
        Documento generado por el sistema de inventario
    </div>
    {{-- BOTONES --}}
<div class="flex justify-end gap-3 mt-6 border-t pt-4">

    {{-- VOLVER --}}
    <a href="{{ route('orders.index') }}"
       class="px-4 py-2 text-sm font-semibold bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
        ← Volver
    </a>

    {{-- GENERAR PDF --}}
    <a href="{{ route('orders.pdf', $order->id) }}"
       class="px-4 py-2 text-sm font-semibold bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">
        📄 Generar PDF
    </a>

</div>

</div>

@endsection