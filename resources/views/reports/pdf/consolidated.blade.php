<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 1.5cm; }

        /* Tipografía */
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #1a1a1a; 
            line-height: 1.5;
        }

        /* Header */
        .header-table { width: 100%; border: none; margin-bottom: 25px; }

        .logo-text { 
            font-size: 22px; 
            font-weight: 900; 
            letter-spacing: -1px; 
            text-transform: uppercase;
        }

        .brand-accent { color: #00A59A; }

        .report-info { 
            text-align: right; 
            font-size: 10px; 
            color: #666; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }

        /* Sección */
        .section {
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .section h2 {
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0 0 8px 0;
        }

        /* Tabla */
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }

        th { 
            background-color: #f8fafc; 
            color: #000; 
            font-size: 9px; 
            font-weight: bold; 
            text-transform: uppercase; 
            text-align: left;
            padding: 12px 8px;
            border-bottom: 2px solid #1a1a1a;
        }

        td { 
            padding: 10px 8px; 
            font-size: 10px; 
            border-bottom: 1px solid #eee; 
        }

        /* Resumen simple (reemplazo de cards) */
        .summary {
            margin-bottom: 20px;
        }

        .summary-row {
            margin-bottom: 5px;
            font-size: 11px;
        }

        .summary-label {
            font-weight: bold;
            text-transform: uppercase;
            color: #666;
            margin-right: 5px;
        }

        .summary-value {
            font-weight: 900;
            color: #000;
        }

        .stock-warning {
            color: #dc2626;
            font-weight: bold;
        }

        /* Footer */
        .footer { 
            position: fixed; 
            bottom: 0; 
            width: 100%; 
            text-align: center; 
            font-size: 9px; 
            color: #999; 
            border-top: 1px solid #eee; 
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <table class="header-table">
        <tr>
            <td style="border:none; padding:0;">
                <div class="logo-text">PRETEN<span class="brand-accent">FORT</span></div>
                <div style="font-size: 8px; color: #666; margin-top: -5px;">
                    VIGUETAS DE ALTA RESISTENCIA
                </div>
            </td>
            <td class="report-info" style="border:none;">
                REPORTE CONSOLIDADO<br>
                FECHA: {{ $date->format('d/m/Y') }}<br>
                HORA: {{ $date->format('H:i') }}
            </td>
        </tr>
    </table>

    <!-- RESUMEN -->
    <div class="section">
        <h2>Resumen General</h2>
    </div>

    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Total Valorizado:</span>
            <span class="summary-value">$ {{ number_format($data['total_value'], 2) }}</span>
        </div>

        <div class="summary-row">
            <span class="summary-label">Movimientos:</span>
            <span class="summary-value">{{ $data['movements'] }}</span>
        </div>

        <div class="summary-row">
            <span class="summary-label">Alertas:</span>
            <span class="summary-value">{{ $data['alerts'] }}</span>
        </div>
    </div>

    <!-- SECCIÓN -->
    <div class="section">
        <h2>Productos Bajo Stock Mínimo</h2>
    </div>

    <!-- TABLA -->
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
                <td style="text-align: center;" class="stock-warning">
                    {{ $p->stock_actual }}
                </td>
                <td style="text-align: center; color: #64748b;">
                    {{ $p->stock_minimo }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Documento generado automáticamente por el Sistema PRETENFORT
    </div>

</body>
</html>