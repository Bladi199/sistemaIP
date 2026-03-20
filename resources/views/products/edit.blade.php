@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    
    {{-- Encabezado con estilo de Dashboard --}}
    <div class="flex items-center gap-3 mb-8">
        <span class="w-2 h-8 bg-[#3B82F6] rounded-full"></span>
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Editar Producto</h2>
            <p class="text-sm text-slate-500 font-medium">Actualiza la información técnica y niveles de stock.</p>
        </div>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST"
          class="bg-white shadow-sm rounded-2xl border border-gray-100 p-8 space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Sección: Información Básica --}}
            <div class="space-y-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] border-b border-gray-50 pb-2">Datos Generales</h3>
                
                {{-- Código --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Código de Referencia</label>
                    <input type="text" name="code"
                           value="{{ old('code', $product->code) }}"
                           class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring focus:ring-blue-50 transition-all font-medium" 
                           placeholder="Ej: VIG-001" required>
                </div>

                {{-- Nombre --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Nombre del Producto</label>
                    <input type="text" name="name"
                           value="{{ old('name', $product->name) }}"
                           class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring focus:ring-blue-50 transition-all font-medium" 
                           placeholder="Ej: Vigueta Pretensada" required>
                </div>

                {{-- Categoría y Almacén --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Categoría</label>
                        <select name="category_id" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring-blue-50 font-medium">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Almacén</label>
                        <select name="warehouse_id" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] focus:ring-blue-50 font-medium">
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" {{ $product->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Sección: Control de Inventario --}}
            <div class="space-y-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] border-b border-gray-50 pb-2">Inventario y Costos</h3>

                {{-- Stocks --}}
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-blue-50/50 p-3 rounded-2xl border border-blue-100/50">
                        <label class="block text-[10px] font-black text-blue-600 uppercase mb-1">Actual</label>
                        <input type="number" name="stock_actual"
                               value="{{ old('stock_actual', $product->stock_actual) }}"
                               class="w-full bg-transparent border-none p-0 text-xl font-black text-blue-900 focus:ring-0">
                    </div>
                    <div class="bg-rose-50/50 p-3 rounded-2xl border border-rose-100/50">
                        <label class="block text-[10px] font-black text-rose-600 uppercase mb-1">Mínimo</label>
                        <input type="number" name="stock_minimo"
                               value="{{ old('stock_minimo', $product->stock_minimo) }}"
                               class="w-full bg-transparent border-none p-0 text-xl font-black text-rose-900 focus:ring-0">
                    </div>
                    <div class="bg-slate-50 p-3 rounded-2xl border border-slate-200/50">
                        <label class="block text-[10px] font-black text-slate-500 uppercase mb-1">Máximo</label>
                        <input type="number" name="stock_maximo"
                               value="{{ old('stock_maximo', $product->stock_maximo) }}"
                               class="w-full bg-transparent border-none p-0 text-xl font-black text-slate-900 focus:ring-0">
                    </div>
                </div>

                {{-- Precio --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Precio Unitario (Bs.)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-slate-400 font-bold">Bs.</span>
                        <input type="number" step="0.01" name="precio_unitario"
                               value="{{ old('precio_unitario', $product->precio_unitario) }}"
                               class="w-full pl-12 pr-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] font-black text-xl tracking-tight">
                    </div>
                </div>

                {{-- Estado --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Estado del Producto</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#3B82F6] font-bold {{ $product->status == 'activo' ? 'text-green-600' : 'text-red-600' }}">
                        <option value="activo" {{ $product->status == 'activo' ? 'selected' : '' }}>🟢 Activo en Catálogo</option>
                        <option value="inactivo" {{ $product->status == 'inactivo' ? 'selected' : '' }}>🔴 Inactivo / Descontinuado</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Footer de Formulario: Acciones --}}
        <div class="flex items-center justify-between pt-6 border-t border-gray-50">
            <p class="text-[11px] text-slate-400 font-medium italic">* Todos los cambios afectan el valor total del inventario en tiempo real.</p>
            
            <div class="flex space-x-4">
                <a href="{{ route('products.index') }}"
                   class="px-6 py-3 border border-gray-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-gray-50 transition-all">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-10 py-3 bg-slate-900 text-white rounded-xl text-sm font-black uppercase tracking-widest hover:bg-black hover:shadow-lg transition-all shadow-md shadow-slate-200">
                    Guardar Cambios
                </button>
            </div>
        </div>

    </form>
</div>
@endsection