<div class="bg-white rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/50 border border-slate-50 relative overflow-hidden group">
    {{-- Decoración sutil de fondo para dar profundidad --}}
    <div class="absolute -right-10 -top-10 w-48 h-48 bg-emerald-50 rounded-full blur-3xl transition-transform group-hover:scale-125 opacity-60"></div>
    <div class="absolute left-1/2 top-0 w-px h-full bg-gradient-to-b from-slate-100 to-transparent hidden md:block"></div>

    <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
        
        {{-- Lado Izquierdo: Datos --}}
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 bg-slate-900 rounded-3xl flex items-center justify-center shadow-xl shadow-slate-200 rotate-3 group-hover:rotate-0 transition-transform duration-500">
                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m.599-2.1c.401-.191.401-.809 0-1L12 12m0 4l.599-2.1"></path>
                </svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1">Patrimonio Total</p>
                <div class="flex items-baseline gap-1">
                    <span class="text-xl font-black text-emerald-500">$</span>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tighter">
                        {{ number_format($data['total_value'], 2) }}
                    </h2>
                </div>
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1 flex items-center gap-1">
                    <span class="w-1 h-1 bg-emerald-500 rounded-full"></span>
                    Actualizado en tiempo real
                </p>
            </div>
        </div>

        {{-- Lado Derecho: Acciones --}}
        <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
            <div class="text-right hidden lg:block mr-4">
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Base de cálculo</p>
                <p class="text-[10px] font-bold text-slate-500">Costo unitario actual</p>
            </div>
            
            <button class="w-full sm:w-auto px-10 py-4 bg-slate-900 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl hover:bg-black transition-all active:scale-95 shadow-xl shadow-slate-200">
                Generar Reporte
            </button>
            
            <button class="w-full sm:w-auto p-4 bg-white border border-slate-100 text-slate-400 hover:text-emerald-500 hover:border-emerald-100 rounded-2xl transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
            </button>
        </div>
    </div>
</div>