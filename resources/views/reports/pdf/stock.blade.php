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
            padding-top: 12px;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .section h2 {
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        .section p {
            font-size: 9px;
            color: #666;
            margin-top: 4px;
            text-transform: uppercase;
        }

        /* TABLA ESTÁNDAR */
        table { width: 100%; border-collapse: collapse; }

        th { 
            background-color: #f8fafc; 
            color: #000; 
            font-size: 9px; 
            font-weight: bold; 
            text-transform: uppercase; 
            padding: 10px 8px;
            border-bottom: 2px solid #1a1a1a;
            text-align: left;
        }

        td { 
            font-size: 10px; 
            padding: 10px 8px; 
            border-bottom: 1px solid #eee; 
            color: #333;
        }

        /* COLUMNAS */
        .col-code { 
            font-size: 9px; 
            color: #666; 
            font-weight: bold; 
            font-family: monospace; 
        }

        .col-stock { 
            font-weight: 900; 
            text-align: center; 
        }

        .col-money { 
            text-align: right; 
            font-weight: bold; 
        }

        .col-total { 
            text-align: right; 
            font-weight: 900; 
        }

        /* TOTAL GENERAL (ELEGANTE) */
        .total-row td {
            border-top: 2px solid #000;
            border-bottom: none;
            padding-top: 12px;
        }

        .total-label {
            text-align: right;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .total-value {
            text-align: right;
            font-size: 13px;
            font-weight: 900;
            color: #000;
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
                <div style="font-size: 8px; color: #666;">
                    VALORIZACIÓN INTEGRAL DE INVENTARIOS
                </div>
            </td>
            <td class="header-detail">
                GENERADO: {{ $date->format('d/m/Y H:i') }}<br>
                RESPONSABLE DE ALMACÉN
            </td>
        </tr>
    </table>

    <!-- SECCIÓN -->
    <div class="section">
        <h2>Reporte de Stock Actual y Valorización</h2>
        <p>Estado de existencias al corte del día</p>
    </div>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th width="12%">Código</th>
                <th width="33%">Producto</th>
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
                <td style="font-size: 9px; color: #666; text-transform: uppercase;">
                    {{ $p->category->name ?? 'S/C' }}
                </td>
                <td class="col-stock">{{ $p->stock_actual }}</td>
                <td class="col-money">{{ number_format($p->precio_unitario, 2) }}</td>
                <td class="col-total">{{ number_format($totalRow, 2) }}</td>
            </tr>
            @endforeach
        </tbody>

        <!-- TOTAL -->
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="total-label">
                    Inversión total en stock:
                </td>
                <td class="total-value">
                    {{ number_format($grandTotal, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Documento oficial de inventario - Sistema PRETENFORT
    </div>

</body>
</html>