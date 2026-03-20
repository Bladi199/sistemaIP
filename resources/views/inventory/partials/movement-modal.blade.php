<div id="movementModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded w-96">
        <h2 class="text-lg font-bold mb-4" id="movementTitle">Movimiento</h2>

        
            <form method="POST" action="{{ route('inventory.movement.store') }}">
         

            @csrf

            <input type="hidden" name="product_id" id="movement_product_id">
            <input type="hidden" name="movement_type" id="movement_type">

            <div class="mb-3">
                <label>Producto</label>
                <input type="text" id="movement_product_name" disabled class="w-full border rounded">
            </div>

            <div class="mb-3">
                <label>Motivo</label>
                <select name="movement_reason_id" class="w-full border rounded" required>
                    @foreach($entryReasons as $reason)
                        <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Cantidad</label>
                <input type="number" name="quantity" min="1" required class="w-full border rounded">
            </div>

            <div class="mb-3">
                <label>Observación</label>
                <textarea name="notes" class="w-full border rounded"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeMovementModal()">Cancelar</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>
