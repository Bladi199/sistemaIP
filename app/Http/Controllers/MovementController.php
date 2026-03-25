<?php

namespace App\Http\Controllers;
use App\Enums\MovementTypeEnum;
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
    $typeEnum = match ($type) {
        'entrada' => MovementTypeEnum::ENTRADA,
        'salida'  => MovementTypeEnum::SALIDA,
        default   => null,
    };

    if ($typeEnum) {
        $query->where('movement_type_id', $typeEnum->value);
    }
}

    // Filtro por período
    $query->where('created_at', '>=', now()->subDays($period));

    $movements = $query->latest()->get();

    // Totales independientes (mejor práctica)
    $totalEntradas = (clone $query)
    ->where('movement_type_id', MovementTypeEnum::ENTRADA->value)
    ->sum('quantity');

$totalSalidas = (clone $query)
    ->where('movement_type_id', MovementTypeEnum::SALIDA->value)
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
