<nav class="bg-white border-b border-gray-100 shadow-sm">
    <div class="px-8">
        <div class="flex items-center justify-end h-16">

            {{-- RIGHT (USER) --}}
            <div class="flex items-center space-x-6">

                <span class="text-sm font-medium text-gray-600">
                    
                    {{ Auth::user()->name ?? 'Invitado' }}
                </span>

                <a href="{{ route('profile.edit') }}"
                   class="text-sm font-medium text-teal-custom hover:text-black transition-colors duration-200">
                    Perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="text-sm font-medium text-red-500 hover:text-red-700 transition-colors duration-200">
                        Salir
                    </button>
                </form>

            </div>

        </div>
    </div>
</nav>