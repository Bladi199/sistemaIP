
@php
    // Si hay usuario, saca el rol. Si no hay (JMeter), pon 'Invitado'
    $role = auth()->check() ? auth()->user()->role->name : 'Invitado';
@endphp


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
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
    hover:bg-white/5 hover:text-white
    {{ request()->routeIs('dashboard') ? 'bg-teal-custom text-white' : '' }}">

        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3 3h7v7H3V3zm11 0h7v5h-7V3zM3 14h7v7H3v-7zm11 3h7v4h-7v-4z"/>
        </svg>

        Dashboard
    </a>
</li>

{{-- PRODUCTOS --}}
<li x-data="{ 
    open: {{ request()->routeIs('products.*') || request()->routeIs('categories.*') || request()->routeIs('warehouses.*') ? 'true' : 'false' }} 
}">
    
<button @click="open = !open"
    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
        hover:bg-white/5 hover:text-white">

    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M20 7l-8-4-8 4m16 0v10l-8 4m8-14l-8 4m0 0L4 7m8 4v10"/>
    </svg>

    Productos
</button>

<ul x-cloak :class="open ? 'ml-4 mt-2 space-y-1 text-sm' : 'hidden'">

<li>
    <a href="{{ route('products.index') }}"
    class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200
            hover:bg-white/5 hover:text-white
            {{ request()->routeIs('products.*') ? 'bg-teal-custom text-white font-semibold' : '' }}">

        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M9 12h6m-6 4h6M5 6h14M5 18h14"/>
        </svg>

        Lista de Productos
    </a>
</li>

{{-- SOLO ADMIN --}}
@if($role === 'admin')
<li>
<a href="{{ route('categories.index') }}"
   class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200
          hover:bg-white/5 hover:text-white
          {{ request()->routeIs('categories.*') ? 'bg-teal-custom text-white font-semibold' : '' }}">

    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M7.5 3h9l4.5 4.5v9L16.5 21h-9L3 16.5v-9L7.5 3z"/>
    </svg>

    Categorías
</a>
</li>

<li>
<a href="{{ route('warehouses.index') }}"
class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200
      hover:bg-white/5 hover:text-white
      {{ request()->routeIs('warehouses.*') ? 'bg-teal-custom text-white font-semibold' : '' }}">

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
     stroke-width="1.5" stroke="currentColor"
     class="w-4 h-4 shrink-0">

    <path stroke-linecap="round" stroke-linejoin="round"
          d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

    <path stroke-linecap="round" stroke-linejoin="round"
          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
</svg>

Ubicaciones
</a>
</li>
@endif

</ul>
</li>

{{-- INVENTARIO --}}
<li>
<a href="{{ route('inventory.index') }}"
class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
hover:bg-white/5 hover:text-white
{{ request()->routeIs('inventory.*') ? 'bg-teal-custom text-white' : '' }}">

    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M3 7h18M3 12h18M3 17h18"/>
    </svg>

    Inventario
</a>
</li>

{{-- MOVIMIENTOS --}}
<li>
<a href="{{ route('movements.index') }}"
class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
hover:bg-white/5 hover:text-white
{{ request()->routeIs('movements.*') ? 'bg-teal-custom text-white' : '' }}">

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
stroke="currentColor" stroke-width="1.2"
class="w-[18px] h-[18px] ml-0.5 shrink-0">

    <circle cx="12" cy="12" r="9"/>
    <path d="M12 7v5l3 3"/>
</svg>

Movimientos
</a>
</li>

{{-- ALERTAS --}}
<li>
<a href="{{ route('alerts.index') }}"
class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
      hover:bg-white/5 hover:text-white
      {{ request()->routeIs('alerts.*') ? 'bg-teal-custom text-white' : '' }}">

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
     stroke-width="1.5" stroke="currentColor"
     class="w-5 h-5 shrink-0">

    <path stroke-linecap="round" stroke-linejoin="round"
          d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
</svg>

Alertas
</a>
</li>

{{-- SOLO ADMIN --}}
@if($role === 'admin')
<li>
<a href="{{ route('users.index') }}"
class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
hover:bg-white/5 hover:text-white
{{ request()->routeIs('users.*') ? 'bg-teal-custom text-white' : '' }}">

<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"/>
</svg>

Usuarios
</a>
</li>
@endif

{{-- REPORTES --}}
<li>
<a href="{{ route('reports.index') }}"
class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
hover:bg-white/5 hover:text-white
{{ request()->routeIs('reports.*') ? 'bg-teal-custom text-white' : '' }}">

<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
        d="M3 3v18h18M9 17V9m4 8V5m4 12v-6"/>
</svg>

Reportes
</a>
</li>




{{-- PEDIDOS --}}
<li>
<a href="{{ route('orders.index') }}"
class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
hover:bg-white/5 hover:text-white
{{ request()->routeIs('orders.*') ? 'bg-teal-custom text-white' : '' }}">

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
stroke="currentColor" stroke-width="1.2"
class="w-[18px] h-[18px] ml-0.5 shrink-0">

    <circle cx="12" cy="12" r="9"/>
    <path d="M12 7v5l3 3"/>
</svg>

Pedidos
</a>
</li>

</ul>

</aside>