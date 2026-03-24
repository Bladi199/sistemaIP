<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 1.2cm; }
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #1a1a1a; 
            line-height: 1.4;
            margin: 0;
        }

        /* Encabezado Corporativo Unificado */
        .header-main { border-bottom: 3px solid #1a1a1a; padding-bottom: 12px; margin-bottom: 25px; }
        .brand { font-size: 22px; font-weight: 900; letter-spacing: -1px; text-transform: uppercase; }
        .accent { color: #00A59A; }
        .meta-data { float: right; text-align: right; font-size: 9px; color: #666; text-transform: uppercase; letter-spacing: 1px; }

        /* Título del Reporte */
        .report-title { margin-bottom: 25px; }
        .report-title h2 { font-size: 15px; font-weight: 900; text-transform: uppercase; margin: 0; letter-spacing: 1.5px; color: #000; }
        .report-title p { font-size: 10px; color: #666; font-weight: bold; margin-top: 5px; text-transform: uppercase; }

        /* Tabla Estilo Auditoría */
        table { width: 100%; border-collapse: collapse; }
        
        th { 
            background-color: #1a1a1a; 
            color: #ffffff; 
            font-size: 8.5px; 
            font-weight: bold; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
            padding: 12px 8px;
            text-align: left;
        }

        td { 
            font-size: 10px; 
            padding: 10px 8px; 
            border-bottom: 1px solid #eee; 
            color: #333;
        }

        /* Columnas Numéricas y de Valor */
        .col-code { font-size: 9px; color: #666; font-weight: bold; font-family: monospace; }
        .col-stock { font-weight: 900; text-align: center; font-size: 11px; }
        .col-money { text-align: right; font-weight: bold; font-family: 'Helvetica', Arial, sans-serif; }
        .col-total { text-align: right; font-weight: 900; color: #000; background-color: #fbfcfd; }

        .footer { 
            position: fixed; bottom: 0; width: 100%; 
            text-align: center; font-size: 8px; color: #999; 
            border-top: 1px solid #eee; padding-top: 10px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <div class="header-main">
        <div class="meta-data">
            Generado: {{ $date->format('d/m/Y H:i') }}<br>
            Responsable de Almacén
        </div>
        <div class="brand">PRETEN<span class="accent">FORT</span></div>
        <div style="font-size: 8px; color: #666; font-weight: bold; margin-top: -3px; letter-spacing: 1px;">VALORIZACIÓN INTEGRAL DE INVENTARIOS</div>
    </div>

    <div class="report-title">
        <h2>Reporte de Stock Actual y Valorización</h2>
        <p>Estado de existencias al corte del día</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="12%">Código</th>
                <th width="33%">Descripción del Producto</th>
                <th width="15%">Categoría</th>
                <th width="10%" style="text-align: center;">Stock</th>
                <th width="15%" style="text-align: right;">P. Unitario</th>
                <th width="15%" style="text-align: right;">Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($products as $p)
            @php 
                $totalRow = $p->stock_actual * $p->precio_unitario; 
                $grandTotal += $totalRow;
            @endphp
            <tr>
                <td class="col-code">{{ $p->code }}</td>
                <td style="font-weight: bold;">{{ $p->name }}</td>
                <td style="font-size: 9px; color: #666; text-transform: uppercase;">{{ $p->category->name ?? 'S/C' }}</td>
                <td class="col-stock">{{ $p->stock_actual }}</td>
                <td class="col-money">{{ number_format($p->precio_unitario, 2) }}</td>
                <td class="col-total">{{ number_format($totalRow, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: right; padding: 15px; font-size: 10px; font-weight: 900; text-transform: uppercase;">Inversión Total en Stock:</td>
                <td style="text-align: right; padding: 15px; font-size: 13px; font-weight: 900; background: #1a1a1a; color: white;">
                    {{ number_format($grandTotal, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Este documento es una representación fiel de las existencias en sistema - PRETENFORT 2024
    </div>

</body>
</html>