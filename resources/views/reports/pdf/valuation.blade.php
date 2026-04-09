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
        .product-name { 
            font-weight: bold; 
            text-transform: uppercase; 
        }

        .col-number { 
            text-align: center; 
            font-weight: 900; 
        }

        .col-price { 
            text-align: right; 
            color: #666; 
        }

        .col-total { 
            text-align: right; 
            font-weight: 900; 
        }

        /* TOTAL ELEGANTE */
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
                    REPORTE FINANCIERO DE INVENTARIO
                </div>
            </td>
            <td class="header-detail">
                FECHA DE CORTE: {{ now()->format('d/m/Y') }}<br>
                MONEDA: USD
            </td>
        </tr>
    </table>

    <!-- SECCIÓN -->
    <div class="section">
        <h2>Reporte de Valorización de Activos</h2>
        <p>Estado financiero de existencias en almacén</p>
    </div>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th width="40%">Producto</th>
                <th width="15%" style="text-align: center;">Stock</th>
                <th width="20%" style="text-align: right;">Precio Unit.</th>
                <th width="25%" style="text-align: right;">Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td class="product-name">{{ $p->name }}</td>
                <td class="col-number">{{ $p->stock_actual }}</td>
                <td class="col-price">{{ number_format($p->precio_unitario, 2) }}</td>
                <td class="col-total">{{ number_format($p->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>

        <!-- TOTAL -->
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="total-label">
                    Inversión total consolidada:
                </td>
                <td class="total-value">
                    {{ number_format($totalGeneral, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Documento contable interno - Sistema PRETENFORT
    </div>

</body>
</html>