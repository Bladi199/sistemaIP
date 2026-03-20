@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Encabezado con estilo de Dashboard --}}
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Categorías</h2>
                <p class="text-sm text-slate-500 font-medium italic">Clasificación lógica de productos y materiales.</p>
            </div>
        </div>

        <a href="{{ route('categories.create') }}"
           class="px-6 py-3 bg-slate-900 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-md flex items-center gap-2">
            <span>+ Nueva Categoria</span>
        </a>
    </div>

    {{-- Contenedor de Tabla --}}
    <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b border-gray-50">
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Nombre</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Descripción</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Stock Total</th>
                    <th class="px-6 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($categories as $category)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <span class="text-sm font-black text-slate-800 tracking-tight uppercase">{{ $category->name }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-xs text-slate-500 font-medium leading-relaxed">{{ $category->description ?: 'Sin descripción' }}</p>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-slate-100 text-slate-600 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                            {{ $category->products_count }} <span class="ml-1 opacity-60">ITMS</span>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center gap-3">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>

                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta categoría?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection