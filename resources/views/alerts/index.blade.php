@extends('layouts.app')

@section('title', 'Sistema de Alertas')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 space-y-8">

    {{-- Encabezado --}}
    <div class="flex items-center gap-3">
        <span class="w-2 h-8 bg-[#F43F5E] rounded-full animate-pulse"></span>
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Centro de Alertas</h2>
            <p class="text-sm text-slate-500 font-medium italic">Monitoreo crítico de existencias y niveles de seguridad.</p>
        </div>
    </div>

    {{-- RESUMEN - Estilo Premium --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Críticas --}}
        <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm relative overflow-hidden group">
            <div class="absolute right-0 top-0 bg-rose-500 w-1 h-full opacity-20"></div>
            <p class="text-[10px] font-black text-rose-500 uppercase tracking-[0.2em] mb-1">Nivel Crítico</p>
            <div class="flex items-baseline gap-2">
                <p class="text-4xl font-black text-slate-900 group-hover:scale-110 transition-transform">{{ $criticalCount }}</p>
                <span class="text-xs font-bold text-rose-400">Acción Inmediata</span>
            </div>
        </div>

        {{-- Advertencias --}}
        <div class="bg-white p-6 rounded-2xl border border-amber-100 shadow-sm relative overflow-hidden">
            <div class="absolute right-0 top-0 bg-amber-400 w-1 h-full opacity-20"></div>
            <p class="text-[10px] font-black text-amber-500 uppercase tracking-[0.2em] mb-1">Advertencias</p>
            <div class="flex items-baseline gap-2">
                <p class="text-4xl font-black text-slate-900">{{ $warningCount }}</p>
                <span class="text-xs font-bold text-amber-400">Revisión Pendiente</span>
            </div>
        </div>

        {{-- Resueltas --}}
        <div class="bg-white p-6 rounded-2xl border border-emerald-100 shadow-sm relative overflow-hidden">
            <div class="absolute right-0 top-0 bg-emerald-500 w-1 h-full opacity-20"></div>
            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] mb-1">Resueltas (7d)</p>
            <div class="flex items-baseline gap-2">
                <p class="text-4xl font-black text-slate-900">{{ $resolvedLast7Days }}</p>
                <span class="text-xs font-bold text-emerald-400">Historial OK</span>
            </div>
        </div>
    </div>

    {{-- CUERPO PRINCIPAL --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- COLUMNA IZQUIERDA: ALERTAS ACTIVAS --}}
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Alertas Activas ({{ $activeAlerts->count() }})</h3>
                <span class="px-2 py-0.5 bg-slate-100 rounded text-[10px] font-bold text-slate-500">Última actualización: {{ now()->format('H:i') }}</span>
            </div>

            @forelse($activeAlerts as $alert)
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 {{ $alert->type == 'crítica' ? 'bg-rose-50 text-rose-500' : 'bg-amber-50 text-amber-500' }} rounded-xl flex items-center justify-center text-xl">
                            {{ $alert->type == 'crítica' ? '🚨' : '⚠️' }}
                        </div>
                        <div>
                            <h4 class="font-black text-slate-900 tracking-tight">{{ $alert->product->name }}</h4>
                            <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
                                <span>Stock: <b class="text-slate-900">{{ $alert->product->stock_actual }}</b></span>
                                <span class="text-slate-300">|</span>
                                <span>Mín: <b class="text-slate-900">{{ $alert->product->stock_minimo }}</b></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <span class="block text-[10px] font-black uppercase text-slate-400 mb-2 tracking-tighter">Hace {{ $alert->created_at->diffForHumans(null, true) }}</span>
                        
                        {{-- CAMBIO AQUÍ: Enviamos a inventory.index con el parámetro openEntry --}}
                        <a href="{{ route('inventory.index', ['openEntry' => $alert->product->id]) }}" 
                        class="px-4 py-2 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-lg hover:bg-[#00A59A] transition-all shadow-md active:scale-95">
                            Gestionar
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-12 text-center text-slate-400">
                    <p class="text-xs font-black uppercase tracking-[0.3em]">No hay alertas activas</p>
                    <p class="text-[10px] mt-2 italic">El inventario está bajo control</p>
                </div>
            @endforelse
        </div>

        {{-- COLUMNA DERECHA: HISTORIAL --}}
        <div class="space-y-4">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Registro de Resolución</h3>
            
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-4 space-y-4">
                    @forelse($resolvedAlerts as $alert)
                        <div class="flex items-start gap-3 pb-4 border-b border-slate-50 last:border-0 last:pb-0">
                            <div class="mt-1 text-emerald-500 text-xs">✔</div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 tracking-tight">{{ $alert->product->name }}</p>
                                <p class="text-[10px] text-slate-400 font-medium">Resuelto el {{ $alert->updated_at->format('d/m H:i') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-[10px] text-center text-slate-400 py-4 font-bold uppercase">Sin registros recientes</p>
                    @endforelse
                </div>
                <a href="#" class="block bg-slate-50 p-3 text-center text-[10px] font-black text-slate-500 uppercase tracking-widest hover:bg-slate-100 transition-all border-t border-gray-100">
                    Ver todo el historial
                </a>
            </div>
        </div>

    </div>
</div>
@endsection