<div id="entryModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    {{-- Overlay con desenfoque --}}
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeEntryModal()"></div>

    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-gray-100">
        {{-- Header con color de acento Teal --}}
        <div class="bg-[#00A59A] px-6 py-4 flex items-center gap-3">
            <div class="bg-white/20 p-2 rounded-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <h2 class="text-white font-black uppercase tracking-widest text-sm">Entrada de Material</h2>
        </div>

        <form method="POST" action="{{ route('inventory.entry.store') }}" class="p-8 space-y-5">
            @csrf
            <input type="hidden" name="product_id" id="entry_product_id">

            {{-- Info del Producto (Solo lectura estilizada) --}}
            <div class="bg-slate-50 p-4 rounded-2xl border border-gray-100">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Producto Seleccionado</label>
                <input type="text" id="entry_product_name" disabled 
                       class="w-full bg-transparent border-none p-0 text-slate-800 font-black uppercase tracking-tight focus:ring-0">
            </div>

            <div class="grid grid-cols-2 gap-4">
                {{-- Motivo --}}
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Motivo de Ingreso</label>
                    <select name="movement_reason_id" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-xs font-bold uppercase text-slate-700 focus:ring-2 focus:ring-[#00A59A]/20 focus:border-[#00A59A] transition-all" required>
                        @foreach($entryReasons as $reason)
                            <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Cantidad --}}
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Cantidad a Ingresar</label>
                    <input type="number" name="quantity" min="1" required 
                           class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-lg font-black text-slate-900 focus:ring-2 focus:ring-[#00A59A]/20 focus:border-[#00A59A] transition-all"
                           placeholder="0">
                </div>
            </div>

            {{-- Observación --}}
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Observaciones Técnicas</label>
                <textarea name="notes" rows="2" 
                          class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-xs font-medium text-slate-600 focus:ring-2 focus:ring-[#00A59A]/20 focus:border-[#00A59A] transition-all"
                          placeholder="Notas adicionales sobre el lote o estado..."></textarea>
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-3 pt-4">
                <button type="button" onclick="closeEntryModal()" 
                        class="flex-1 px-4 py-3 border border-gray-200 text-[10px] font-black uppercase tracking-widest text-slate-500 rounded-xl hover:bg-gray-50 transition-all">
                    Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-3 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-[#00A59A] shadow-lg shadow-slate-200 transition-all">
                    Registrar Entradaaaaa
                </button>
            </div>
        </form>
    </div>
</div>