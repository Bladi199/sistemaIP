<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background: #eee; }
        .title { text-align: center; font-size: 16px; margin-bottom: 10px; }
    </style>
</head>

<body>

<div class="title">
    REPORTE DE STOCK ACTUAL<br>
    <small>{{ $date->format('d/m/Y H:i') }}</small>
</div>

<table>
<thead>
<tr>
    <th>Código</th>
    <th>Producto</th>
    <th>Categoría</th>
    <th>Stock</th>
    <th>Precio</th>
    <th>Total</th>
</tr>
</thead>

<tbody>
@foreach($products as $p)
<tr>
    <td>{{ $p->code }}</td>
    <td>{{ $p->name }}</td>
    <td>{{ $p->category->name ?? '-' }}</td>
    <td>{{ $p->stock_actual }}</td>
    <td>{{ number_format($p->precio_unitario,2) }}</td>
    <td>{{ number_format($p->stock_actual * $p->precio_unitario,2) }}</td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>
