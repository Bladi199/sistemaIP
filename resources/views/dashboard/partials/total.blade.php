<div class="bg-white rounded-[2.5rem] p-8 shadow-lg shadow-slate-200/50 border border-slate-100 relative overflow-hidden">

    <!-- DECORACIÓN SUTIL -->
    <div class="absolute -right-10 -top-10 w-48 h-48 bg-slate-50 rounded-full blur-3xl opacity-50"></div>
    <div class="absolute left-1/2 top-0 w-px h-full bg-gradient-to-b from-slate-100 to-transparent hidden md:block"></div>

    <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
        
        <!-- LADO IZQUIERDO -->
        <div class="flex items-center gap-6">
            
            <div class="w-16 h-16 bg-slate-900 rounded-3xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m.599-2.1c.401-.191.401-.809 0-1L12 12m0 4l.599-2.1"></path>
                </svg>
            </div>

            <div>
                <!-- TEXTO MEJORADO -->
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-1">
                    Patrimonio Total
                </p>

                <!-- MONTO MÁS PROTAGÓNICO -->
                <div class="flex items-baseline gap-1">
                    <span class="text-xl font-black text-emerald-600">$</span>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter">
                        {{ number_format($data['total_value'], 2) }}
                    </h2>
                </div>

                <!-- TEXTO SECUNDARIO MÁS LEGIBLE -->
                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-1 flex items-center gap-1">
                    <span class="w-1 h-1 bg-emerald-500 rounded-full"></span>
                    Actualizado en tiempo real
                </p>
            </div>
        </div>

        <!-- LADO DERECHO -->
        <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">

            <div class="text-right hidden lg:block mr-4">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">
                    Base de cálculo
                </p>
                <p class="text-[10px] font-bold text-slate-600">
                    Costo unitario actual
                </p>
            </div>
            
            <!-- BOTÓN PRINCIPAL -->
            <form action="{{ route('reports.generate') }}" method="POST" class="w-full sm:w-auto">
                @csrf
                <input type="hidden" name="type" value="valuation">
                <input type="hidden" name="period" value="month">
                <input type="hidden" name="format" value="pdf">

                <button type="submit"
                    class="w-full sm:w-auto px-10 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl transition-all active:scale-95 shadow-md flex items-center justify-center gap-2">
                    
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v12m0 0l-3-3m3 3l3-3"></path>
                    </svg>

                    Generar Reporte
                </button>
            </form>
            
            <!-- BOTÓN SECUNDARIO (VISIBLE Y EQUILIBRADO) -->
            <form action="{{ route('reports.generate') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="valuation">
                <input type="hidden" name="period" value="month">
                <input type="hidden" name="format" value="excel">

                <button type="submit"
                    class="p-4 bg-white border border-slate-300 text-slate-700 hover:text-emerald-600 hover:border-emerald-300 rounded-2xl transition-all shadow-sm">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>

                </button>
            </form>

        </div>
    </div>
</div>