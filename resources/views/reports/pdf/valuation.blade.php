<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body { font-family: Arial; }
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #000; padding: 5px; }
th { background: #eee; }
.total { font-weight: bold; }
</style>
</head>

<body>

<h3>REPORTE DE VALORIZACIÓN</h3>

<table>
<thead>
<tr>
    <th>Producto</th>
    <th>Stock</th>
    <th>Precio</th>
    <th>Total</th>
</tr>
</thead>

<tbody>
@foreach($products as $p)
<tr>
    <td>{{ $p->name }}</td>
    <td>{{ $p->stock_actual }}</td>
    <td>{{ number_format($p->precio_unitario,2) }}</td>
    <td>{{ number_format($p->total,2) }}</td>
</tr>
@endforeach

<tr class="total">
    <td colspan="3">TOTAL GENERAL</td>
    <td>{{ number_format($totalGeneral,2) }}</td>
</tr>

</tbody>
</table>

</body>
</html>
