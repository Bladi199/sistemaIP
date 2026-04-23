<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // ==========================
    // GUARDAR CLIENTE (AJAX)
    // ==========================
  public function storeAjax(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:150',
    ]);

    // 🔍 Buscar duplicado REAL
    $existing = Customer::query()
        ->when($request->nit, function ($q) use ($request) {
            $q->where('nit', $request->nit);
        })
        ->orWhere(function ($q) use ($request) {
            if ($request->telefono) {
                $q->where('telefono', $request->telefono);
            }
        })
        ->first();

    if ($existing) {
        return response()->json([
            'success' => false,
            'message' => 'Ya existe un cliente con ese NIT o teléfono',
            'customer' => $existing
        ]);
    }

    // ✅ Crear cliente
    $customer = Customer::create([
        'name' => $request->name,
        'razon_social' => $request->razon_social,
        'nit' => $request->nit,
        'telefono' => $request->telefono,
        'direccion' => $request->direccion,
    ]);

    return response()->json([
        'success' => true,
        'customer' => $customer
    ]);
}
}