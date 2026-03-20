@extends('layouts.app')

@section('title', 'Inventario')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 space-y-6">

    {{-- Encabezado Principal --}}
    <div class="flex items-center gap-3 mb-2">
        <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Inventario Maestro</h2>
            <p class="text-sm text-slate-500 font-medium italic">Control de existencias y flujo de materiales en tiempo real.</p>
        </div>
    </div>

    {{-- BARRA DE HERRAMIENTAS NIVELADA --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
        
        {{-- Filtros de Estado (Botones) --}}
        <div class="flex items-center gap-2">
            <button class="px-4 py-2.5 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-md transition-all active:scale-95">
                Todos
            </button>
            <button class="px-4 py-2.5 bg-slate-50 text-slate-500 border border-gray-100 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-100 transition-all">
                Nivel Crítico
            </button>
            <button class="px-4 py-2.5 bg-slate-50 text-slate-500 border border-gray-100 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-100 transition-all">
                Stock Alto
            </button>
        </div>

        {{-- Grupo de Búsqueda y Selección --}}
        <div class="flex flex-col sm:flex-row items-center gap-3 flex-1 lg:justify-end">
            
            {{-- Selector de Productos Específicos --}}
            <div class="relative w-full sm:w-64">
                <select class="w-full pl-4 pr-10 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-[11px] font-bold uppercase tracking-tight text-slate-700 appearance-none focus:ring-2 focus:ring-[#00A59A]/20 focus:border-[#00A59A] transition-all cursor-pointer">
                    <option value="">Filtrar por Producto...</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
                <span class="absolute right-3 top-3 text-slate-400 pointer-events-none text-xs">▼</span>
            </div>

            {{-- Buscador de Texto --}}
            <div class="relative w-full sm:w-80 group">
                <span class="absolute left-4 top-3 text-slate-400 transition-colors group-focus-within:text-[#00A59A]">🔍</span>
                <input type="text" 
                       placeholder="BUSCAR POR CÓDIGO O CATEGORÍA..." 
                       class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-gray-200 rounded-xl text-[11px] font-bold uppercase tracking-widest text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-[#00A59A]/20 focus:border-[#00A59A] transition-all outline-none">
            </div>
        </div>
    </div>

    {{-- Tabla de Inventario --}}
    <div class="bg-white shadow-sm rounded-3xl border border-gray-100 overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-gray-50">
                    <th class="px-6 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Producto</th>
                    <th class="px-6 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Existencia Actual</th>
                    <th class="px-6 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Límites (Mín/Máx)</th>
                    <th class="px-6 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Estado de Nivel</th>
                    <th class="px-6 py-5 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Gestión de Stock</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach ($products as $product)
                <tr class="group hover:bg-slate-50/30 transition-all">
                    <td class="px-6 py-5">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-slate-900 uppercase tracking-tighter">{{ $product->name }}</span>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[9px] font-black text-[#00A59A] uppercase bg-teal-50 px-1.5 py-0.5 rounded">{{ $product->category->name ?? 'S/C' }}</span>
                                <span class="text-[9px] font-medium text-slate-400 italic font-serif">📍 {{ $product->warehouse->name ?? 'Sin Ubicación' }}</span>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-5 text-center text-2xl font-black text-slate-900 tracking-tighter">
                        {{ $product->stock_actual }}
                    </td>

                    <td class="px-6 py-5 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <div class="flex flex-col items-center">
                                <span class="text-[8px] font-black text-slate-300 uppercase">Mín</span>
                                <span class="text-xs font-bold text-slate-600">{{ $product->stock_minimo }}</span>
                            </div>
                            <div class="w-[1px] h-6 bg-slate-100"></div>
                            <div class="flex flex-col items-center">
                                <span class="text-[8px] font-black text-slate-300 uppercase">Máx</span>
                                <span class="text-xs font-bold text-slate-600">{{ $product->stock_maximo }}</span>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-5 text-center">
                        @if ($product->stock_actual <= $product->stock_minimo)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-rose-600 bg-rose-50 rounded-full border border-rose-100 animate-pulse">
                                🚨 Crítico
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 rounded-full border border-emerald-100">
                                ✓ Estable
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="openEntryModal({{ $product->id }}, '{{ $product->name }}')"
                                    class="bg-slate-900 hover:bg-[#00A59A] text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm active:scale-95">
                                Entrada
                            </button>
                            <button onclick="openExitModal({{ $product->id }}, '{{ $product->name }}')"
                                    class="bg-white border border-slate-200 text-slate-700 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-100 px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm active:scale-95">
                                Salida
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('inventory.partials.entry-modal')
@include('inventory.partials.exit-modal')
@endsection


<script>
function openEntryModal(id, name) {
    document.getElementById('entry_product_id').value = id;
    document.getElementById('entry_product_name').value = name;
    document.getElementById('entryModal').classList.remove('hidden');
}

function closeEntryModal() {
    document.getElementById('entryModal').classList.add('hidden');
}

function openExitModal(id, name) {
    document.getElementById('exit_product_id').value = id;
    document.getElementById('exit_product_name').value = name;
    document.getElementById('exitModal').classList.remove('hidden');
}

function closeExitModal() {
    document.getElementById('exitModal').classList.add('hidden');
}
</script>
@if(request('openEntry'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        openEntryModal(
            {{ request('openEntry') }},
            "{{ $products->firstWhere('id', request('openEntry'))->name ?? '' }}"
        );
    });
    document.addEventListener("DOMContentLoaded", function() {
    if (window.location.search.includes('openEntry')) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});
</script>
@endif





