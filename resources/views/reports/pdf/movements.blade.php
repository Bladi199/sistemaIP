<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body { font-family: Arial; font-size: 12px; }
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #000; padding: 5px; }
th { background: #eee; }
</style>
</head>

<body>

<h3>REPORTE DE MOVIMIENTOS</h3>
<p>Desde: {{ $from->format('d/m/Y') }}</p>

<table>
<thead>
<tr>
    <th>Fecha</th>
    <th>Producto</th>
    <th>Usuario</th>
    <th>Tipo</th>
    <th>Motivo</th>
    <th>Cantidad</th>
    <th>Notas</th>
</tr>
</thead>

<tbody>
@foreach($movements as $m)
<tr>
    <td>{{ $m->created_at->format('d/m/Y H:i') }}</td>
    <td>{{ $m->product->name }}</td>
    <td>{{ $m->user->name ?? '-' }}</td>
    <td>{{ $m->movementType->name ?? '-' }}</td>
    <td>{{ $m->movementReason->name ?? '-' }}</td>
    <td>{{ $m->quantity }}</td>
    <td>{{ $m->notes }}</td>
</tr>
@endforeach
</tbody>

</table>

</body>
</html>
