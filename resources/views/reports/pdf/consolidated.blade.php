<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Reporte Consolidado</title>
<style>
body { font-family: Arial; }
.box { margin-bottom: 10px; }
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #000; padding: 5px; }
th { background: #eee; }
</style>
</head>

<body>

<h3>REPORTE CONSOLIDADO</h3>
<p>Generado: {{ $date->format('d/m/Y H:i') }}</p>

<div class="box">
<strong>Total Valorizado:</strong>
{{ number_format($data['total_value'],2) }}
</div>

<div class="box">
<strong>Movimientos en periodo:</strong>
{{ $data['movements'] }}
</div>

<div class="box">
<strong>Alertas del periodo:</strong>
{{ $data['alerts'] }}
</div>

<h4>Productos Bajo Stock</h4>

<table>
<tr>
    <th>Producto</th>
    <th>Actual</th>
    <th>Mínimo</th>
</tr>

@foreach($data['low_stock'] as $p)
<tr>
    <td>{{ $p->name }}</td>
    <td>{{ $p->stock_actual }}</td>
    <td>{{ $p->stock_minimo }}</td>
</tr>
@endforeach
</table>

</body>
</html>
