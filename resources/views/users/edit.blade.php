@extends('layouts.app')

@section('content')
<div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
    
    <div class="bg-white w-full max-w-2xl rounded-[2rem] shadow-2xl border border-white/20 overflow-hidden transform transition-all max-h-[90vh] flex flex-col custom-scrollbar">

        {{-- HEADER --}}
        <div class="px-8 py-5 border-b border-gray-50 flex justify-between items-center bg-slate-50/50 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-8 bg-black rounded-full"></div>
                <div>
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Editar Perfil</h2>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                        Actualizando: {{ $user->name }} {{ $user->paternal }}
                    </p>
                </div>
            </div>
            <a href="{{ route('users.index') }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-gray-100 text-slate-400 hover:text-rose-500 transition-all">✕</a>
        </div>

        {{-- CUERPO (ESPACIADO AJUSTADO) --}}
        <div class="px-8 pt-5 pb-8 overflow-y-auto">

            <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                {{-- DATOS PERSONALES --}}
                <div class="space-y-4">
                    <h3 class="text-[10px] font-black text-black uppercase tracking-[0.2em]">Datos Personales</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nombre Completo</label>
                            <input type="text" name="name" value="{{ $user->name }}"
                                class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-gray-100 rounded-xl text-sm text-black font-bold outline-none focus:ring-1 focus:ring-[#00A59A] focus:border-[#00A59A] transition-all"
                                required>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Apellido Paterno</label>
                            <input type="text" name="paternal" value="{{ $user->paternal }}"
                                class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-gray-100 rounded-xl text-sm text-black font-bold outline-none focus:ring-1 focus:ring-[#00A59A] focus:border-[#00A59A] transition-all"
                                required>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Apellido Materno</label>
                            <input type="text" name="maternal" value="{{ $user->maternal }}"
                                class="w-full mt-1.5 px-4 py-2.5 bg-slate-50 border border-gray-100 rounded-xl text-sm text-black font-bold outline-none focus:ring-1 focus:ring-[#00A59A] focus:border-[#00A59A] transition-all"
                                required>
                        </div>
                    </div>
                </div>

                {{-- ACCESO --}}
                <div class="space-y-4 pt-2">
                    <h3 class="text-[10px] font-black text-black uppercase tracking-[0.2em]">Acceso al Sistema</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Email Corporativo</label>
                            <input type="email" name="email" value="{{ $user->email }}"
                                class="w-full mt-1.5 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-black font-bold outline-none focus:ring-1 focus:ring-[#00A59A] focus:border-[#00A59A] transition-all"
                                required>
                        </div>

                        {{-- PASSWORD CON TOGGLE --}}
                        <div x-data="{ show:false }" class="bg-slate-100 p-2 rounded-xl border border-slate-200 relative">
                            <label class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">
                                Cambiar Contraseña
                            </label>

                            <input :type="show ? 'text' : 'password'" name="password"
                                class="w-full mt-1 px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-sm text-black font-black outline-none focus:ring-1 focus:ring-[#00A59A] focus:border-[#00A59A] transition-all pr-10"
                                placeholder="Dejar en blanco para mantener">

                            <button type="button" @click="show = !show"
                                class="absolute right-3 top-1/2 -translate-y-1/20 text-slate-400 hover:text-[#00A59A]">

                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>

                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19"/>
                                </svg>
                            </button>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Rol Asignado</label>
                            <select name="role_id"
                                class="w-full mt-1.5 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-black uppercase text-slate-700 outline-none">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @selected($user->role_id == $role->id)>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-gray-100 md:mt-1.5">
                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Estado Activo</span>
                            <input type="checkbox" name="status" value="activo"
                                class="w-5 h-5 accent-[#00A59A]"
                                {{ $user->status === 'activo' ? 'checked' : '' }}>
                        </div>

                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-50">
                    <a href="{{ route('users.index') }}"
   class="px-6 py-3 border border-gray-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-gray-50 transition-all">
    Cancelar
</a>

                    <button type="submit"
                        class="px-8 py-3 bg-black text-white font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-slate-900 transition-all shadow-xl active:scale-95">
                        Guardar Cambios
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
.custom-scrollbar::-webkit-scrollbar { width: 5px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>
@endsection