<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Movement;
use App\Models\Alert;
use App\Models\Category;

class DashboardService
{
    public function getData(string $period): array
    {
        $from = match ($period) {
            'week'  => now()->subDays(7),
            'month' => now()->subMonth(),
            'year'  => now()->subYear(),
            default => now()->subDays(7),
        };

        return [

            // =====================
            // KPIs SUPERIORES
            // =====================
            'kpis' => [
                // Total unidades en inventario (NO cantidad de SKUs)
                'total_products' => Product::sum('stock_actual'),

                'active_alerts' => Alert::where('status', 'activa')->count(),

                'entries_today' => Movement::whereDate('created_at', today())
                    ->where('movement_type_id', 1)
                    ->sum('quantity'),

                'exits_today' => Movement::whereDate('created_at', today())
                    ->where('movement_type_id', 2)
                    ->sum('quantity'),
            ],

            // =====================
            // GRÁFICO DE MOVIMIENTOS
            // =====================
            'movements' => Movement::where('created_at', '>=', $from)
                ->selectRaw('
                    DATE(created_at) as date,
                    SUM(CASE WHEN movement_type_id = 1 THEN quantity ELSE 0 END) as entries,
                    SUM(CASE WHEN movement_type_id = 2 THEN quantity ELSE 0 END) as exits
                ')
                ->groupBy('date')
                ->orderBy('date')
                ->get(),

            // =====================
            // STOCK POR CATEGORÍA
            // =====================
            'by_category' => Category::withSum('products', 'stock_actual')
                ->get(),

            // =====================
            // PRODUCTOS CON STOCK BAJO
            // =====================
            'low_stock_products' => Product::whereColumn(
                'stock_actual',
                '<=',
                'stock_minimo'
            )->get(),

            // =====================
            // VALOR TOTAL DEL INVENTARIO
            // =====================
            'total_value' => Product::selectRaw(
                'SUM(stock_actual * precio_unitario) as total'
            )->value('total') ?? 0,
        ];
    }
}
