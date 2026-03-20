<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

    {{-- Total Productos --}}
    <div class="bg-white p-5 rounded-3xl shadow-lg shadow-slate-200/50 border border-slate-50 flex flex-col gap-3 relative overflow-hidden group">
        <div class="absolute -right-3 -top-3 w-20 h-20 bg-blue-50 rounded-full transition-transform group-hover:scale-110"></div>
        <div class="bg-blue-600 text-white w-10 h-10 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
        <div class="z-10">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.15em]">Total Productos</p>
            <p class="text-2xl font-black text-slate-900">{{ number_format($data['kpis']['total_products']) }}</p>
        </div>
    </div>

    {{-- Alertas --}}
    <div class="bg-white p-5 rounded-3xl shadow-lg shadow-slate-200/50 border border-slate-50 flex flex-col gap-3 relative overflow-hidden group">
        <div class="absolute -right-3 -top-3 w-20 h-20 bg-red-50 rounded-full transition-transform group-hover:scale-110"></div>
        <div class="bg-red-500 text-white w-10 h-10 rounded-xl flex items-center justify-center shadow-lg shadow-red-200 z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div class="z-10">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.15em]">Alertas Activas</p>
            <p class="text-2xl font-black text-red-600">{{ $data['kpis']['active_alerts'] }}</p>
        </div>
    </div>

    {{-- Entradas --}}
    <div class="bg-white p-5 rounded-3xl shadow-lg shadow-slate-200/50 border border-slate-50 flex flex-col gap-3 relative overflow-hidden group">
        <div class="absolute -right-3 -top-3 w-20 h-20 bg-emerald-50 rounded-full transition-transform group-hover:scale-110"></div>
        <div class="bg-emerald-500 text-white w-10 h-10 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200 z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
        <div class="z-10">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.15em]">Entradas Hoy</p>
            <p class="text-2xl font-black text-emerald-600">+{{ $data['kpis']['entries_today'] }}</p>
        </div>
    </div>

    {{-- Salidas --}}
    <div class="bg-white p-5 rounded-3xl shadow-lg shadow-slate-200/50 border border-slate-50 flex flex-col gap-3 relative overflow-hidden group">
        <div class="absolute -right-3 -top-3 w-20 h-20 bg-orange-50 rounded-full transition-transform group-hover:scale-110"></div>
        <div class="bg-orange-500 text-white w-10 h-10 rounded-xl flex items-center justify-center shadow-lg shadow-orange-200 z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
        </div>
        <div class="z-10">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.15em]">Salidas Hoy</p>
            <p class="text-2xl font-black text-orange-600">-{{ $data['kpis']['exits_today'] }}</p>
        </div>
    </div>

</div>