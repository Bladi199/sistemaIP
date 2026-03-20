@extends('layouts.app')

@section('title', 'Nueva Ubicación')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- Encabezado con Estilo Premium --}}
    <div class="flex items-center gap-3 mb-8">
        <span class="w-2 h-8 bg-[#3B82F6] rounded-full animate-pulse"></span>
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Registrar Nuevo Almacén</h2>
            <p class="text-sm text-slate-500 font-medium italic">Define un nuevo punto de control para el inventario físico.</p>
        </div>
    </div>

    <form action="{{ route('warehouses.store') }}" method="POST"
          class="bg-white shadow-sm rounded-2xl border border-gray-100 p-8 space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Columna 1: Identificación Principal --}}
            <div class="space-y-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] border-b border-gray-50 pb-2">Identificación</h3>
                
                {{-- Nombre --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Nombre del Almacén</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring focus:ring-blue-50 transition-all font-bold text-slate-800 placeholder:text-slate-300 placeholder:font-normal" 
                           placeholder="Ej: Depósito Norte" required>
                    @error('name') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                </div>

                {{-- Ubicación Física --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Ubicación Física</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-slate-400 text-sm">📍</span>
                        <input type="text" name="ubicacion" value="{{ old('ubicacion') }}"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring focus:ring-blue-50 font-medium placeholder:text-slate-300" 
                               placeholder="Dirección o coordenadas..." required>
                    </div>
                    @error('ubicacion') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Columna 2: Detalles Operativos --}}
            <div class="space-y-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] border-b border-gray-50 pb-2">Información Operativa</h3>
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Descripción / Notas</label>
                    <textarea name="description" rows="5"
                              class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring focus:ring-blue-50 transition-all font-medium placeholder:text-slate-300"
                              placeholder="Indique horario de recepción, encargado o tipos de materiales almacenados...">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Acciones del Formulario --}}
        <div class="flex items-center justify-between pt-6 border-t border-gray-50">
            <p class="text-[11px] text-slate-400 font-medium max-w-xs leading-tight">
                <span class="text-blue-500 font-bold uppercase">Nota:</span> Al crear una ubicación, podrá asignarle stock inmediatamente desde el panel de productos.
            </p>
            
            <div class="flex space-x-4">
                <a href="{{ route('warehouses.index') }}"
                   class="px-6 py-3 border border-gray-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-gray-50 transition-all">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-10 py-3 bg-slate-900 text-white rounded-xl text-sm font-black uppercase tracking-widest hover:bg-black hover:shadow-lg transition-all shadow-md shadow-slate-200">
                    Registrar Almacén
                </button>
            </div>
        </div>
    </form>
</div>
@endsection