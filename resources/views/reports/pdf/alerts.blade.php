<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 1.5cm; }

        /* Tipografía limpia */
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #1a1a1a; 
            line-height: 1.5;
        }

        /* Encabezado */
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

        /* Sección (sin línea, más limpio) */
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
            vertical-align: top;
        }

        /* Severidad */
        .severity { 
            font-weight: bold; 
            text-transform: uppercase; 
            font-size: 8px; 
        }
        .high { color: #dc2626; }

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
                REPORTE DE SEGURIDAD<br>
                FECHA: {{ $date->format('d/m/Y') }}<br>
                HORA: {{ $date->format('H:i') }}
            </td>
        </tr>
    </table>

    <!-- SECCIÓN -->
    <div class="section">
        <h2>Control de Alertas de Inventario</h2>
    </div>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Severidad</th>
                <th>Mensaje</th>
                <th>Estado</th>
                <th>Acciones Registradas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alerts as $a)
            <tr>
                <td style="white-space: nowrap;">
                    {{ $a->created_at->format('d/m/Y') }}
                </td>

                <td style="font-weight: bold;">
                    {{ $a->product->name ?? 'N/A' }}
                </td>

                <td>
                    <span class="severity {{ strtolower($a->severity) == 'alta' ? 'high' : '' }}">
                        {{ $a->severity }}
                    </span>
                </td>

                <td style="color: #444;">
                    {{ $a->message }}
                </td>

                <td>
                    {{ $a->status }}
                </td>

                <td style="font-size: 8px; color: #666;">
                    @foreach($a->actions as $ac)
                        • {{ $ac->action }} ({{ $ac->user->name ?? 'Sistema' }})<br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Documento generado automáticamente por el Sistema de Control de Inventario PRETENFORT
    </div>

</body>
</html>