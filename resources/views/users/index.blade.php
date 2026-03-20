@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Encabezado de Alto Nivel --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-3">
            <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Control de Personal</h2>
                <p class="text-sm text-slate-500 font-medium italic">Administra los accesos, roles y estados de los colaboradores.</p>
            </div>
        </div>

        <a href="{{ route('users.create') }}"
            class="inline-flex items-center justify-center px-6 py-3 bg-slate-900 text-white text-sm font-black uppercase tracking-widest rounded-xl hover:bg-black transition-all shadow-md">
            <span>+ Agregar Nuevo Usuario</span>
        </a>
    </div>

    {{-- Tabla de Directorio --}}
    <div class="bg-white shadow-sm rounded-3xl border border-gray-100 overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-gray-50">
                    <th class="px-6 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Colaborador</th>
                    <th class="px-6 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Credenciales</th>
                    <th class="px-6 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Nivel de Acceso</th>
                    <th class="px-6 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Estado de Cuenta</th>
                    <th class="px-6 py-5 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Gestión</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($users as $user)
                <tr class="group hover:bg-slate-50/30 transition-all">
                    
                    {{-- Avatar e Identidad --}}
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center border-2 border-white shadow-sm group-hover:bg-[#00A59A] transition-colors">
                                <span class="text-xs font-black text-slate-600 group-hover:text-white uppercase">
                                    {{ substr($user->name, 0, 1) }}{{ substr($user->paternal, 0, 1) }}
                                </span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-black text-slate-900 uppercase tracking-tighter italic">
                                    {{ $user->name }} {{ $user->paternal }}
                                </span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Miembro del equipo</span>
                            </div>
                        </div>
                    </td>

                    {{-- Email --}}
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <span class="text-slate-300">✉</span>
                            <span class="text-xs font-bold text-slate-600 tracking-tight italic">{{ $user->email }}</span>
                        </div>
                    </td>

                    {{-- Rol con Badge Estilizado --}}
                    <td class="px-6 py-5 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-[0.15em] bg-slate-900 text-white shadow-sm">
                            {{ $user->role->name }}
                        </span>
                    </td>

                    {{-- Toggle Status con Switch Visual --}}
                    <td class="px-6 py-5 text-center">
                        <form method="POST" action="{{ route('users.toggle-status', $user) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="inline-flex items-center gap-2 group/btn">
                                @if ($user->status === 'activo')
                                    <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 rounded-full border border-emerald-100 group-hover/btn:bg-emerald-600 group-hover/btn:text-white transition-all">
                                        ● Activo
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest text-rose-600 bg-rose-50 rounded-full border border-rose-100 group-hover/btn:bg-rose-600 group-hover/btn:text-white transition-all">
                                        ○ Inactivo
                                    </span>
                                @endif
                            </button>
                        </form>
                    </td>

                    {{-- Acciones --}}
                    <td class="px-6 py-5 text-right">
                        <div class="flex justify-end items-center gap-2">
                            <a href="{{ route('users.edit', $user) }}" 
                               class="p-2.5 text-slate-400 hover:text-[#00A59A] hover:bg-teal-50 rounded-xl transition-all active:scale-90">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>

                            <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('¿Eliminar permanentemente?')">
                                @csrf @method('DELETE')
                                <button class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all active:scale-90">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection