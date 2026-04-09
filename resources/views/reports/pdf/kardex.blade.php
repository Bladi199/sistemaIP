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

        /* SECCIÓN (MISMO ESTILO GLOBAL) */
        .section {
             /* border-top: 2px solid #000;*/
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

        /* INFO PRODUCTO */
        .product-info {
            margin-top: 20px;
            margin-bottom: 8px;
        }

        .product-name { 
            font-size: 11px; 
            font-weight: 900; 
            text-transform: uppercase; 
        }

        .product-code { 
            font-size: 9px; 
            color: #666; 
        }

        /* TABLA ESTÁNDAR */
        table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }

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
        }

        /* TIPOS DE MOVIMIENTO */
        .type-label { 
            font-weight: 900; 
            text-transform: uppercase; 
            font-size: 8px; 
        }

        .entrada { color: #00A59A; }
        .salida { color: #dc2626; }

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
                    HISTORIAL DE MOVIMIENTOS (KARDEX)
                </div>
            </td>
            <td class="header-detail">
                EMISIÓN: {{ $date->format('d/m/Y H:i') }}<br>
                RESPONSABLE: {{ auth()->user()->name ?? 'Admin' }}
            </td>
        </tr>
    </table>

    <!-- SECCIÓN PRINCIPAL -->
    <div class="section">
        <h2>Registro de Movimientos por Producto</h2>
    </div>

    @foreach($products as $p)

        <!-- INFO PRODUCTO -->
        <div class="product-info">
            <div class="product-name">{{ $p->name }}</div>
            <div class="product-code">REF: {{ $p->code }}</div>
        </div>

        <!-- TABLA -->
        <table>
            <thead>
                <tr>
                    <th width="15%">Fecha</th>
                    <th width="10%">Tipo</th>
                    <th width="35%">Motivo</th>
                    <th width="15%" style="text-align: center;">Cantidad</th>
                    <th width="25%">Usuario</th>
                </tr>
            </thead>
            <tbody>
                @foreach($p->movements as $m)
                <tr>
                    <td>{{ $m->created_at->format('d/m/Y') }}</td>

                    <td class="type-label {{ strtolower($m->movementType->name) == 'entrada' ? 'entrada' : 'salida' }}">
                        {{ $m->movementType->name }}
                    </td>

                    <td style="color: #555;">
                        {{ $m->movementReason->name ?? 'N/A' }}
                    </td>

                    <td style="text-align: center; font-weight: bold;">
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

    <!-- FOOTER -->
    <div class="footer">
        Kardex Maestro de Inventario - Sistema PRETENFORT - Documento Confidencial
    </div>

</body>
</html>