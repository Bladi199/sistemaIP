@php $products = $data['top_products'] ?? collect(); @endphp

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/30">
        <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Productos con Mayor Existencia</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Código</th>
                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Descripción del Producto</th>
                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest text-center">Stock Actual</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($products as $product)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-[10px] font-black text-slate-500 group-hover:text-slate-900 uppercase">
                                {{ $product->code ?? '—' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs font-black text-slate-800 uppercase tracking-tight">
                            {{ $product->name ?? '—' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-block min-w-[60px] text-[11px] font-black text-[#0f172a] bg-slate-100 px-3 py-1 rounded-full">
                                {{ number_format($product->stock_actual ?? 0) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            No se encontraron registros activos
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>