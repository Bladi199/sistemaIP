@extends('layouts.app')

@section('title', 'Perfil de Usuario')

@section('content')
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Encabezado con acento de marca --}}
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <div class="flex items-center gap-3">
            <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Configuración de Perfil</h2>
                <p class="text-sm text-slate-500 font-medium italic">Gestione su identidad y seguridad en el sistema</p>
            </div>
        </div>

            {{-- Grid de Formularios --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Formulario 1: Información de Perfil --}}
                <div class="bg-slate-50/50 p-6 sm:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm transition-all hover:shadow-md">
                    @include('profile.partials.update-profile-information-form')
                </div>

                {{-- Formulario 2: Actualizar Contraseña --}}
                <div class="bg-slate-50/50 p-6 sm:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm transition-all hover:shadow-md">
                    @include('profile.partials.update-password-form')
                </div>

            </div>

            {{-- Formulario 3: Zona de Peligro (Ancho Completo debajo) --}}
            <div class="bg-red-50/30 p-6 sm:p-10 rounded-[2.5rem] border border-red-100 shadow-sm mt-8">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            {{-- Sección de Acción de Salida --}}
            <div class="flex justify-center pt-12 pb-10">
                <a href="{{ route('dashboard') }}" 
                   class="group flex items-center gap-3 bg-black hover:bg-slate-800 text-white font-black text-[11px] uppercase tracking-[0.2em] px-10 py-4 rounded-2xl transition-all shadow-2xl shadow-slate-200 active:scale-95 border-b-4 border-black active:border-b-0">
                    <svg class="w-4 h-4 text-[#00A59A] transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Cancelar</span>
                </a>
            </div>

        </div>
    </div>
@endsection



