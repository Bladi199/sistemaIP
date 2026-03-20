<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Usuarios</title>

<style>
body { font-family: Arial; }
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #000; padding: 5px; }
th { background: #eee; }
</style>
</head>

<body>

<h3>REPORTE DE USUARIOS</h3>
<p>Generado: {{ $date->format('d/m/Y H:i') }}</p>

<table>
<tr>
<th>Usuario</th>
<th>Email</th>
<th>Movimientos</th>
<th>Acciones Alertas</th>
</tr>

@foreach($users as $u)
<tr>
<td>{{ $u->name }}</td>
<td>{{ $u->email }}</td>
<td>{{ $u->movements_count }}</td>
<td>{{ $u->alert_actions_count }}</td>
</tr>
@endforeach

</table>

</body>
</html>
