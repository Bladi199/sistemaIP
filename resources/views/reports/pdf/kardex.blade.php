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
            margin: 0;
        }

        /* Header Profesional */
        .header-table { width: 100%; border-bottom: 3px solid #1a1a1a; padding-bottom: 10px; margin-bottom: 20px; }
        .logo-text { font-size: 24px; font-weight: 900; letter-spacing: -1px; text-transform: uppercase; }
        .accent { color: #00A59A; }
        .header-detail { text-align: right; color: #666; font-size: 9px; text-transform: uppercase; letter-spacing: 1px; }

        /* Sección de Producto - Limpia */
        .product-info { margin-top: 30px; margin-bottom: 15px; }
        .product-name { 
            font-size: 14px; 
            font-weight: 900; 
            text-transform: uppercase; 
            margin: 0; 
            display: inline-block;
        }
        .product-code { 
            font-size: 10px; 
            color: #666; 
            font-weight: bold; 
            margin-left: 10px;
            border-left: 1px solid #ccc;
            padding-left: 10px;
        }

        /* Tabla de Kardex Estilo Contable */
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        
        th { 
            background-color: #1a1a1a; 
            color: #ffffff; 
            font-size: 8px; 
            font-weight: bold; 
            text-transform: uppercase; 
            letter-spacing: 1px;
            padding: 10px;
            text-align: left;
        }

        td { 
            font-size: 10px; 
            padding: 10px; 
            border-bottom: 1px solid #eee; 
            color: #333;
        }

        /* Etiquetas de Movimiento Sutiles */
        .type-label { font-weight: 900; text-transform: uppercase; font-size: 8px; }
        .entrada { color: #00A59A; } /* Turquesa para entradas */
        .salida { color: #e11d48; }  /* Un rojo sobrio para salidas */

        .footer { 
            position: fixed; bottom: 0; width: 100%; 
            text-align: center; font-size: 8px; color: #999; 
            border-top: 1px solid #eee; padding-top: 10px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <table class="header-table">
        <tr>
            <td style="vertical-align: bottom;">
                <div class="logo-text">PRETEN<span class="accent">FORT</span></div>
                <div style="font-size: 9px; font-weight: bold; color: #666; letter-spacing: 2px;">HISTORIAL DE MOVIMIENTOS (KARDEX)</div>
            </td>
            <td class="header-detail" style="vertical-align: bottom;">
                Emisión: {{ $date->format('d/m/Y H:i') }}<br>
                Responsable: {{ auth()->user()->name ?? 'Admin' }}
            </td>
        </tr>
    </table>

    @foreach($products as $p)
    <div class="product-info">
        <h4 class="product-name">{{ $p->name }}</h4>
        <span class="product-code">REF: {{ $p->code }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th width="15%">Fecha</th>
                <th width="10%">Tipo</th>
                <th width="35%">Motivo / Referencia</th>
                <th width="15%" style="text-align: center;">Cantidad</th>
                <th width="25%">Usuario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($p->movements as $m)
            <tr>
                <td style="font-weight: bold;">{{ $m->created_at->format('d/m/Y') }}</td>
                <td class="type-label {{ strtolower($m->movementType->name) == 'entrada' ? 'entrada' : 'salida' }}">
                    {{ $m->movementType->name }}
                </td>
                <td style="color: #555;">{{ $m->movementReason->name ?? 'N/A' }}</td>
                <td style="text-align: center; font-weight: bold; font-size: 11px;">
                    {{ strtolower($m->movementType->name) == 'entrada' ? '+' : '-' }} {{ $m->quantity }}
                </td>
                <td style="font-size: 9px; color: #666;">
                    {{ $m->user->name ?? 'Sistema' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

    <div class="footer">
        Kardex Maestro de Inventario - Propiedad de PRETENFORT - Confidencial
    </div>

</body>
</html>