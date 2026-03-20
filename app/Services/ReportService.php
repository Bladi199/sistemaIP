<?php

namespace App\Services;
use App\Models\Alert;
use App\Models\Product;
use App\Models\Movement;
use App\Models\Category;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MovementsExport;
use App\Exports\StockExport;
use App\Exports\AlertsExport;
use App\Exports\ConsolidatedExport;
use App\Exports\KardexExport;
use App\Exports\UsersExport;
use App\Exports\ValuationExport;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Importación correcta

class ReportService
{
    public function getDashboardData(string $period): array
{
    $from = match ($period) {
        'week' => now()->subWeek(),
        'month' => now()->subMonth(),
        'year' => now()->subYear(),
        default => now()->subMonth(),
    };

    return [
        // =====================
        // KPIs DE ALERTAS 🔥
        // =====================
        'kpis' => [
            'activas' => Alert::where('status', 'activa')->count(),

            'criticas' => Alert::where('status', 'activa')
                ->where('type', 'critico')
                ->count(),

            'resueltas' => Alert::where('status', 'resuelta')->count(),

            'total' => Alert::count(),
        ],

        // =====================
        // KPIs GENERALES
        // =====================
        'total_skus' => Product::count(),

        'total_quantity' => Product::sum('stock_actual'),

        'total_value' => Product::selectRaw(
            'SUM(stock_actual * precio_unitario) as total'
        )->value('total') ?? 0,

        'low_stock' => Product::whereColumn(
            'stock_actual',
            '<=',
            'stock_minimo'
        )->count(),

        'by_category' => Category::with(['products'])->get()->map(function ($category) {
    $quantity = $category->products->sum('stock_actual');
    $value = $category->products->sum(fn ($p) => $p->stock_actual * $p->precio_unitario);

    return [
        'name' => $category->name,
        'products_count' => $category->products->count(),
        'quantity' => $quantity,
        'value' => $value,
    ];
}),


        'movements' => Movement::where('created_at', '>=', $from)
    ->selectRaw("
        DATE(created_at) as date,
        SUM(CASE WHEN movement_type_id = 1 THEN quantity ELSE 0 END) as entries,
        SUM(CASE WHEN movement_type_id = 2 THEN quantity ELSE 0 END) as exits
    ")
    ->groupBy('date')
    ->orderBy('date')
    ->get(),

        'top_products' => Product::orderByDesc('stock_actual')
            ->limit(10)
            ->get(),
        'most_moved_products' => Movement::join('products', 'movements.product_id', '=', 'products.id')
    ->selectRaw('
        products.name as product_name,
        products.code as product_code,
        SUM(CASE WHEN movement_type_id = 1 THEN quantity ELSE 0 END) as entries,
        SUM(CASE WHEN movement_type_id = 2 THEN quantity ELSE 0 END) as exits,
        SUM(quantity) as total
    ')
    ->where('movements.created_at', '>=', $from)
    ->groupBy('products.id', 'products.name', 'products.code')
    ->orderByDesc('total')
    ->limit(10)
    ->get(),

    ];
}


    public function generateReport(string $type, string $period, string $format)
    {
        

        return match ($type) {
            'stock' => $this->stockReport($format),
            'movements' => $this->movementReport($period,$format),
            'valuation' => $this->valuationReport($format),
            'alerts' => $this->alertsReport($period, $format),
            'consolidated' => $this->consolidatedReport($period, $format),
            'kardex' => $this->kardexReport($format),
            'users' => $this->usersReport($format),
            
            default => abort(400, 'Tipo de reporte no válido'),
        };
    }


private function usersReport(string $format)
{
    $users = User::withCount([
        'movements',
        'alertActions'
    ])->get();

    // ===== PDF =====
    if ($format === 'pdf') {
        return Pdf::loadView('reports.pdf.users', [
                'users' => $users,
                'date' => now()
            ])
            ->download('reporte_usuarios.pdf');
    }

    // ===== EXCEL =====
    if ($format === 'excel') {
        return Excel::download(
            new UsersExport($users),
            'reporte_usuarios.xlsx'
        );
    }

    // ===== CSV =====
    if ($format === 'csv') {
        return Excel::download(
            new UsersExport($users),
            'reporte_usuarios.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    abort(400, 'Formato no soportado');
}


private function kardexReport(string $format)
{
    $products = Product::with([
        'movements.movementType',
        'movements.movementReason',
        'movements.user'
    ])->get();

    // ===== PDF =====
    if ($format === 'pdf') {
        return Pdf::loadView('reports.pdf.kardex', [
                'products' => $products,
                'date' => now()
            ])
            ->download('reporte_kardex.pdf');
    }

    // ===== EXCEL =====
    if ($format === 'excel') {
        return Excel::download(
            new KardexExport($products),
            'reporte_kardex.xlsx'
        );
    }

    // ===== CSV =====
    if ($format === 'csv') {
        return Excel::download(
            new KardexExport($products),
            'reporte_kardex.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    abort(400, 'Formato no soportado');
}



private function consolidatedReport(string $period, string $format)
{
    $from = match ($period) {
        'week' => now()->subWeek(),
        'month' => now()->subMonth(),
        'year' => now()->subYear(),
        default => now()->subMonth(),
    };

    $data = [
        'products' => Product::with('category')->get(),

        'movements' => Movement::where('created_at','>=',$from)->count(),

        'alerts' => Alert::where('created_at','>=',$from)->count(),

        'low_stock' => Product::whereColumn(
            'stock_actual','<=','stock_minimo'
        )->get(),

        'total_value' => Product::selectRaw(
            'SUM(stock_actual * precio_unitario) as total'
        )->value('total')
    ];

    // ===== PDF =====
    if ($format === 'pdf') {
        return Pdf::loadView('reports.pdf.consolidated', [
                'data' => $data,
                'date' => now(),
                'from' => $from
            ])
            ->download('reporte_consolidado.pdf');
    }

    // ===== EXCEL =====
    if ($format === 'excel') {
        return Excel::download(
            new ConsolidatedExport($data),
            'reporte_consolidado.xlsx'
        );
    }

    // ===== CSV =====
    if ($format === 'csv') {
        return Excel::download(
            new ConsolidatedExport($data),
            'reporte_consolidado.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    abort(400, 'Formato no soportado');
}

private function alertsReport(string $period, string $format)
{
    $from = match ($period) {
        'week' => now()->subWeek(),
        'month' => now()->subMonth(),
        'year' => now()->subYear(),
        default => now()->subMonth(),
    };

    $alerts = Alert::with(['product', 'actions.user'])
        ->where('created_at', '>=', $from)
        ->orderByDesc('created_at')
        ->get();

    // ===== PDF =====
    if ($format === 'pdf') {
        return Pdf::loadView('reports.pdf.alerts', [
                'alerts' => $alerts,
                'from' => $from,
                'date' => now()
            ])
            ->download('reporte_alertas.pdf');
    }

    // ===== EXCEL =====
    if ($format === 'excel') {
        return Excel::download(
            new AlertsExport($alerts),
            'reporte_alertas.xlsx'
        );
    }

    // ===== CSV =====
    if ($format === 'csv') {
        return Excel::download(
            new AlertsExport($alerts),
            'reporte_alertas.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    abort(400, 'Formato no soportado');
}


private function stockReport(string $format)
{
    $products = Product::with('category', 'warehouse')
        ->orderBy('name')
        ->get();

    // ===== PDF =====
    if ($format === 'pdf') {

        return Pdf::loadView('reports.pdf.stock', [
                'products' => $products,
                'date' => now()
            ])
            ->setPaper('a4', 'portrait')
            ->download('reporte_stock_actual.pdf');
    }

    // ===== EXCEL =====
    if ($format === 'excel') {
        return Excel::download(
            new StockExport($products),
            'reporte_stock_actual.xlsx'
        );
    }

    // ===== CSV =====
    if ($format === 'csv') {
        return Excel::download(
            new StockExport($products),
            'reporte_stock_actual.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    abort(400, 'Formato no soportado');
}


  




private function movementReport(string $period, string $format)
{
    $from = match ($period) {
        'week' => now()->subWeek(),
        'month' => now()->subMonth(),
        'year' => now()->subYear(),
        default => now()->subMonth(),
    };

    $movements = \App\Models\Movement::with([
        'product',
        'user',
        'movementType',
        'movementReason'
    ])
    ->where('created_at', '>=', $from)
    ->orderByDesc('created_at')
    ->get();

    // ================= PDF =================
    if ($format === 'pdf') {
        return \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.pdf.movements', [
                'movements' => $movements,
                'period' => $period,
                'from' => $from
            ])
            ->setPaper('a4', 'landscape')
            ->download('reporte_movimientos.pdf');
    }

    // ================= EXCEL =================
    if ($format === 'excel') {
        return Excel::download(
            new MovementsExport($movements),
            'reporte_movimientos.xlsx'
        );
    }

    // ================= CSV =================
    if ($format === 'csv') {
        return Excel::download(
            new MovementsExport($movements),
            'reporte_movimientos.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    abort(400, 'Formato no soportado');
}






    private function valuationReport(string $format)
{
    $products = Product::get()->map(function ($p) {
        $p->total = $p->stock_actual * $p->precio_unitario;
        return $p;
    });

    $totalGeneral = $products->sum('total');

    // ===== PDF =====
    if ($format === 'pdf') {
        return \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.pdf.valuation', [
                'products' => $products,
                'totalGeneral' => $totalGeneral
            ])
            ->download('reporte_valorizacion.pdf');
    }

    // ===== EXCEL =====
    if ($format === 'excel') {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new ValuationExport($products, $totalGeneral),
            'reporte_valorizacion.xlsx'
        );
    }

    // ===== CSV =====
    if ($format === 'csv') {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new ValuationExport($products, $totalGeneral),
            'reporte_valorizacion.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    abort(400, 'Formato no soportado');
}

}