<div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200/60 overflow-hidden mt-10">
    <div class="px-8 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-transparent flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-2 h-5 rounded-full" style="background-color: #00A59A;"></div>
            <h3 class="text-[11px] font-black text-slate-700 uppercase tracking-[0.15em]">
                Configuración de Exportación
            </h3>
        </div>
        <div class="flex gap-1.5 opacity-40">
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full" style="background-color: #00A59A;"></span>
        </div>
    </div>

    <div class="p-8">
        <form action="{{ route('reports.generate') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-3">
                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Tipo de Reporte</label>
                    <div class="relative group">
                        <select name="type" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 outline-none focus:border-[#00A59A] focus:ring-4 focus:ring-[#00A59A]/10 transition-all cursor-pointer appearance-none shadow-sm" required>
                            <option value="stock">📦 Stock Actual</option>
                            <option value="movements">📈 Movimientos</option>
                            <option value="valuation">💰 Valorización</option>
                            <option value="alerts">⚠️ Reporte de Alertas</option>
                            <option value="consolidated">📋 Reporte Consolidado</option>
                            <option value="kardex">📇 Kardex por Producto</option>
                            <option value="users">👥 Reporte de Usuarios</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-focus-within:text-[#00A59A] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Periodo</label>
                    <div class="relative group">
                        <select name="period" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 outline-none focus:border-[#00A59A] focus:ring-4 focus:ring-[#00A59A]/10 transition-all cursor-pointer appearance-none shadow-sm" required>
                            <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Semanal</option>
                            <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Mensual</option>
                            <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Anual</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Formato</label>
    <div class="flex gap-2 p-1.5 bg-slate-200/50 rounded-2xl border border-slate-200 shadow-inner">
        @foreach(['pdf', 'excel', 'csv'] as $fmt)
        <label class="flex-1 cursor-pointer group">
            <input type="radio" name="format" value="{{ $fmt }}" class="hidden peer" {{ $fmt == 'pdf' ? 'checked' : '' }}>
            
            <div class="py-2.5 text-center rounded-xl text-[10px] font-black text-slate-400 
                        transition-all duration-200 uppercase tracking-wider
                        peer-checked:bg-white 
                        peer-checked:text-[#00A59A] 
                        peer-checked:shadow-[0_4px_12px_rgba(0,0,0,0.08)] 
                        peer-checked:ring-1 
                        peer-checked:ring-slate-100
                        peer-hover:text-slate-600
                        group-active:scale-95">
                {{ $fmt }}
            </div>
        </label>
        @endforeach
    </div>
</div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" 
                    class="group relative text-white font-bold text-xs uppercase tracking-[0.15em] px-12 py-4 rounded-2xl transition-all shadow-xl hover:shadow-[#00A59A]/30 active:scale-95 flex items-center gap-3 overflow-hidden"
                    style="background-color: #12262c;">
                    <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    
                    <svg class="h-4 w-4 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v12m0 0l-3-3m3 3l3-3m-9 5h12" />
                    </svg>
                    <span class="relative z-10">Generar Reporte</span>
                </button>
            </div>
        </form>
    </div>
</div>