@extends('layouts.app')

@section('title', 'Movimientos')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 space-y-8">

    {{-- Header con Estilo Refinado --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Registro de Movimientos</h2>
                <p class="text-sm text-slate-500 font-medium">Auditoría detallada de flujo de mercancía</p>
            </div>
        </div>

        {{-- PERIODO con Estilo Moderno --}}
        <div class="w-full md:w-64">
            <form method="GET" id="periodForm">
                <div class="relative">
                    <span class="absolute left-3 top-3 text-slate-400 text-xs">📅</span>
                    <select name="period" onchange="this.form.submit()"
                            class="w-full pl-9 pr-4 py-2.5 rounded-xl border-gray-100 bg-white shadow-sm text-sm font-black text-slate-700 focus:border-[#3B82F6] focus:ring-4 focus:ring-blue-50 transition-all cursor-pointer">
                        <option value="7"  {{ request('period') == 7 ? 'selected' : '' }}>Últimos 7 días</option>
                        <option value="30" {{ request('period', 30) == 30 ? 'selected' : '' }}>Últimos 30 días</option>
                        <option value="90" {{ request('period') == 90 ? 'selected' : '' }}>Últimos 3 meses</option>
                    </select>
                </div>
                @if(request('type')) <input type="hidden" name="type" value="{{ request('type') }}"> @endif
            </form>
        </div>
    </div>

    {{-- FILTROS DE TIPO (Estilo Segmented Control) --}}
    <div class="flex justify-start">
        <div class="inline-flex bg-slate-100 p-1.5 rounded-2xl border border-slate-200 shadow-inner">
            <a href="{{ route('movements.index', ['period' => request('period')]) }}"
               class="px-8 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all
               {{ !request('type') ? 'bg-white text-slate-900 shadow-md' : 'text-slate-500 hover:text-slate-800' }}">
               Todos
            </a>
            <a href="{{ route('movements.index', ['type' => 'entrada', 'period' => request('period')]) }}"
               class="px-8 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all
               {{ request('type') === 'entrada' ? 'bg-[#3B82F6] text-white shadow-md' : 'text-slate-500 hover:text-slate-800' }}">
               Entradas
            </a>
            <a href="{{ route('movements.index', ['type' => 'salida', 'period' => request('period')]) }}"
               class="px-8 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all
               {{ request('type') === 'salida' ? 'bg-[#F43F5E] text-white shadow-md' : 'text-slate-500 hover:text-slate-800' }}">
               Salidas
            </a>
        </div>
    </div>

    {{-- RESUMEN - KPIs Minimalistas --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Entradas del Periodo</p>
                <p class="text-3xl font-black text-slate-900">{{ $totalEntradas }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500 font-bold text-xl">↓</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Salidas del Periodo</p>
                <p class="text-3xl font-black text-slate-900">{{ abs($totalSalidas) }}</p>
            </div>
            <div class="w-12 h-12 bg-rose-50 rounded-xl flex items-center justify-center text-rose-500 font-bold text-xl">↑</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Operaciones</p>
                <p class="text-3xl font-black text-slate-900">{{ $movements->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 font-bold text-xl">⇄</div>
        </div>
    </div>

    {{-- TABLA AUDITORÍA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Evento</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Fecha y Hora</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Producto</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Cantidad</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Motivo</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Responsable</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">
                @forelse ($movements as $m)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4">
                        @if($m->movementType->name === 'Entrada')
                            <span class="inline-flex items-center px-3 py-1 bg-blue-50 text-[#3B82F6] text-[10px] font-black uppercase rounded-lg border border-blue-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#3B82F6] mr-2"></span> Entrada
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 bg-rose-50 text-[#F43F5E] text-[10px] font-black uppercase rounded-lg border border-rose-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#F43F5E] mr-2"></span> Salida
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex flex-col text-xs">
                            <span class="font-bold text-slate-700">{{ $m->created_at->format('d M, Y') }}</span>
                            <span class="text-slate-400 font-medium">{{ $m->created_at->format('H:i') }} hrs</span>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span class="text-sm font-bold text-slate-900 tracking-tight">{{ $m->product->name }}</span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span class="text-base font-black {{ $m->movementType->name === 'Entrada' ? 'text-[#3B82F6]' : 'text-[#F43F5E]' }}">
                            {{ $m->movementType->name === 'Entrada' ? '+' : '-' }}{{ $m->quantity }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-black text-slate-500 bg-slate-100 px-2 py-0.5 rounded uppercase w-fit">
                                {{ $m->movementReason->name }}
                            </span>
                            @if($m->notes)
                                <span class="text-[10px] italic text-slate-400 truncate max-w-[150px]">{{ $m->notes }}</span>
                            @endif
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500">
                                
                                {{ $m->user ? substr($m->user->name, 0, 2) : '--' }}
                            </div><span class="text-xs font-bold text-slate-700">
    {{ $m->user->name }}
    @if($m->user->deleted_at)
        <span class="text-red-400 text-[10px]">(eliminado)</span>
    @endif
</span></div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-20 text-center">
                        <p class="text-slate-300 font-black uppercase tracking-[0.3em] text-xs">Sin actividad reciente</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection