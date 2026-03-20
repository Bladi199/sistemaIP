@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        
        <div class="flex items-center gap-3">
            <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Gestión de Productos</h2>
                <p class="text-sm text-slate-500 font-medium">Control total de existencias y parámetros de inventario.</p>
            </div>
        </div>

        <a href="{{ route('products.create') }}"
           class="px-6 py-3 bg-slate-900 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-md flex items-center gap-2">
            <span>+ Nuevo Producto</span>
        </a>
    </div>

    {{-- Filtros y Búsqueda --}}
    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6 flex gap-4">
        <div class="relative flex-1">
            <span class="absolute left-4 top-3 text-slate-400">🔍</span>
            <input type="text" placeholder="Buscar por nombre o código..."
                   class="w-full pl-11 pr-4 py-2.5 rounded-xl border-gray-100 bg-slate-50 focus:bg-white focus:border-[#3B82F6] transition-all text-sm font-medium">
        </div>
    </div>

    {{-- Tabla Premium --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Producto</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Categoría</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Stock</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Estado</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Ubicación</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse ($products as $product)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-900">{{ $product->name }}</span>
                                <span class="text-[10px] font-medium text-slate-400 uppercase">{{ $product->code }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[11px] font-bold uppercase">
                                {{ $product->category->name ?? 'S/C' }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-col items-center">
                                <span class="text-base font-black text-slate-800">{{ $product->stock_actual }}</span>
                                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">Min: {{ $product->stock_minimo }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if ($product->stock_actual <= $product->stock_minimo)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-600">
                                    <span class="w-1 h-1 rounded-full bg-rose-600 mr-1.5 animate-pulse"></span>
                                    Crítico
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-600">
                                    <span class="w-1 h-1 rounded-full bg-emerald-600 mr-1.5"></span>
                                    Normal
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center text-slate-500 font-medium">
                                <span class="mr-2">📍</span> {{ $product->warehouse->name ?? '-' }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="p-2 text-slate-400 hover:text-[#3B82F6] hover:bg-blue-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar producto?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-slate-300 mb-2">📦</div>
                            <p class="text-slate-400 font-medium">No hay productos en el inventario.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection