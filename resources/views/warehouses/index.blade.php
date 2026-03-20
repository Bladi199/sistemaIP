@extends('layouts.app')

@section('title', 'Ubicaciones')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Encabezado Estilo Dashboard --}}
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Gestión de Ubicaciones</h2>
                <p class="text-sm text-slate-500 font-medium italic">Control de almacenes, sucursales y depósitos físicos.</p>
            </div>
        </div>

        <a href="{{ route('warehouses.create') }}"
           class="px-6 py-3 bg-slate-900 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-md flex items-center gap-2">
            <span>+ Nueva Ubicación</span>
        </a>
    </div>

    {{-- Tabla Premium --}}
    <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="border-b border-gray-50 bg-slate-50/50">
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Almacén</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Ubicación Física</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Variedad Items</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($warehouses as $warehouse)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $warehouse->name }}</span>
                            <span class="text-[10px] text-slate-400 font-medium truncate max-w-[200px]">{{ $warehouse->description ?: 'Sin descripción' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-tighter">
                            <span class="text-blue-500">📍</span>
                            {{ $warehouse->ubicacion }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-slate-100 text-slate-600 group-hover:bg-blue-50 group-hover:text-blue-600 transition-all">
                            {{ $warehouse->products()->count() }} 
                            <span class="ml-1 opacity-50 text-[9px]">SKUS</span>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center gap-2">
                            <a href="{{ route('warehouses.edit', $warehouse) }}"
                               class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>

                            <form action="{{ route('warehouses.destroy', $warehouse) }}" 
                                  method="POST" 
                                  class="inline" 
                                  onsubmit="return confirm('¿Eliminar esta ubicación?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-4xl mb-4">🏢</span>
                            <p class="text-xs font-black uppercase text-slate-400 tracking-widest">No hay ubicaciones registradas</p>
                            <p class="text-[10px] text-slate-400 mt-1 italic">Comienza creando el primer almacén del sistema.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection