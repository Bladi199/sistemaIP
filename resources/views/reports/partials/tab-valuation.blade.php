<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
        <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">
            Valorización Activa del Inventario
        </h3>
        <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full uppercase">
            Total Bs. {{ number_format(collect($data['top_products'])->sum(fn($p) => $p->stock_actual * $p->precio_unitario), 2) }}
        </span>
    </div>

    <div class="p-6 space-y-6">
        @foreach($data['top_products'] as $p)
            @php
                $total = $p->stock_actual * $p->precio_unitario;
                // Calculamos un porcentaje real basado en el máximo para que la barra tenga sentido
                $maxTotal = collect($data['top_products'])->max(fn($prod) => $prod->stock_actual * $prod->precio_unitario) ?: 1;
                $percentage = ($total / $maxTotal) * 100;
            @endphp

            <div class="group">
                <div class="flex justify-between items-end mb-2">
                    <div class="flex flex-col">
                        <span class="text-[11px] font-black text-slate-800 uppercase tracking-tight">
                            {{ $p->name }}
                        </span>
                        <span class="text-[9px] font-bold text-slate-400 uppercase">
                            Stock: {{ $p->stock_actual }} unidades
                        </span>
                    </div>

                    <div class="text-right">
                        <span class="text-[11px] font-black text-slate-900">
                            Bs {{ number_format($total, 2) }}
                        </span>
                    </div>
                </div>

                <div class="w-full bg-slate-50 rounded-full h-1.5 overflow-hidden border border-slate-100">
                    <div class="bg-[#0f172a] group-hover:bg-emerald-500 h-full rounded-full transition-all duration-500"
                         style="width: {{ $percentage }}%">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>