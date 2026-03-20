@php $categories = $data['by_category'] ?? collect(); @endphp

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/30">
        <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Distribución por Categoría</h3>
    </div>

    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($categories as $category)
            <div class="flex items-center justify-between p-4 rounded-xl border border-slate-50 bg-slate-50/30 hover:bg-white hover:border-slate-200 transition-all group">
                <div class="flex flex-col">
                    <span class="text-xs font-black text-slate-800 uppercase tracking-tight">{{ $category['name'] }}</span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase">{{ $category['products_count'] }} Productos</span>
                </div>
                <div class="text-right">
                    <p class="text-xs font-black text-slate-900 leading-none">{{ number_format($category['quantity']) }} <span class="text-[9px] text-slate-400">UND</span></p>
                    <p class="text-[10px] font-bold text-emerald-500 mt-1">Bs {{ number_format($category['value'], 2) }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>