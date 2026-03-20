@php
    $totalSkus = $data['total_skus'] ?? 0;
    $totalQty = $data['total_quantity'] ?? 0;
    $totalValue = $data['total_value'] ?? 0;
    $lowStock = $data['low_stock'] ?? 0;
@endphp

<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['label' => 'Total SKUs', 'val' => $totalSkus, 'color' => 'text-slate-900', 'icon' => '📦'],
        ['label' => 'Cantidad Total', 'val' => number_format($totalQty), 'color' => 'text-slate-900', 'icon' => '🔢'],
        ['label' => 'Valorización', 'val' => 'Bs ' . number_format($totalValue, 2), 'color' => 'text-emerald-600', 'icon' => '💰'],
        ['label' => 'Stock Bajo', 'val' => $lowStock, 'color' => 'text-rose-600', 'icon' => '⚠️'],
    ] as $kpi)
    <div class="bg-white border border-slate-100 rounded-2xl p-5 transition-all hover:border-slate-200">
        <div class="flex items-center gap-2 mb-2">
            <span class="text-xs">{{ $kpi['icon'] }}</span>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $kpi['label'] }}</p>
        </div>
        <p class="text-2xl font-black tracking-tight {{ $kpi['color'] }}">
            {{ $kpi['val'] }}
        </p>
    </div>
    @endforeach
</div>