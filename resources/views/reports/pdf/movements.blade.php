<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 1.2cm; }
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #1a1a1a; 
            line-height: 1.3;
            margin: 0;
        }

        /* Encabezado Corporativo */
        .header-main { border-bottom: 2px solid #1a1a1a; padding-bottom: 12px; margin-bottom: 25px; }
        .brand { font-size: 20px; font-weight: 900; letter-spacing: -0.5px; text-transform: uppercase; }
        .accent { color: #00A59A; }
        .meta-data { float: right; text-align: right; font-size: 9px; color: #666; text-transform: uppercase; letter-spacing: 0.5px; }

        /* Título de Documento */
        .doc-title { margin: 20px 0; }
        .doc-title h2 { font-size: 14px; font-weight: 900; text-transform: uppercase; margin: 0; letter-spacing: 1px; }
        .date-range { font-size: 10px; color: #666; font-weight: bold; margin-top: 4px; }

        /* Tabla Estilo Registro Maestro */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        
        th { 
            background-color: #1a1a1a; 
            color: #ffffff; 
            font-size: 8.5px; 
            font-weight: bold; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
            padding: 10px 6px;
            text-align: left;
        }

        td { 
            font-size: 9.5px; 
            padding: 10px 6px; 
            border-bottom: 1px solid #f0f0f0; 
            color: #333;
            vertical-align: middle;
        }

        /* Estilos de Tipo de Movimiento Sutiles */
        .type-tag { font-weight: 900; text-transform: uppercase; font-size: 8px; }
        .in { color: #00A59A; } /* Entrada */
        .out { color: #e11d48; } /* Salida */

        .quantity { font-weight: 900; font-size: 10px; text-align: center; }
        .notes { font-size: 8.5px; font-style: italic; color: #777; max-width: 150px; }

        .footer { 
            position: fixed; bottom: 0; width: 100%; 
            text-align: center; font-size: 8px; color: #bbb; 
            border-top: 1px solid #f0f0f0; padding-top: 8px;
        }
    </style>
</head>

<body>

    <div class="header-main">
        <div class="meta-data">
            Generado: {{ now()->format('d/m/Y H:i') }}<br>
            Página <script type="text/php">echo $PAGE_NUM;</script> de <script type="text/php">echo $PAGE_COUNT;</script>
        </div>
        <div class="brand">PRETEN<span class="accent">FORT</span></div>
        <div style="font-size: 8px; color: #666; font-weight: bold; margin-top: -3px;">REGISTRO HISTÓRICO DE LOGÍSTICA</div>
    </div>

    <div class="doc-title">
        <h2>Detalle de Movimientos de Almacén</h2>
        <div class="date-range">Periodo Consultando desde: {{ $from->format('d / m / Y') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="12%">Fecha / Hora</th>
                <th width="20%">Producto</th>
                <th width="12%">Operador</th>
                <th width="10%">Tipo</th>
                <th width="15%">Motivo</th>
                <th width="8%" style="text-align: center;">Cant.</th>
                <th width="23%">Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movements as $m)
            <tr>
                <td style="color: #666;">{{ $m->created_at->format('d/m/y H:i') }}</td>
                <td style="font-weight: bold; color: #000;">{{ $m->product->name }}</td>
                <td style="font-size: 8px; text-transform: uppercase;">{{ $m->user->name ?? '-' }}</td>
                <td class="type-tag {{ strtolower($m->movementType->name) == 'entrada' ? 'in' : 'out' }}">
                    {{ $m->movementType->name ?? '-' }}
                </td>
                <td style="font-size: 9px;">{{ $m->movementReason->name ?? '-' }}</td>
                <td class="quantity">
                    {{ strtolower($m->movementType->name) == 'entrada' ? '+' : '-' }}{{ $m->quantity }}
                </td>
                <td class="notes">{{ $m->notes ?? 'Sin observaciones' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Copia oficial del registro de movimientos - Sistema de Inventario Centralizado PRETENFORT
    </div>

</body>
</html>