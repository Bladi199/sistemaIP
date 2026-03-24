<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #1a1a1a; 
            margin: 30px;
            line-height: 1.4;
        }

        /* Encabezado */
        .header { border-bottom: 3px solid #1a1a1a; padding-bottom: 10px; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: 900; letter-spacing: -1px; }
        .accent { color: #00A59A; }
        .date { float: right; font-size: 10px; color: #666; margin-top: 10px; text-transform: uppercase; }

        /* Grid de Resumen (Simulado para PDF) */
        .summary-container { width: 100%; margin-bottom: 40px; }
        .card { 
            display: inline-block; 
            width: 30%; 
            background: #f8fafc; 
            padding: 15px; 
            border-radius: 10px; 
            border: 1px solid #e2e8f0;
            margin-right: 2%;
        }
        .card-label { 
            display: block; 
            font-size: 8px; 
            font-weight: 900; 
            color: #64748b; 
            text-transform: uppercase; 
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .card-value { 
            display: block; 
            font-size: 16px; 
            font-weight: 900; 
            color: #1a1a1a; 
        }

        /* Tabla de Bajo Stock */
        .section-header { 
            background: #1a1a1a; 
            color: white; 
            padding: 8px 15px; 
            border-radius: 5px;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        table { width: 100%; border-collapse: collapse; }
        th { 
            text-align: left; 
            font-size: 9px; 
            text-transform: uppercase; 
            color: #666; 
            padding: 10px 5px;
            border-bottom: 2px solid #eee;
        }
        td { 
            padding: 12px 5px; 
            font-size: 11px; 
            border-bottom: 1px solid #f1f5f9;
        }
        .stock-warning { color: #dc2626; font-weight: bold; }

        .footer { 
            position: fixed; bottom: 0; width: 100%; 
            text-align: center; font-size: 9px; color: #999; 
            padding-top: 10px; border-top: 1px solid #eee;
        }
    </style>
</head>
<body>

    <div class="header">
        <span class="date">Generado: {{ $date->format('d/m/Y H:i') }}</span>
        <div class="logo">PRETEN<span class="accent">FORT</span></div>
        <div style="font-size: 9px; font-weight: bold; color: #666; letter-spacing: 2px;">REPORTE CONSOLIDADO MENSUAL</div>
    </div>

    <div class="summary-container">
        <div class="card">
            <span class="card-label">Total Valorizado</span>
            <span class="card-value">$ {{ number_format($data['total_value'], 2) }}</span>
        </div>
        <div class="card">
            <span class="card-label">Movimientos</span>
            <span class="card-value">{{ $data['movements'] }}</span>
        </div>
        <div class="card" style="margin-right: 0;">
            <span class="card-label">Alertas</span>
            <span class="card-value">{{ $data['alerts'] }}</span>
        </div>
    </div>

    <div class="section-header">
        ⚠️ Productos Bajo Stock Mínimo
    </div>

    <table>
        <thead>
            <tr>
                <th width="60%">Descripción del Producto</th>
                <th width="20%" style="text-align: center;">Stock Actual</th>
                <th width="20%" style="text-align: center;">Mínimo Requerido</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['low_stock'] as $p)
            <tr>
                <td style="font-weight: bold;">{{ $p->name }}</td>
                <td style="text-align: center;" class="stock-warning">{{ $p->stock_actual }}</td>
                <td style="text-align: center; color: #64748b;">{{ $p->stock_minimo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Este documento es un resumen oficial del estado de inventario de PRETENFORT.
    </div>

</body>
</html>