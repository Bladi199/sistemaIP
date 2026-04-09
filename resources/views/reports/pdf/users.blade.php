<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 1.5cm; }

        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #1a1a1a; 
            line-height: 1.4;
        }

        /* HEADER UNIFORME */
        .header-table { width: 100%; margin-bottom: 25px; }
        .logo-text { 
            font-size: 22px; 
            font-weight: 900; 
            text-transform: uppercase; 
            letter-spacing: -1px; 
        }
        .accent { color: #00A59A; }

        .header-detail { 
            text-align: right; 
            font-size: 10px; 
            color: #666; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }

        /* SECCIÓN */
        .section {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        /* TABLA ESTÁNDAR */
        table { width: 100%; border-collapse: collapse; }

        th { 
            background-color: #f8fafc; 
            color: #000; 
            font-size: 9px; 
            font-weight: bold; 
            text-transform: uppercase; 
            padding: 12px 10px;
            border-bottom: 2px solid #1a1a1a;
            text-align: left;
        }

        td { 
            font-size: 10px; 
            padding: 12px 10px; 
            border-bottom: 1px solid #eee; 
            color: #333;
        }

        /* ESTILOS */
        .user-name { 
            font-weight: 900; 
            text-transform: uppercase; 
            color: #000; 
        }

        .user-email { 
            color: #666; 
            font-size: 9px; 
            font-family: monospace;
        }

        .count-value { 
            text-align: center; 
            font-weight: 900; 
        }

        /* FOOTER */
        .footer { 
            position: fixed; 
            bottom: 0; 
            width: 100%; 
            text-align: center; 
            font-size: 8px; 
            color: #999; 
            border-top: 1px solid #eee; 
            padding-top: 10px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <table class="header-table">
        <tr>
            <td>
                <div class="logo-text">PRETEN<span class="accent">FORT</span></div>
                <div style="font-size: 8px; color: #666; margin-top: -5px;">
                    VIGUETAS DE ALTA RESISTENCIA
                </div>
            </td>
            <td class="header-detail">
                CORTE: {{ $date->format('d/m/Y H:i') }}<br>
                ID REPORTE: #USR-{{ time() }}
            </td>
        </tr>
    </table>

    <!-- SECCIÓN -->
    <div class="section">
        <h2>Directorio de Usuarios y Actividad</h2>
    </div>

    <!-- TABLA -->
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

    <!-- FOOTER -->
    <div class="footer">
        Documento de control interno - Sistema PRETENFORT - Confidencial
    </div>

</body>
</html>