@extends('layouts.app')

@section('title', 'Reportes y Análisis')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center gap-3">
            <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">REPORTE Y ANALISIS</h2>
                <p class="text-sm text-slate-500 font-medium">Informes cosolidados del inventario</p>
            </div>
        </div>

    @include('reports.partials.tabs')

    <div id="tab-content" class="min-h-[200px]">
        <div id="panel-inventory" class="tab-panel">
            @include('reports.partials.tab-inventory')
        </div>
        <div id="panel-movements" class="tab-panel hidden">
            @include('reports.partials.tab-movements')
        </div>
        <div id="panel-valuation" class="tab-panel hidden">
            @include('reports.partials.tab-valuation')
        </div>
    </div>

    @include('reports.partials.generator')
</div>
@endsection