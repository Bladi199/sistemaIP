@extends('layouts.app')

@section('title','Nuevo Pedido')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

<form action="{{ route('orders.store') }}" method="POST">
@csrf

{{-- ===================== --}}
{{-- DATOS DEL PEDIDO --}}
{{-- ===================== --}}
<div class="grid grid-cols-4 gap-4 mb-6">

    {{-- FECHA --}}
    <div>
        <label class="text-xs text-slate-500">Fecha de entrega</label>
        <input type="datetime-local" name="fecha"
               class="w-full border rounded-xl p-2">
    </div>

    {{-- ESTADO --}}
    <div>
        <label class="text-xs text-slate-500">Estado</label>
        <select name="estado" class="w-full border rounded-xl p-2">
            <option value="pendiente">Pendiente</option>
            <option value="cancelado">Cancelado</option>
        </select>
    </div>

    {{-- DIRECCIÓN (🔥 NUEVO) --}}
    <div>
        <label class="text-xs text-slate-500">Dirección de entrega</label>
        <input type="text" name="direccion"
               placeholder="Ej: Av. Siempre Viva 123"
               class="w-full border rounded-xl p-2">
    </div>

    {{-- OBSERVACIONES --}}
    <div>
        <label class="text-xs text-slate-500">Observaciones</label>
        <input type="text" name="observaciones"
               class="w-full border rounded-xl p-2">
    </div>

</div>

{{-- ===================== --}}
{{-- CLIENTE --}}
{{-- ===================== --}}
<div class="mb-6">

    <div class="flex justify-between items-center mb-1">
        <label class="text-xs font-black uppercase text-slate-500">Cliente</label>

        <button type="button"
                onclick="toggleCustomerForm()"
                class="text-xs text-teal-custom font-bold">
            + Nuevo cliente
        </button>
    </div>

    <select name="customer_id" id="customerSelect"
            class="w-full rounded-xl border-gray-200">
        @foreach($customers as $c)
            <option value="{{ $c->id }}">
                {{ $c->name }}
                @if($c->telefono) - {{ $c->telefono }} @endif
                @if($c->nit) | NIT: {{ $c->nit }} @endif
            </option>
        @endforeach
    </select>

    {{-- FORM NUEVO CLIENTE --}}
    <div id="customerForm" class="hidden bg-slate-50 p-4 rounded-xl space-y-3 mt-3">

        <input type="text" id="c_name" placeholder="Nombre"
               class="w-full border rounded-xl p-2">

        <input type="text" id="c_razon" placeholder="Razón Social"
               class="w-full border rounded-xl p-2">

        <input type="text" id="c_nit" placeholder="NIT"
               class="w-full border rounded-xl p-2">

        <input type="text" id="c_phone" placeholder="Teléfono"
               class="w-full border rounded-xl p-2">

        {{-- 🔽 ESTE YA NO ES CLAVE PARA EL SISTEMA --}}
        <input type="text" id="c_address" placeholder="Dirección (opcional)"
               class="w-full border rounded-xl p-2">

        <button type="button"
                onclick="saveCustomer()"
                class="bg-teal-custom text-white px-4 py-2 rounded-xl text-sm">
            Guardar Cliente
        </button>

    </div>

</div>

{{-- ===================== --}}
{{-- PRODUCTOS --}}
{{-- ===================== --}}
<div class="bg-white p-6 rounded-2xl shadow space-y-4">

    <div class="flex gap-2">
        <select id="productSelect" class="flex-1 border rounded-xl p-2">
            @foreach($products as $p)
                <option value="{{ $p->id }}"
                        data-price="{{ $p->precio_unitario }}"
                        data-stock="{{ $p->stock_actual }}">
                    {{ $p->name }} (Bs {{ $p->precio_unitario }})
                </option>
            @endforeach
        </select>

        <button type="button" onclick="addProduct()"
                class="bg-teal-custom text-white px-4 rounded-xl">
            +
        </button>
    </div>

    {{-- TABLA --}}
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 text-xs uppercase">
                <th>Producto</th>
                <th>Cant</th>
                <th>Precio</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>

        <tbody id="cart"></tbody>
    </table>

</div>

{{-- ===================== --}}
{{-- TOTALES --}}
{{-- ===================== --}}
<div class="mt-6 bg-white p-6 rounded-2xl shadow space-y-3">

    <input type="number" name="descuento" id="discount"
           placeholder="Descuento"
           class="w-full border rounded-xl p-2"
           oninput="calculateTotal()">

    <input type="hidden" name="total" id="totalInput">

    <h3 class="text-xl font-black">
        Total: Bs <span id="total">0.00</span>
    </h3>

</div>

<button class="mt-6 bg-black text-white px-6 py-3 rounded-xl">
    Guardar Pedido
</button>

</form>

</div>

{{-- ===================== --}}
{{-- JS --}}
{{-- ===================== --}}
<script>
let cart = [];
let index = 0;

function addProduct() {

    let select = document.getElementById('productSelect');
    let id = select.value;
    let name = select.options[select.selectedIndex].text;
    let price = parseFloat(select.options[select.selectedIndex].dataset.price);
    let stock = parseInt(select.options[select.selectedIndex].dataset.stock);

    let existing = cart.find(p => p.id == id);

    if(existing){

        if(existing.qty >= stock){
            alert("Stock máximo alcanzado");
            return;
        }

        existing.qty += 1;

    } else {

        cart.push({
            id,
            name,
            price,
            qty: 1,
            stock: stock // 🔥 IMPORTANTE
        });
    }

    render();
}

function render() {

    let html = '';
    let total = 0;
    index = 0;

    cart.forEach((item,i)=>{

        let subtotal = item.price * item.qty;
        total += subtotal;

        html += `
        <tr>
            <td>${item.name}</td>

            <td>
                <input type="number" value="${item.qty}" min="1" max="${item.stock}"
onchange="updateQty(${i}, this.value)">
            </td>

            <td>${item.price}</td>
            <td>${subtotal.toFixed(2)}</td>

            <td>
                <button type="button" onclick="removeItem(${i})">X</button>
            </td>

            <input type="hidden" name="products[${index}][product_id]" value="${item.id}">
            <input type="hidden" name="products[${index}][cantidad]" value="${item.qty}">
            <input type="hidden" name="products[${index}][precio_unitario]" value="${item.price}">
            <input type="hidden" name="products[${index}][subtotal]" value="${subtotal.toFixed(2)}">
        </tr>
        `;

        index++;
    });

    document.getElementById('cart').innerHTML = html;
    calculateTotal(total);
}

function updateQty(i, val){

    let qty = parseInt(val);
    let stock = cart[i].stock;

    if(qty > stock){
        qty = stock;
        alert("Cantidad ajustada al stock disponible");
    }

    if(qty < 1){
        qty = 1;
    }

    cart[i].qty = qty;

    render();
}

function removeItem(i){
    cart.splice(i,1);
    render();
}

function calculateTotal(baseTotal = null){

    let total = baseTotal ?? cart.reduce((sum,i)=>sum + i.price*i.qty,0);

    let discount = parseFloat(document.getElementById('discount').value) || 0;

    let final = total - discount;

    document.getElementById('total').innerText = final.toFixed(2);
    document.getElementById('totalInput').value = final;
}
</script>

<script>
function toggleCustomerForm() {
    document.getElementById('customerForm').classList.toggle('hidden');
}

function saveCustomer() {

    let name = document.getElementById('c_name').value;
    let razon = document.getElementById('c_razon').value;
    let nit  = document.getElementById('c_nit').value;
    let phone = document.getElementById('c_phone').value;
    let address = document.getElementById('c_address').value;

    fetch("{{ route('customers.store.ajax') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            name: name,
            razon_social: razon,
            nit: nit,
            telefono: phone,
            direccion: address
        })
    })
    .then(res => res.json())
    .then(data => {

    if(!data.success){
        alert(data.message);

        // 🔥 Seleccionar el existente automáticamente
        let select = document.getElementById('customerSelect');
        select.value = data.customer.id;

        return;
    }

    let select = document.getElementById('customerSelect');

    let option = document.createElement('option');
    option.value = data.customer.id;
    option.text  = data.customer.name;

    select.appendChild(option);
    select.value = data.customer.id;

    document.getElementById('customerForm').classList.add('hidden');

});
}
</script>

@endsection