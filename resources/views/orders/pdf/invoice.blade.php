<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 1cm; }
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 10px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        /* DISEÑO DE LOGO PRETENFORT */
        .accent { color: #00A59A; }
        .title-main {
            font-size: 16px;
            font-weight: bold;
            color: #444;
            margin-top: 5px;
        }

        /* ESTILOS DE TABLA E IMAGEN ORIGINAL */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            border: 1px solid #999;
            padding: 4px 6px;
        }

        .no-border { border: none !important; }
        .label {
            background-color: #cccccc; /* Gris exacto de la imagen */
            font-weight: bold;
        }

        .bg-gray { background-color: #cccccc; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }

        /* Caja de ID de Pedido */
        .order-box {
            border: 1px solid #999;
            padding: 8px 25px;
            font-size: 18px;
            text-align: center;
            display: inline-block;
        }

        /* Estilos específicos para la tabla de productos */
        .table-products thead th {
            background-color: #cccccc;
            font-size: 9px;
            text-transform: uppercase;
        }

        /* Contenedor de totales alineado a la derecha */
        .totals-container {
            float: right;
            width: 220px;
        }
    </style>
</head>

<body>

{{-- 1. HEADER --}}
<table class="no-border">
    <tr class="no-border">
        <td class="no-border" style="width: 70%;">
            {{-- Branding actualizado a PRETENFORT --}}
            <div class="bold" style="font-size: 24px;">PRETEN<span class="accent">FORT</span></div>
            <div class="title-main">DETALLE DE PEDIDO</div>
        </td>
        <td class="no-border text-right" style="vertical-align: top;">
            <div class="order-box bold">
                {{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}
            </div>
        </td>
    </tr>
</table>

{{-- 2. BLOQUE DE INFORMACIÓN --}}
<table class="no-border">
    <tr class="no-border">
        {{-- COLUMNA IZQUIERDA --}}
        <td class="no-border" style="width: 63%; padding-right: 10px; vertical-align: top;">
            <table>
                <tr><td class="label" style="width: 35%;">EJECUTIVO DE VENTA</td><td>{{ $order->user->name }} </td></tr>
                <tr><td class="label">RUTA / DIRECCIÓN</td><td>{{ $order->customer->direccion ?? '-' }}</td></tr>
                <tr><td class="label">NOMBRE DEL CLIENTE</td><td>{{ $order->customer->name }}</td></tr>
                <tr><td class="label">ZONA</td><td>{{ $order->customer->zona ?? '-' }}</td></tr>
                <tr><td class="label">CELULAR</td><td>{{ $order->customer->telefono ?? '-' }}</td></tr>
                <tr><td class="label">RAZÓN SOCIAL</td><td>{{ $order->customer->razon_social ?? '-' }}</td></tr>
                <tr><td class="label">NIT</td><td>{{ $order->customer->nit ?? '0' }}</td></tr>
                <tr><td class="label">OBSERVACIONES</td><td>{{ $order->observaciones ?? '-' }}</td></tr>
                {{-- Campos técnicos adicionales ----------------------------------------------------------------------------------------------------
                <tr><td class="label">PESO QQ</td><td>{{ number_format($order->peso_qq ?? 0, 2) }}</td></tr>
                <tr><td class="label">METROS LINEALES</td><td>{{ number_format($order->metros_lineales ?? 0, 2) }}</td></tr>
                <tr><td class="label">CANTIDAD DE VIGUETAS</td><td>{{ $order->cant_viguetas ?? 0 }}</td></tr>
                <tr><td class="label">CANTIDAD DE PLASTOFORM</td><td>{{ $order->cant_plastofor ?? 0 }}</td></tr>
                <tr><td class="label">AREA DE CONSTRUCCION</td><td>{{ number_format($order->area_m2 ?? 0, 2) }}</td></tr>--}}
            </table>
        </td>

        {{-- COLUMNA DERECHA --}}
        <td class="no-border" style="width: 37%; vertical-align: top;">
            <table>
                <tr><td class="label">ESTADO DE PEDIDO</td><td class="text-center">{{ $order->estado ?? 'PREVENTA' }}</td></tr>
                <tr><td class="label">FECHA DE PEDIDO</td><td class="text-center">{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i:s a') }}</td></tr>
                <tr><td class="label">FECHA DE ENTREGA</td><td class="text-center">{{ \Carbon\Carbon::parse($order->fecha_entrega)->format('Y-m-d H:i:s a') }}</td></tr>
            </table>
        </td>
    </tr>
</table>

<div style="margin-top: 5px; font-weight: bold; color: #666;">DETALLE DE PRODUCTOS</div>

{{-- 3. TABLA DE PRODUCTOS --}}
<table class="table-products">
    <thead>
        <tr>
            <th width="30">N°</th>
            <th width="80">CODIGO</th>
            <th>PRODUCTO</th>
            <th>OBSERVACIONES</th>
            <th width="40">C/UN</th>
            <th width="60">PRECIO</th>
            <th width="70">SUB T.</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->details as $index => $d)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $d->product->code ?? 'T-450060' }}</td>
            <td>{{ $d->product->name }}</td>
            <td>{{ $d->observaciones ?? '' }}</td>
            <td class="text-center">{{ $d->cantidad }}</td>
            <td class="text-right">{{ number_format($d->precio_unitario, 2) }}</td>
            <td class="text-right">{{ number_format($d->subtotal, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- 4. TOTALES --}}
<div style="width: 100%;">
    <div class="totals-container">
        <table>
            <tr class="bg-gray">
                <td class="bold">TOTAL</td>
                <td class="text-right">{{ number_format($order->total, 2) }}</td>
            </tr>
        </table>
        
        <br>

        <table>
            <tr>
                <td class="label">DESCUENTO </td>
                <td class="text-right">{{ number_format($order->descuento ?? 0, 2) }}</td>
            </tr>
            <tr class="bg-gray">
                <td class="bold">TOTA NETO</td>
                <td class="text-right bold">{{ number_format($order->total, 2) }}</td>
            </tr>
        </table>
    </div>
    <div style="clear: both;"></div>
</div>

</body>
</html>