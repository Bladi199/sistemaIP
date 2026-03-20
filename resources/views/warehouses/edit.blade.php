@extends('layouts.app')

@section('title', 'Editar Ubicación')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- Encabezado con Estilo Premium --}}
    <div class="flex items-center gap-3 mb-8">
        <span class="w-2 h-8 bg-[#3B82F6] rounded-full"></span>
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Configurar Almacén</h2>
            <p class="text-sm text-slate-500 font-medium italic">Gestiona los puntos físicos de almacenamiento y distribución.</p>
        </div>
    </div>

    <form action="{{ route('warehouses.update', $warehouse) }}" 
          method="POST"
          class="bg-white shadow-sm rounded-2xl border border-gray-100 p-8 space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Sección Izquierda: Identificación --}}
            <div class="space-y-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] border-b border-gray-50 pb-2">Identificación</h3>
                
                {{-- Nombre del Almacén --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Nombre Comercial</label>
                    <div class="relative">
                        <input type="text" name="name" 
                               value="{{ old('name', $warehouse->name) }}"
                               class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring focus:ring-blue-50 transition-all font-bold text-slate-800" 
                               placeholder="Ej: Almacén Central" required>
                    </div>
                    @error('name') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                </div>

                {{-- Ubicación Física --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Dirección / Punto Físico</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-slate-400">📍</span>
                        <input type="text" name="ubicacion" 
                               value="{{ old('ubicacion', $warehouse->ubicacion) }}"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring-blue-50 font-medium" 
                               placeholder="Ej: Av. Panamericana Km 5" required>
                    </div>
                    @error('ubicacion') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Sección Derecha: Detalles --}}
            <div class="space-y-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] border-b border-gray-50 pb-2">Notas Adicionales</h3>
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Descripción del Sitio</label>
                    <textarea name="description" rows="5"
                              class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring-blue-50 transition-all font-medium placeholder:text-slate-300"
                              placeholder="Detalles sobre el encargado, horario o tipo de materiales que recibe...">{{ old('description', $warehouse->description) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Footer de Acciones --}}
        <div class="flex items-center justify-between pt-6 border-t border-gray-50">
            <div class="flex items-center gap-2 text-[11px] text-slate-400 font-medium">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Las ubicaciones permiten segmentar el stock en los reportes.</span>
            </div>
            
            <div class="flex space-x-4">
                <a href="{{ route('warehouses.index') }}"
                   class="px-6 py-3 border border-gray-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-gray-50 transition-all">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-10 py-3 bg-slate-900 text-white rounded-xl text-sm font-black uppercase tracking-widest hover:bg-black hover:shadow-lg transition-all shadow-md shadow-slate-200">
                    Actualizar Almacén
                </button>
            </div>
        </div>
    </form>
</div>
@endsection