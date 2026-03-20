@extends('layouts.app')

@section('title', 'Nueva Categoría')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- Encabezado Estilo Dashboard --}}
    <div class="flex items-center gap-3 mb-8">
        <span class="w-2 h-8 bg-[#3B82F6] rounded-full"></span>
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Nueva Categoría</h2>
            <p class="text-sm text-slate-500 font-medium italic">Organiza tus productos en grupos lógicos.</p>
        </div>
    </div>

    <form action="{{ route('categories.store') }}" method="POST"
          class="bg-white shadow-sm rounded-2xl border border-gray-100 p-8 space-y-8">
        @csrf

        <div class="space-y-6">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] border-b border-gray-50 pb-2">Información de la Categoría</h3>

            {{-- Nombre --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring focus:ring-blue-50 transition-all font-medium placeholder:text-slate-300" 
                       placeholder="Ej: Materiales de Construcción" required>
                @error('name')
                    <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Descripción</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring focus:ring-blue-50 transition-all font-medium placeholder:text-slate-300"
                          placeholder="Breve descripción del grupo...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Footer de Formulario: Acciones --}}
        <div class="flex items-center justify-between pt-6 border-t border-gray-50">
            <p class="text-[11px] text-slate-400 font-medium italic">* Estos grupos aparecerán en los filtros de inventario.</p>
            
            <div class="flex space-x-4">
                <a href="{{ route('categories.index') }}"
                   class="px-6 py-3 border border-gray-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-gray-50 transition-all">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-10 py-3 bg-slate-900 text-white rounded-xl text-sm font-black uppercase tracking-widest hover:bg-black hover:shadow-lg transition-all shadow-md shadow-slate-200">
                    Guardar Categoría
                </button>
            </div>
        </div>
    </form>
</div>
@endsection