<div class="bg-white rounded-2xl border border-slate-100 p-4 mb-6">
    <form method="GET" action="{{ route('reports.index') }}" class="flex items-center gap-4">
        {{-- Mantener tab activo --}}
        <input type="hidden" name="tab" value="movements">

        <div class="flex flex-col">
            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 ml-1">
                Período de Análisis
            </label>
            <div class="relative">
                <select name="period"
                    onchange="this.form.submit()"
                    class="w-56 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold text-slate-700 outline-none focus:border-emerald-500 transition-all appearance-none cursor-pointer">
                    <option value="week" {{ $period === 'week' ? 'selected' : '' }}>Última semana</option>
                    <option value="month" {{ $period === 'month' ? 'selected' : '' }}>Último mes</option>
                    <option value="year" {{ $period === 'year' ? 'selected' : '' }}>Último año</option>
                </select>
                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 text-[10px]">▼</div>
            </div>
        </div>
    </form>
</div>