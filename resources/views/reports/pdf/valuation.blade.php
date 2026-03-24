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
            line-height: 1.2;
        }

        /* Encabezado Maestro */
        .header { 
            border-bottom: 2px solid #000; 
            padding-bottom: 15px; 
            margin-bottom: 40px; 
        }
        .brand { font-size: 22px; font-weight: 900; text-transform: uppercase; letter-spacing: -1px; }
        .accent { color: #00A59A; }
        .meta { float: right; text-align: right; font-size: 9px; color: #666; text-transform: uppercase; letter-spacing: 1px; }

        /* Título del Documento */
        h2 { font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px; }
        .subtitle { font-size: 9px; color: #888; font-weight: bold; text-transform: uppercase; margin-bottom: 30px; }

        /* Tabla de Alta Costura Financiera */
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
            padding: 14px 10px; 
            border-bottom: 1px solid #f0f0f0; 
            color: #333;
        }

        /* Tipografía de Cifras */
        .product-name { font-weight: bold; color: #000; text-transform: uppercase; }
        .col-number { text-align: center; font-weight: 700; }
        .col-price { text-align: right; font-weight: 500; color: #666; }
        .col-total { text-align: right; font-weight: 900; color: #000; font-size: 11px; }

        /* Fila de Sumatoria Final */
        .total-row td { 
            padding: 20px 10px; 
            border-bottom: none; 
            font-size: 12px;
        }
        .total-label { font-weight: 900; text-transform: uppercase; letter-spacing: 1px; text-align: right; }
        .total-amount { 
            background-color: #000; 
            color: #fff; 
            font-weight: 900; 
            text-align: right;
            padding-right: 10px !important;
        }

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
            Fecha de Corte: {{ now()->format('d/m/Y') }}<br>
            Moneda: Expresado en USD
        </span>
        <div class="brand">PRETEN<span class="accent">FORT</span></div>
    </div>

    <h2>Reporte de Valorización de Activos</h2>
    <div class="subtitle">Estado Financiero de Existencias en Almacén</div>

    <table>
        <thead>
            <tr>
                <th width="40%">Descripción del Producto</th>
                <th width="15%" style="text-align: center;">Stock</th>
                <th width="20%" style="text-align: right;">Precio Unit.</th>
                <th width="25%" style="text-align: right;">Subtotal Valor</th>
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

            <tr class="total-row">
                <td colspan="3" class="total-label">Inversión Total Consolidada</td>
                <td class="total-amount">{{ number_format($totalGeneral, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Documento con validez contable interna - PRETENFORT - Confidencial
    </div>

</body>
</html>