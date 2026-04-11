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
            'razon_social' => 'nullable|string|max:150',
            'nit' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
        ]);

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