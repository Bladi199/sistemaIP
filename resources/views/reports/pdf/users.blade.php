<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 1.5cm; }
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #1a1a1a; 
            margin: 0;
        }

        /* Encabezado PRETENFORT: Línea mínima, impacto máximo */
        .header { 
            border-bottom: 2px solid #000; 
            padding-bottom: 15px; 
            margin-bottom: 40px; 
        }
        .brand { font-size: 22px; font-weight: 900; text-transform: uppercase; letter-spacing: -1px; }
        .accent { color: #00A59A; }
        .meta { float: right; text-align: right; font-size: 9px; color: #666; text-transform: uppercase; letter-spacing: 1px; }

        /* Título sobrio */
        h2 { font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 30px; }

        /* Tabla Elegante: Sin bordes verticales, solo horizontales sutiles */
        table { width: 100%; border-collapse: collapse; }
        
        th { 
            background-color: #000; 
            color: #fff; 
            font-size: 8px; 
            font-weight: bold; 
            text-transform: uppercase; 
            letter-spacing: 1.5px;
            padding: 12px 10px;
            text-align: left;
        }

        td { 
            font-size: 10px; 
            padding: 15px 10px; 
            border-bottom: 1px solid #eee; /* Línea muy tenue */
            color: #333;
        }

        /* Estilo de datos */
        .user-name { font-weight: bold; color: #000; text-transform: uppercase; }
        .user-email { color: #666; font-family: monospace; font-size: 9px; }
        .count-value { font-weight: 900; font-size: 11px; text-align: center; }

        .footer { 
            position: fixed; bottom: 0; width: 100%; 
            text-align: center; font-size: 8px; color: #aaa; 
            border-top: 1px solid #eee; padding: 10px 0;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <div class="header">
        <span class="meta">
            Corte: {{ $date->format('d/m/Y H:i') }}<br>
            ID Reporte: #USR-{{ time() }}
        </span>
        <div class="brand">PRETEN<span class="accent">FORT</span></div>
    </div>

    <h2>Directorio de Usuarios y Actividad</h2>

    <table>
        <thead>
            <tr>
                <th width="35%">Nombre de Usuario</th>
                <th width="35%">Correo Electrónico</th>
                <th width="15%" style="text-align: center;">Movimientos</th>
                <th width="15%" style="text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                <td class="user-name">{{ $u->name }}</td>
                <td class="user-email">{{ $u->email }}</td>
                <td class="count-value">{{ $u->movements_count }}</td>
                <td class="count-value">{{ $u->alert_actions_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Documento de control interno - Sistema PRETENFORT - Confidencial
    </div>

</body>
</html>