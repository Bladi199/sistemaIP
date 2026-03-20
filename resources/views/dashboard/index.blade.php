@extends('layouts.app')

@section('content')
<div class="space-y-8 pb-12">
    {{-- Header del Dashboard --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        
        <div class="flex items-center gap-3">
            <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Panel de Control</h2>
                <p class="text-sm text-slate-500 font-medium">Resumen general del estado de tu inventario en tiempo real.</p>
            </div>
        </div>
        {{--<div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </span>
            <span class="text-sm font-bold text-slate-700 uppercase tracking-wider">Sistema Activo</span>
        </div>--}}
    </div>

    {{-- KPIs Estilizados --}}
    @include('dashboard.partials.kpis')

    {{-- Gráficos con diseño de Tarjeta Premium --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @include('dashboard.partials.movements')
        @include('dashboard.partials.categories')
    </div>

    {{-- Sección Stock Bajo con Estética de la Imagen --}}
    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-50 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-red-500 rounded-full"></div>
                <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">
                    Alertas de Stock Bajo
                </h3>
            </div>
            <span class="px-4 py-1 bg-red-100 text-red-600 text-xs font-black rounded-full uppercase tracking-widest">
                {{ count($data['low_stock_products']) }} Críticos
            </span>
        </div>
        <div class="p-4">
            @include('dashboard.partials.low-stock')
        </div>
    </div>

    {{-- Valor total --}}
    @include('dashboard.partials.total')
</div>
@endsection