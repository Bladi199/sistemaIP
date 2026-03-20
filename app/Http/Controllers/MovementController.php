<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function index(Request $request)
{
    $type = $request->type; // entrada | salida | null
    $period = $request->period ?? 30;

    $query = Movement::with([
        'product',
        'user',
        'movementType',
        'movementReason'
    ]);

    // Filtro por tipo
    if ($type) {
        $query->whereHas('movementType', function ($q) use ($type) {
            $q->where('name', ucfirst($type));
        });
    }

    // Filtro por período
    $query->where('created_at', '>=', now()->subDays($period));

    $movements = $query->latest()->get();

    // Totales independientes (mejor práctica)
    $totalEntradas = (clone $query)
        ->whereHas('movementType', fn($q) => $q->where('name', 'Entrada'))
        ->sum('quantity');

    $totalSalidas = (clone $query)
        ->whereHas('movementType', fn($q) => $q->where('name', 'Salida'))
        ->sum('quantity');

    return view('movements.index', compact(
        'movements',
        'totalEntradas',
        'totalSalidas',
        'type',
        'period'
    ));
}
}
