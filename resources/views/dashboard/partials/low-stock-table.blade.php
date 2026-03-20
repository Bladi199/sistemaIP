<div class="overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                <th class="px-6 py-4 text-left font-black">Producto</th>
                <th class="px-6 py-4 text-center font-black">Stock Actual</th>
                <th class="px-6 py-4 text-center font-black">Mínimo</th>
                <th class="px-6 py-4 text-center font-black">Estado</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse ($data['low_stock_products'] as $product)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-6 py-5">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-slate-900 group-hover:text-red-600 transition-colors uppercase tracking-tight">
                                {{ $product->name }}
                            </span>
                            <span class="text-[10px] font-bold text-slate-400 tracking-widest">
                                {{ $product->code ?? 'NO-CODE' }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-lg font-black text-red-600">
                            {{ $product->stock_actual }}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-lg">
                            MIN: {{ $product->stock_minimo }}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="px-4 py-1.5 bg-red-50 text-red-500 text-[10px] font-black rounded-full uppercase tracking-widest border border-red-100 animate-pulse">
                            ● Crítico
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Stock saludable</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>