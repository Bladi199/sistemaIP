@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 space-y-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-3">
            <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
            <div>
                <h2 class="text-2xl font-black text-slate-900 uppercase">Pedidos</h2>
                <p class="text-sm text-slate-500">Gestión de ventas realizadas</p>
            </div>
        </div>

        <a href="{{ route('orders.create') }}"
           class="px-6 py-2 bg-teal-custom text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition">
            + Nuevo Pedido
        </a>
    </div>

    {{-- TABLA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <table class="min-w-full divide-y divide-gray-100">

            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase">Cliente</th>
                    <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase">Fecha</th>
                    <th class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase">Total</th>
                    <th class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase">Estado</th>
                    <th class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">

                @forelse ($orders as $o)
                <tr class="hover:bg-slate-50">

                    {{-- ID --}}
                    <td class="px-6 py-4 font-bold text-slate-700">
                        #{{ $o->id }}
                    </td>

                    {{-- CLIENTE --}}
                    <td class="px-6 py-4 text-sm font-bold text-slate-900">
                        {{ $o->customer->name }}
                    </td>

                    {{-- FECHA --}}
                    <td class="px-6 py-4 text-xs text-slate-500">
                        {{ $o->created_at->format('d/m/Y H:i') }}
                    </td>

                    {{-- TOTAL --}}
                    <td class="px-6 py-4 text-center font-black text-teal-custom">
                        Bs {{ number_format($o->total,2) }}
                    </td>

                    {{-- ESTADO --}}
                    <td class="px-6 py-4 text-center">

                        @if($o->estado == 'pendiente')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-600">
                                Pendiente
                            </span>
                        @elseif($o->estado == 'cancelado')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-600">
                                Cobrado
                            </span>
                        @elseif($o->estado == 'parcial')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-600">
                                Parcial
                            </span>
                        @endif

                    </td>

                    {{-- ACCIONES --}}
                    <td class="px-6 py-4">
    <div class="flex justify-center items-center gap-2">

        {{-- VER --}}
        <a href="{{ route('orders.show',$o) }}"
           class="w-20 text-center text-xs px-3 py-1 bg-slate-100 rounded-lg font-bold hover:bg-slate-200">
            Ver
        </a>

        {{-- COBRAR --}}
        @if($o->estado == 'pendiente')
            <form action="{{ route('orders.pay',$o) }}" method="POST">
                @csrf
                <button
                    class="w-20 text-center text-xs px-3 py-1 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700">
                    Cobrar
                </button>
            </form>
        @else
            {{-- ESPACIO RESERVADO PARA NO MOVER --}}
            <div class="w-20"></div>
        @endif

        {{-- ELIMINAR --}}
        <form action="{{ route('orders.destroy',$o) }}" method="POST">
            @csrf @method('DELETE')
            <button
                class="w-20 text-center text-xs px-3 py-1 bg-red-100 text-red-600 rounded-lg font-bold hover:bg-red-200">
                Eliminar
            </button>
        </form>

    </div>
</td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-slate-300">
                        Sin pedidos registrados
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>

</div>
@endsection