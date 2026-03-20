@php $mostMoved = $data['most_moved_products'] ?? collect(); @endphp

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden mt-6">
    <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/30">
        <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">
            Productos con Mayor Flujo
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Rank</th>
                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Producto</th>
                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest text-center">Entradas</th>
                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest text-center">Salidas</th>
                    <th class="px-6 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest text-right">Total Neto</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($mostMoved as $index => $row)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-[10px] font-black text-slate-300 group-hover:text-slate-900 transition-colors">
                                0{{ $index + 1 }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-slate-800 uppercase tracking-tight">{{ $row->product_name }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">{{ $row->product_code }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-[11px] font-black text-emerald-500 bg-emerald-50 px-2 py-1 rounded-md">
                                +{{ $row->entries }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-[11px] font-black text-rose-500 bg-rose-50 px-2 py-1 rounded-md">
                                -{{ $row->exits }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-black text-slate-900 text-xs">
                            {{ number_format($row->total, 0) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            Sin registros en el periodo seleccionado
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>