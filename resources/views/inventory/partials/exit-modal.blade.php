<div id="exitModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    {{-- Overlay con desenfoque --}}
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeExitModal()"></div>

    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-gray-100">
        {{-- Header con color de alerta Rojo --}}
        <div class="bg-rose-600 px-6 py-4 flex items-center gap-3">
            <div class="bg-white/20 p-2 rounded-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
            </div>
            <h2 class="text-white font-black uppercase tracking-widest text-sm">Salida de Material</h2>
        </div>

        <form method="POST" action="{{ route('inventory.exit.store') }}" class="p-8 space-y-5">
            @csrf
            <input type="hidden" name="product_id" id="exit_product_id">

            {{-- Info del Producto --}}
            <div class="bg-rose-50/50 p-4 rounded-2xl border border-rose-100">
                <label class="block text-[10px] font-black text-rose-400 uppercase tracking-widest mb-1">Producto a Despachar</label>
                <input type="text" id="exit_product_name" disabled 
                       class="w-full bg-transparent border-none p-0 text-slate-800 font-black uppercase tracking-tight focus:ring-0">
            </div>

            {{-- Motivo --}}
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Motivo de Egreso</label>
                <select name="movement_reason_id" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-xs font-bold uppercase text-slate-700 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all" required>
                    @foreach($exitReasons as $reason)
                        <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Cantidad --}}
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Cantidad a Retirar</label>
                <input type="number" name="quantity" min="1" required 
                       class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-lg font-black text-rose-600 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all"
                       placeholder="0">
            </div>

            {{-- Observación --}}
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Destino o Nota de Salida</label>
                <textarea name="notes" rows="2" 
                          class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-xs font-medium text-slate-600 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all"
                          placeholder="Obra de destino, responsable o número de guía..."></textarea>
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-3 pt-4">
                <button type="button" onclick="closeExitModal()" 
                        class="flex-1 px-4 py-3 border border-gray-200 text-[10px] font-black uppercase tracking-widest text-slate-500 rounded-xl hover:bg-gray-50 transition-all">
                    Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-3 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-rose-600 shadow-lg shadow-slate-200 transition-all">
                    Confirmar Salida
                </button>
            </div>
        </form>
    </div>
</div>