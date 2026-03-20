<section x-data="{ showCurr: false, showNew: false, showConf: false }">
    <header class="mb-8">
        <h2 class="text-xs font-black text-black uppercase tracking-[0.2em]">{{ __('Seguridad de la Cuenta') }}</h2>
        <p class="mt-1 text-[11px] font-bold text-slate-400 uppercase italic">{{ __('Use una contraseña aleatoria y larga para mantenerse seguro.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="group">
            <x-input-label for="update_password_current_password" class="text-[10px] font-black text-black uppercase tracking-widest mb-2 ml-1" :value="__('Contraseña Actual')" />
            <div class="relative">
                <input id="update_password_current_password" name="current_password" :type="showCurr ? 'text' : 'password'" class="w-full bg-white border-2 border-slate-200 rounded-2xl px-5 py-3 text-sm font-bold text-black outline-none focus:border-[#00A59A] transition-all" autocomplete="current-password" />
                <button type="button" @click="showCurr = !showCurr" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-black focus:outline-none">
                   <svg x-show="!showCurr" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                   <svg x-show="showCurr" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.183-3.883m4.223-2.535A10.013 10.013 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-4.223-2.535L3 3m10.875 15.825l-3.57-3.57m0 0a3 3 0 114.243-4.243" /></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-[10px] font-bold uppercase text-red-600" />
        </div>

        <div class="group">
            <x-input-label for="update_password_password" class="text-[10px] font-black text-black uppercase tracking-widest mb-2 ml-1" :value="__('Nueva Contraseña')" />
            <div class="relative">
                <input id="update_password_password" name="password" :type="showNew ? 'text' : 'password'" class="w-full bg-white border-2 border-slate-200 rounded-2xl px-5 py-3 text-sm font-bold text-black outline-none focus:border-[#00A59A] transition-all" autocomplete="new-password" />
                <button type="button" @click="showNew = !showNew" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-black">
                   <svg x-show="!showNew" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                   <svg x-show="showNew" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.183-3.883m4.223-2.535A10.013 10.013 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-4.223-2.535L3 3m10.875 15.825l-3.57-3.57m0 0a3 3 0 114.243-4.243" /></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-[10px] font-bold uppercase text-red-600" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-black text-white font-black text-[10px] uppercase tracking-widest px-8 py-3 rounded-xl hover:bg-slate-800 transition-all active:scale-95 shadow-lg shadow-slate-200">
                {{ __('Actualizar Clave') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-[10px] font-black text-[#00A59A] uppercase tracking-widest">
                    {{ __('Clave guardada.') }}
                </p>
            @endif
        </div>
    </form>
</section>