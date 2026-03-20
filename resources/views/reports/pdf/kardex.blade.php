<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Kardex Premium</title>
    <style>
        /* Tipografía y Base */
        @page { margin: 1.5cm; }
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #1e293b; 
            line-height: 1.4;
            margin: 0;
        }

        /* Header del Documento */
        .header-table { width: 100%; border: none; margin-bottom: 30px; }
        .logo-text { 
            font-size: 22px; 
            font-weight: 900; 
            letter-spacing: -1px; 
            text-transform: uppercase;
            color: #0f172a;
        }
        .header-detail { text-align: right; color: #64748b; font-size: 10px; font-weight: bold; text-transform: uppercase; }

        /* Títulos de Producto */
        .product-section { margin-top: 40px; }
        .product-badge { 
            background: #f8fafc; 
            border-left: 4px solid #10b981; 
            padding: 15px 20px; 
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .product-name { font-size: 16px; font-weight: 900; color: #0f172a; text-transform: uppercase; margin: 0; }
        .product-code { font-size: 11px; color: #10b981; font-weight: bold; letter-spacing: 1px; }

        /* Tabla de Movimientos Premium */
        table { width: 100%; border-collapse: separate; border-spacing: 0; margin-bottom: 25px; }
        
        th { 
            background-color: #0f172a; 
            color: #ffffff; 
            font-size: 9px; 
            font-weight: 900; 
            text-transform: uppercase; 
            letter-spacing: 1px;
            padding: 12px 10px;
            text-align: left;
            border: none;
        }

        td { 
            font-size: 10px; 
            padding: 10px; 
            border-bottom: 1px solid #f1f5f9; 
            color: #334155;
        }

        /* Filas alternas para legibilidad */
        tr:nth-child(even) td { background-color: #fbfcfd; }

        /* Estilos de Tipo de Movimiento */
        .type-label { 
            font-weight: 800; 
            text-transform: uppercase; 
            font-size: 9px; 
        }
        .text-emerald { color: #10b981; }
        .text-amber { color: #f59e0b; }

        .footer { 
            position: fixed; 
            bottom: -20px; 
            left: 0; 
            right: 0; 
            text-align: center; 
            font-size: 9px; 
            color: #94a3b8;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <table class="header-table">
        <tr>
            <td>
                <div class="logo-text">Sistema <span style="color: #10b981;">Inventario</span></div>
                <div style="font-size: 10px; color: #64748b; font-weight: bold; text-transform: uppercase; letter-spacing: 2px;">Reporte Maestro de Kardex</div>
            </td>
            <td class="header-detail">
                Fecha de Emisión: {{ $date->format('d / m / Y') }}<br>
                Generado por: {{ auth()->user()->name ?? 'Sistema Central' }}
            </td>
        </tr>
    </table>

    @foreach($products as $p)
    <div class="product-section">
        <div class="product-badge">
            <h4 class="product-name">{{ $p->name }}</h4>
            <span class="product-code">CÓDIGO: {{ $p->code }}</span>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="border-top-left-radius: 8px;">Fecha</th>
                    <th>Tipo</th>
                    <th>Razón del Movimiento</th>
                    <th style="text-align: center;">Cantidad</th>
                    <th style="border-top-right-radius: 8px;">Responsable</th>
                </tr>
            </thead>
            <tbody>
                @foreach($p->movements as $m)
                <tr>
                    <td style="font-weight: bold;">{{ $m->created_at->format('d/m/Y') }}</td>
                    <td class="type-label {{ $m->movementType->name == 'Entrada' ? 'text-emerald' : 'text-amber' }}">
                        {{ $m->movementType->name ?? '—' }}
                    </td>
                    <td>{{ $m->movementReason->name ?? 'Sin razón especificada' }}</td>
                    <td style="text-align: center; font-weight: 900; font-size: 12px;">
                        {{ $m->quantity }}
                    </td>
                    <td style="text-transform: uppercase; font-size: 9px; font-weight: bold; color: #64748b;">
                        {{ $m->user->name ?? 'Automático' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach

    <div class="footer">
        Documento generado digitalmente - Confidencial - Página <script type="text/php">echo $PAGE_NUM . " de " . $PAGE_COUNT;</script>
    </div>

</body>
</html>