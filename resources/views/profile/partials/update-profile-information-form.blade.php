<section>
    <header class="mb-8">
        <h2 class="text-xs font-black text-black uppercase tracking-[0.2em]">
            {{ __('Información Básica') }}
        </h2>
        <p class="mt-1 text-[11px] font-bold text-slate-400 uppercase italic">
            {{ __("Actualice su nombre y dirección de correo institucional.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="group">
            <x-input-label for="name" class="text-[10px] font-black text-black uppercase tracking-widest mb-2 ml-1" :value="__('Nombre Completo')" />
            <input id="name" name="name" type="text" class="w-full bg-white border-2 border-slate-200 rounded-2xl px-5 py-3 text-sm font-bold text-black outline-none focus:border-[#00A59A] transition-all" value="{{ old('name', $user->name) }}" required autofocus />
            <x-input-error class="mt-2 text-[10px] font-bold uppercase text-red-600" :messages="$errors->get('name')" />
        </div>

        <div class="group">
            <x-input-label for="email" class="text-[10px] font-black text-black uppercase tracking-widest mb-2 ml-1" :value="__('Correo Electrónico')" />
            <input id="email" name="email" type="email" class="w-full bg-white border-2 border-slate-200 rounded-2xl px-5 py-3 text-sm font-bold text-black outline-none focus:border-[#00A59A] transition-all" value="{{ old('email', $user->email) }}" required />
            <x-input-error class="mt-2 text-[10px] font-bold uppercase text-red-600" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-black text-white font-black text-[10px] uppercase tracking-widest px-8 py-3 rounded-xl hover:bg-slate-800 transition-all active:scale-95 shadow-lg shadow-slate-200">
                {{ __('Guardar Cambios') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-[10px] font-black text-[#00A59A] uppercase tracking-widest">
                    {{ __('Actualizado correctamente.') }}
                </p>
            @endif
        </div>
    </form>
</section>