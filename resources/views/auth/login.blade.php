@extends('layouts.guest')

@section('title', 'Acceso al Sistema')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-white">
    
    <div class="hidden md:flex md:w-1/2 bg-slate-50 items-center justify-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none">
            <svg width="100%" height="100%"><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/></pattern><rect width="100%" height="100%" fill="url(#grid)" /></svg>
        </div>
        
        <div class="relative z-10 text-center p-12">
            <div class="inline-block mb-8 transition-transform hover:scale-105 duration-500">
                <img src="{{ asset('img/logo_pretenfort.png') }}" alt="Logo" class="w-48 h-48 object-contain drop-shadow-sm">
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter italic">
                PRETEN<span style="color: #00A59A;">FORT</span>
            </h2>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-2">Viguetas de Alta Resistencia</p>
        </div>
    </div>

    <div class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-16">
        <div class="w-full max-w-md">
            
            <div class="mb-10">
                <h1 class="text-3xl font-black text-slate-900 leading-none tracking-tighter uppercase">
                    Bienvenido<br>
                    <span style="color: #00A59A;">Control de Inventario</span>
                </h1>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-4">Ingrese sus credenciales para continuar</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6" x-data="{ show: false }">
    @csrf

    <div class="group">
        <label for="email" class="block text-[11px] font-black text-black uppercase tracking-widest mb-2 ml-1 group-focus-within:text-[#00A59A] transition-colors">
            Correo Institucional
        </label>
        <div class="relative">
            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                class="w-full bg-white border-2 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold text-black outline-none focus:border-[#00A59A] transition-all placeholder:text-slate-300"
                placeholder="usuario@pretenfort.com">
            <div class="absolute right-5 top-1/2 -translate-y-1/2 text-black">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
            </div>
        </div>
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold text-red-600 uppercase" />
    </div>

    <div class="group">
        <div class="flex justify-between items-center mb-2 ml-1">
            <label for="password" class="text-[11px] font-black text-black uppercase tracking-widest group-focus-within:text-[#00A59A] transition-colors">
                Contraseña
            </label>
            <!--@if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-[10px] font-black text-[#00A59A] uppercase tracking-tighter hover:text-black transition-colors">
                    ¿Olvidó su clave?
                </a>
            @endif-->
        </div>
        <div class="relative">
            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                class="w-full bg-white border-2 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold text-black outline-none focus:border-[#00A59A] transition-all placeholder:text-slate-300"
                placeholder="••••••••">
            
            <button type="button" @click="show = !show" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-900 hover:text-[#00A59A] transition-colors focus:outline-none">
                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.183-3.883m4.223-2.535A10.013 10.013 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-4.223-2.535L3 3m10.875 15.825l-3.57-3.57m0 0a3 3 0 114.243-4.243" />
                </svg>
            </button>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-bold text-red-600 uppercase" />
    </div>

    <div class="flex items-center justify-between pt-4">
        <label for="remember_me" class="flex items-center cursor-pointer group">
            <!-- <div class="relative">
                <input id="remember_me" type="checkbox" name="remember" class="sr-only peer">
                <div class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:bg-[#00A59A] transition-all"></div>
                <div class="absolute left-1 top-1 bg-white w-3 h-3 rounded-full transition-all peer-checked:translate-x-5"></div>
            </div>
            comentario <span class="ms-3 text-[10px] font-black text-black uppercase tracking-tighter">Mantener sesión</span>
        </label>-->

        <button type="submit" 
            class="bg-black hover:bg-slate-800 text-white font-black text-[11px] uppercase tracking-[0.2em] px-12 py-4 rounded-2xl transition-all shadow-2xl shadow-slate-300 active:scale-95 flex items-center gap-3 border-b-4 border-black active:border-b-0">
            Iniciar Sesión
            <svg class="w-4 h-4 text-[#00A59A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
        </button>
    </div>
</form>

        
        </div>
    </div>
</div>
@endsection