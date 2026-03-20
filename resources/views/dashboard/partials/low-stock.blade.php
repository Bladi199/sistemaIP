<div class="overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                <th class="px-6 py-4 text-left">Producto</th>
                <th class="px-6 py-4 text-center">Stock Actual</th>
                <th class="px-6 py-4 text-center">Mínimo</th>
                <th class="px-6 py-4 text-center">Acción</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse ($data['low_stock_products'] as $product)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-6 py-5">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $product->name }}</span>
                            <span class="text-[10px] font-bold text-slate-400 tracking-widest">{{ $product->code ?? 'S/C' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-xl font-black text-red-600">{{ $product->stock_actual }}</span>
                            <span class="text-[9px] font-black text-red-400 uppercase">Agotándose</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1 rounded-lg">
                            Límite: {{ $product->stock_minimo }}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white border border-slate-200 text-slate-400 hover:text-black hover:border-black transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-slate-400 font-bold uppercase text-[10px] tracking-widest">
                        No hay alertas críticas en este momento
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>