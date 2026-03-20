@extends('layouts.app')

@section('content')
<div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
    {{-- Contenedor con altura máxima y scroll interno custom --}}
    <div class="bg-white w-full max-w-2xl rounded-[2rem] shadow-2xl border border-white/20 overflow-hidden transform transition-all max-h-[90vh] flex flex-col custom-scrollbar">

        {{-- Header Fijo --}}
        <div class="px-8 py-5 border-b border-gray-50 flex justify-between items-center bg-slate-50/50 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-8 bg-black rounded-full"></div>
                <div>
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Nuevo Integrante</h2>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Configuración de credenciales de acceso</p>
                </div>
            </div>
            <a href="{{ route('users.index') }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-gray-100 text-slate-400 hover:text-rose-500 transition-all">✕</a>
        </div>

        {{-- Cuerpo con Scroll --}}
        <div class="p-8 overflow-y-auto">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <h3 class="text-[10px] font-black text-black uppercase tracking-[0.2em]">Datos Personales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nombre Completo</label>
                            <input type="text" name="name" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-gray-100 rounded-xl text-sm text-black font-bold focus:ring-2 focus:ring-slate-200 outline-none transition-all" placeholder="Ej: Juan Antonio" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Apellido Paterno</label>
                            <input type="text" name="paternal" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-gray-100 rounded-xl text-sm text-black font-bold focus:ring-2 focus:ring-slate-200 outline-none transition-all" placeholder="Pérez" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Apellido Materno</label>
                            <input type="text" name="maternal" class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-gray-100 rounded-xl text-sm text-black font-bold focus:ring-2 focus:ring-slate-200 outline-none transition-all" placeholder="Paz" required>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 pt-2">
                    <h3 class="text-[10px] font-black text-black uppercase tracking-[0.2em]">Acceso al Sistema</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Email Corporativo</label>
                            <input type="email" name="email" class="w-full mt-1.5 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-black font-bold focus:ring-2 focus:ring-slate-200 outline-none transition-all" placeholder="usuario@empresa.com" required>
                        </div>
                        {{-- Campo de Contraseña con alto contraste --}}
                        <div class="bg-slate-100 p-2 rounded-xl border border-slate-200">
                            <label class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Contraseña Inicial</label>
                            <input type="password" name="password" class="w-full mt-1 px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-sm text-black font-black focus:ring-2 focus:ring-slate-400 outline-none transition-all" placeholder="••••••••" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Rol Asignado</label>
                            <select name="role_id" class="w-full mt-1.5 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-black uppercase text-slate-700 outline-none cursor-pointer">
                                @foreach($roles as $role) <option value="{{ $role->id }}">{{ $role->name }}</option> @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-gray-100 md:mt-1.5">
                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Estatus Activo</span>
                            <input type="checkbox" name="status" value="activo" class="w-5 h-5 accent-emerald-500 cursor-pointer" checked>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-50">
                    <a href="{{ route('users.index') }}" class="px-8 py-3 text-slate-400 font-black text-[10px] uppercase tracking-widest hover:text-slate-600">Cancelar</a>
                    <button type="submit" class="px-8 py-3 bg-black text-white font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-slate-900 transition-all shadow-xl active:scale-95">Registrar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Scrollbar minimalista para que no rompa el diseño */
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>
@endsection