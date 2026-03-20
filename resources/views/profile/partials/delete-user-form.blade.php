<section class="space-y-6">
    <header class="mb-8">
        <h2 class="text-xs font-black text-red-600 uppercase tracking-[0.2em]">
            {{ __('Zona de Peligro') }}
        </h2>
        <p class="mt-1 text-[11px] font-bold text-slate-500 uppercase italic">
            {{ __('Una vez eliminada la cuenta, todos los datos se borrarán de forma permanente e irreversible.') }}
        </p>
    </header>

    <button 
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white font-black text-[10px] uppercase tracking-widest px-8 py-3 rounded-xl transition-all active:scale-95 shadow-lg shadow-red-100"
    >
        {{ __('Eliminar Cuenta Definitivamente') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white rounded-3xl">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tighter">
                {{ __('¿Confirmar eliminación?') }}
            </h2>

            <p class="mt-4 text-[11px] font-bold text-slate-500 uppercase leading-relaxed">
                {{ __('Por razones de seguridad, ingrese su contraseña para confirmar que desea dar de baja su acceso de forma permanente.') }}
            </p>

            <div class="mt-8 group">
                <x-input-label for="password_delete" value="{{ __('Contraseña de Confirmación') }}" class="text-[10px] font-black text-black uppercase tracking-widest mb-2 ml-1" />

                <div class="relative">
                    <input 
                        id="password_delete"
                        name="password"
                        type="password"
                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-2xl px-5 py-3 text-sm font-bold text-black outline-none focus:border-red-500 transition-all placeholder:text-slate-300"
                        placeholder="••••••••"
                    />
                </div>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-[10px] font-bold uppercase text-red-600" />
            </div>

            <div class="mt-10 flex justify-end items-center gap-4">
                <button 
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-black transition-colors"
                >
                    {{ __('Cancelar') }}
                </button>

                <button 
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-black text-[10px] uppercase tracking-widest px-10 py-4 rounded-2xl transition-all shadow-xl shadow-red-100"
                >
                    {{ __('Confirmar y Borrar') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>