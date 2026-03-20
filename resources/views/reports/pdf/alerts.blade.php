<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Alertas</title>
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
    REPORTE DE ALERTAS<br>
    Generado: {{ $date->format('d/m/Y H:i') }}
</div>

<table>
<thead>
<tr>
    <th>Fecha</th>
    <th>Producto</th>
    <th>Tipo</th>
    <th>Severidad</th>
    <th>Mensaje</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>
</thead>

<tbody>
@foreach($alerts as $a)
<tr>
    <td>{{ $a->created_at->format('d/m/Y') }}</td>
    <td>{{ $a->product->name ?? '-' }}</td>
    <td>{{ $a->type }}</td>
    <td>{{ $a->severity }}</td>
    <td>{{ $a->message }}</td>
    <td>{{ $a->status }}</td>
    <td>
        @foreach($a->actions as $ac)
            - {{ $ac->action }} por {{ $ac->user->name ?? '' }}<br>
        @endforeach
    </td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>
