<?php

namespace App\Http\Controllers;
use App\Enums\MovementTypeEnum;
use App\Models\Product;
use App\Models\Movement;
use App\Models\MovementType;
use App\Models\MovementReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index(Request $request)
{
    // Iniciamos la consulta con las relaciones
    $query = Product::with(['category', 'warehouse']);

    // 1. Aplicar Jerarquía de Estado (Los Botones)
    if ($request->filled('filter')) {
        if ($request->filter == 'critico') {
            $query->whereRaw('stock_actual <= stock_minimo');
        } elseif ($request->filter == 'alto') {
            // Ejemplo: mayor al 90% del máximo
            $query->whereRaw('stock_actual >= (stock_maximo * 0.9)');
        }
    }

    // 2. Aplicar Búsqueda sobre el resultado anterior (El Input)
    if ($request->filled('search')) {
        $search = $request->search;
        // Usamos un sub-where para no romper la lógica del filtro de estado
        $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhereHas('category', function($cat) use ($search) {
                  $cat->where('name', 'LIKE', "%{$search}%");
              });
        });
    }

    $products = $query->get();

    $entryReasons = MovementReason::where('affects_stock', 'suma')->get();
    $exitReasons  = MovementReason::where('affects_stock', 'resta')->get();

    return view('inventory.index', compact('products', 'entryReasons', 'exitReasons'));
}

    // =========================
    // Registrar Entrada (Ingreso)
    // =========================
    public function storeEntry(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'movement_reason_id' => 'required|exists:movement_reasons,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // 🔴 AQUÍ ESTABA EL ERROR-------------------------------------------------ññññññññññññññññññññññññññ
        $movementTypeId = MovementTypeEnum::ENTRADA->value;

        Movement::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'movement_type_id' => $movementTypeId,
            'movement_reason_id' => $request->movement_reason_id,
            'quantity' => $request->quantity,
            'notes' => $request->notes,
        ]);

        $product->increment('stock_actual', $request->quantity);

        return redirect()->route('inventory.index')
            ->with('success', 'Ingreso registrado correctamente');
    }

    // =========================
    // Movimiento unificado
    // =========================
    public function storeMovement(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'movement_type' => 'required|in:entrada,salida',
            'movement_reason_id' => 'required|exists:movement_reasons,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // 🔑 MAPEO CORRECTO
        $movementTypeEnum = match ($request->movement_type) {
            'entrada' => MovementTypeEnum::ENTRADA,
            'salida'  => MovementTypeEnum::SALIDA,
        };

        $movementTypeId = $movementTypeEnum->value;

        if (
            $request->movement_type === 'salida' &&
            $product->stock_actual < $request->quantity
        ) {
            return back()->with('error', 'Stock insuficiente');
        }

        Movement::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'movement_type_id' => $movementTypeId,
            'movement_reason_id' => $request->movement_reason_id,
            'quantity' => $request->quantity,
            'notes' => $request->notes,
        ]);

        if ($request->movement_type === 'entrada') {
            $product->increment('stock_actual', $request->quantity);
        } else {
            $product->decrement('stock_actual', $request->quantity);
        }

        return redirect()->route('inventory.index')
            ->with('success', ucfirst($request->movement_type).' registrada correctamente');
    }

    // =========================
    // Registrar Salida
    // =========================
    public function storeExit(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'movement_reason_id' => 'required|exists:movement_reasons,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
       $movementTypeId = MovementTypeEnum::SALIDA->value;

        if ($product->stock_actual < $request->quantity) {
            return back()->with('error', 'Stock insuficiente');
        }

        Movement::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'movement_type_id' => $movementTypeId,
            'movement_reason_id' => $request->movement_reason_id,
            'quantity' => $request->quantity,
            'notes' => $request->notes,
        ]);

        $product->decrement('stock_actual', $request->quantity);

        return redirect()->route('inventory.index')
            ->with('success', 'Salida registrada correctamente');
    }
}
