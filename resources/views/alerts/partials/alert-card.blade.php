<div class="bg-white rounded shadow border-l-4 mb-4
    {{ $alert->severity == 'alta' ? 'border-red-500' : 'border-orange-400' }}">

    <div class="p-4">
        <div class="flex justify-between">
            <h4 class="font-semibold">{{ ucfirst($alert->type) }}</h4>
            <span class="text-xs px-2 py-1 rounded bg-gray-100">
                {{ ucfirst($alert->severity) }}
            </span>
        </div>

        <p class="text-sm text-gray-600 mt-1">{{ $alert->message }}</p>

        <div class="grid grid-cols-4 gap-3 text-sm mt-3 bg-gray-50 p-2 rounded">
            <div><strong>Producto</strong><br>{{ $alert->product->name }}</div>
            <div><strong>Código</strong><br>{{ $alert->product->code }}</div>
            <div><strong>Stock Actual</strong><br>
                <span class="text-red-600">{{ $alert->product->stock_actual }}</span>
            </div>
            <div><strong>Stock Mínimo</strong><br>{{ $alert->product->stock_minimo }}</div>
        </div>

        <div class="mt-3 flex gap-2">
            <a href="{{ route('inventory.index', ['openEntry' => $alert->product->id]) }}"
                class="bg-green-600 text-white px-3 py-1 rounded text-sm">
                    Resolver
                </a>
            </form>

            <form method="POST" action="{{ route('alerts.ignore', $alert) }}">
                @csrf
                <button class="bg-gray-300 px-3 py-1 rounded text-sm">
                    Ignorar
                </button>
            </form>
        </div>
    </div>
</div>
