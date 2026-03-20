<aside class="w-64 min-h-screen bg-black text-gray-400 flex flex-col">
<div class="px-6 py-5 border-b border-teal-custom/40">
    
    <div class="flex items-center space-x-3">
        
        {{-- Icono --}}
        <svg class="w-6 h-6 text-teal-custom" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
        </svg>

        {{-- Texto --}}
        <span class="text-white font-semibold tracking-wide">
            Sistema Inventario
        </span>

    </div>

</div>
    

    <ul class="mt-6 space-y-1 px-4 text-sm flex-1">

        {{-- DASHBOARD --}}
        <li>
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded-lg transition-all duration-200
               hover:bg-white/5 hover:text-white
               {{ request()->routeIs('dashboard') ? 'bg-teal-custom text-white' : '' }}">
                Dashboard
            </a>
        </li>

        {{-- PRODUCTOS --}}
        <li x-data="{ 
            open: {{ request()->routeIs('products.*') || request()->routeIs('categories.*') || request()->routeIs('warehouses.*') ? 'true' : 'false' }} 
        }">
            <button @click="open = !open"
                class="w-full text-left px-4 py-2 rounded-lg transition-all duration-200
                       hover:bg-white/5 hover:text-white">
                Productos
            </button>

            <ul 
    x-cloak
    :class="open ? 'ml-4 mt-2 space-y-1 text-sm' : 'hidden'"
>

    <li>
        <a href="{{ route('products.index') }}"
           class="block px-4 py-2 rounded-lg transition-all duration-200
                  hover:bg-white/5 hover:text-white
                  {{ request()->routeIs('products.*') ? 'bg-teal-custom text-white font-semibold' : '' }}">
            Lista de Productos
        </a>
    </li>

    <li>
        <a href="{{ route('categories.index') }}"
           class="block px-4 py-2 rounded-lg transition-all duration-200
                  hover:bg-white/5 hover:text-white
                  {{ request()->routeIs('categories.*') ? 'bg-teal-custom text-white font-semibold' : '' }}">
            Categorías
        </a>
    </li>

    <li>
        <a href="{{ route('warehouses.index') }}"
           class="block px-4 py-2 rounded-lg transition-all duration-200
                  hover:bg-white/5 hover:text-white
                  {{ request()->routeIs('warehouses.*') ? 'bg-teal-custom text-white font-semibold' : '' }}">
            Ubicaciones
        </a>
    </li>

</ul>
        </li>

        {{-- INVENTARIO --}}
        <li>
            <a href="{{ route('inventory.index') }}"
               class="block px-4 py-2 rounded-lg transition-all duration-200
               hover:bg-white/5 hover:text-white
               {{ request()->routeIs('inventory.*') ? 'bg-teal-custom text-white' : '' }}">
                Inventario
            </a>
        </li>

        {{-- MOVIMIENTOS --}}
        <li>
            <a href="{{ route('movements.index') }}"
               class="block px-4 py-2 rounded-lg transition-all duration-200
               hover:bg-white/5 hover:text-white
               {{ request()->routeIs('movements.*') ? 'bg-teal-custom text-white' : '' }}">
                Movimientos
            </a>
        </li>

        {{-- ALERTAS --}}
        <li>
            <a href="{{ route('alerts.index') }}"
               class="block px-4 py-2 rounded-lg transition-all duration-200
               hover:bg-white/5 hover:text-white
               {{ request()->routeIs('alerts.*') ? 'bg-teal-custom text-white' : '' }}">
                Alertas
            </a>
        </li>

        {{-- USUARIOS --}}
        <li>
            <a href="{{ route('users.index') }}"
               class="block px-4 py-2 rounded-lg transition-all duration-200
               hover:bg-white/5 hover:text-white
               {{ request()->routeIs('users.*') ? 'bg-teal-custom text-white' : '' }}">
                Usuarios
            </a>
        </li>

        {{-- REPORTES --}}
        <li>
            <a href="{{ route('reports.index') }}"
               class="block px-4 py-2 rounded-lg transition-all duration-200
               hover:bg-white/5 hover:text-white
               {{ request()->routeIs('reports.*') ? 'bg-teal-custom text-white' : '' }}">
                Reportes
            </a>
        </li>

    </ul>

</aside>